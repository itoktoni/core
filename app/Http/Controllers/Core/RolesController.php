<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\LevelType;
use App\Dao\Repositories\Core\RolesRepository;
use App\Facades\Model\GroupModel;
use App\Http\Requests\Core\RoleRequest;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\SingleService;
use App\Http\Services\Core\UpdateRoleService;
use Plugins\Response;

class RolesController extends MasterController
{
    public function __construct(RolesRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
    }

    protected function beforeForm(){

        $group = GroupModel::getOptions();
        $level = LevelType::getOptions();

        self::$share = [
            'group' => $group,
            'level' => $level
        ];
    }

    public function postCreate(RoleRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, RoleRequest $request, UpdateRoleService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        $data = $this->get($code, ['has_group']);
        $selected = $data->has_group->pluck('system_group_code') ?? [];

        return moduleView(modulePathForm(), $this->share([
            'model' => $data,
            'selected' => $selected,
        ]));
    }
}
