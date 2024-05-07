<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Http\Requests\CoreSettingRequest;
use App\Http\Services\Core\CreateSettingService;
use Plugins\Response;
use App\Http\Controllers\Controller;

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
        return moduleView(modulePathForm(), $this->share());
    }

    public function postCreate(SettingRequest $request, CreateSettingService $service)
    {
        $data = $service->save($request);
        return Response::redirectBack($data);
    }
}
