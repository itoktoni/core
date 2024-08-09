<?php

namespace App\Http\Controllers;

use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\ReportController;
use Illuminate\Http\Request;

class ReportUserController extends ReportController
{
    public $data;

    public function __construct(UserModel $model)
    {
        self::$model = self::$model ?? $model;
    }

    private function getQuery($request)
    {
        return self::$model::getModel()->get();
    }

    public function getPrint(Request $request)
    {
        set_time_limit(0);

        $this->data = $this->getQuery($request);

        return moduleView(modulePathPrint(), $this->share([
            'data' => $this->data,
        ]));
    }
}
