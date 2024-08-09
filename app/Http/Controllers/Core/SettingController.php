<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Facades\Model\UserModel;
use App\Http\Services\Core\CreateSettingService;
use Plugins\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\SettingRequest;
use App\Jobs\AppendMoreUsers;
use App\Jobs\JobExportUser;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SettingController extends Controller
{
    protected function share($data = [])
    {
        $view = [
            'model' => false,
            'active' => BooleanType::getOptions()
        ];
        return array_merge($view, $data);
    }

    public function getCreate()
    {
        return moduleView(modulePathForm(path: true), $this->share());
    }

    public function postCreate(SettingRequest $request, CreateSettingService $service)
    {
        $chunkSize = 10;
        $usersCount = UserModel::count();
        $numberOfChunks = ceil($usersCount / $chunkSize);

        $name = now()->toDateString() . '-' . str_replace(':', '-', now()->toTimeString()).'.csv';

        if ($usersCount > $chunkSize) {
            for ($i = 1; $i <= $numberOfChunks; $i++) {
                $batches[] = new JobExportUser($i, $chunkSize, $name);
            }
        }

        Bus::batch($batches)
            ->name('Export Users')
            ->then(function (Batch $batch) use ($name) {

                Storage::disk('public')->put($name, file_get_contents($name));

                $notification = new \MBarlow\Megaphone\Types\General(
                    'Download File Success',
                    'File Ready to download',
                    asset('files/' . $name),
                    'Download'
                );

                sendNotification($notification);

            })
            ->catch(function (Batch $batch, Throwable $e) {

                $notification = new \MBarlow\Megaphone\Types\Important(
                    'Download File Error',
                    $e->getMessage(),
                );

                sendNotification($notification);

            })
            ->finally(function (Batch $batch) use ($name) {
                Storage::disk('local')->delete($name);
            })
            ->dispatch();

        return redirect()->back();

        $data = $service->save($request);
        return Response::redirectBack($data);
    }
}
