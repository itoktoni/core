<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\LevelType;
use App\Dao\Repositories\Core\PermisionRepository;
use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use App\Http\Requests\Core\GeneralRequest;
use App\Http\Requests\Core\MenuRequest;
use App\Http\Requests\Core\SortRequest;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\SingleService;
use App\Http\Services\Master\UpdateService;
use Plugins\Core;
use Plugins\Helper;
use Plugins\Response;

class PermissionController extends MasterController
{
    public function __construct(PermisionRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $user = UserModel::getOptions();
        $level = LevelType::getOptions();
        $role = RoleModel::getOptions();
        $files = Helper::getControllerFile();

        self::$share = [
            'level' => $level,
            'user' => $user,
            'role' => $role,
            'model' => false,
            'file' => $files,
            'action' => [],
        ];
    }

    public function postCreate(MenuRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function postSort(SortRequest $request)
    {
        $data = self::$service->sort($request);
        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        $data = $this->get($code, ['has_user']);
        $module = Core::getControllerName($data->field_controller);

        $data_action = Core::getMethod($data->field_controller, $module) ?? [];
        $action = $data_action->pluck('primary', 'action')->toArray();

        return moduleView(modulePathForm(core: self::$is_core), $this->share([
            'model' => $data,
            'action' => array_merge($action, [$module.'.empty' => 'Empty Data', $module.'.sort' => 'Sort Data']),
        ]));
    }
}
