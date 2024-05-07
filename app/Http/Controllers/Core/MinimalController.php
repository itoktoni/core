<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Http\Controllers\Core\Controller;

class MinimalController extends Controller
{
    public static $service;
    public static $repository;
    public static $template;
    public static $share = [];

    protected function beforeForm(){}
    protected function beforeCreate(){}
    protected function beforeUpdate($code){}

    protected function share($data = [])
    {
        $status = BooleanType::getOptions();
        $view = [
            'status' => $status,
            'model' => false,
        ];
        return self::$share = array_merge($view, self::$share, $data);
    }

    public function getCreate()
    {
        $this->beforeForm();
        $this->beforeCreate();
        return moduleView(modulePathForm(), $this->share());
    }
}
