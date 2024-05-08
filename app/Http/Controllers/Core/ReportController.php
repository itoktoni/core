<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\DeleteRequest;
use App\Http\Services\Master\DeleteService;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Response;
use Plugins\Template;

class ReportController extends Controller
{
    public static $service;
    public static $model;
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
        ];
        return self::$share = array_merge($view, $data, self::$share);
    }

    public function getData()
    {
        $query = $this->model->dataRepository();
        return $query;
    }

    public function getTable()
    {
        $data = $this->getData();
        return view(Template::table(SharedData::get('template')))->with($this->share([
            'data' => $data,
            'fields' => $this->model->model->getShowField(),
        ]));
    }

    public function getCreate()
    {
        $this->beforeForm();
        $this->beforeCreate();
        return view(Template::form(SharedData::get('template')))->with($this->share());
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);
        return view(Template::form(SharedData::get('template')))->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get($this->model, $code, $relation);
        }
        return self::$service->get($this->model, $code);
    }

    public function postDelete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete($this->model, $code);
        return Response::redirectBack($data);
    }
}
