<?php

namespace App\Http\Controllers;

use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Core\User;
use App\Facades\Model\CategoryModel;
use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\MasterController;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\SingleService;
use App\Jobs\AppendMoreUsers;
use App\Jobs\CreateUsersExportFile;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Throwable;

class CategoryController extends MasterController
{
    use CreateFunction, UpdateFunction;

    public function __construct(CategoryModel $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
    }

    public function test()
    {
        $chunkSize = 2;
        $usersCount = UserModel::count();
        $numberOfChunks = ceil($usersCount / $chunkSize);

        for ($i = 1; $i <= $numberOfChunks; $i++) {

            $data = UserModel::query()
            ->orderBy('id', 'asc')
            ->skip(($i - 1) * $chunkSize)
            ->take($chunkSize)
            ->get()
            ->map(function ($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->email,
                ];
            })->toArray();

            if(!file_exists(storage_path("app/simple.xlsx"))){
                $spreadsheet = new Spreadsheet();
                $worksheet = $spreadsheet->getActiveSheet();

                foreach ($data as $rowNum => $rowData) {
                    $worksheet->fromArray($rowData, null, 'A' . ($rowNum + 1));
                }

                $writer = new Xlsx($spreadsheet);
                $writer->save(storage_path("app/simple.xlsx"));
             }
             else{

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path("app/simple.xlsx"));

                $worksheet = $spreadsheet->getActiveSheet();

                foreach ($data as $rowNum => $rowData) {
                    $worksheet->fromArray($rowData, null, 'A' . ((($chunkSize * $i) - ($chunkSize - 1)) + $rowNum));
                }

                $writer = new Xlsx($spreadsheet);
                $writer->save(storage_path("app/simple.xlsx"));
             }

        }

        dd(true);

    }

    public function postCreate(Request $request, CreateService $service)
    {
        //$this->test();
        ini_set('max_execution_time', 0);
        ini_set('max_input_time', 0);

        $chunkSize = 2;
        $usersCount = UserModel::count();
        $numberOfChunks = ceil($usersCount / $chunkSize);

        $folder = now()->toDateString() . '-' . str_replace(':', '-', now()->toTimeString());

        if ($usersCount > $chunkSize) {
            // for ($numberOfChunks; $numberOfChunks > 0; $numberOfChunks--) {
            for ($i = 1; $i <= $numberOfChunks; $i++) {
                $batches[] = new AppendMoreUsers($i, $chunkSize, $folder);
            }
        }

        Bus::batch($batches)
            ->name('Export Users')
            ->then(function (Batch $batch) use ($folder) {
                //$path = "exports/{$folder}/users.csv";
                // upload file to s3
                //$file = storage_path("app/{$folder}/users.csv");
                //Storage::disk('local')->put($path, file_get_contents($file));
                // send email to admin
            })
            ->catch(function (Batch $batch, Throwable $e) {
                // send email to admin or log error
            })
            ->finally(function (Batch $batch) use ($folder) {
                // delete local file
                //Storage::disk('local')->deleteDirectory($folder);
            })
            ->dispatch();

        return redirect()->back();

    }
}
