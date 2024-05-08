<?php

namespace App\Http\Services\Master;

use App\Dao\Interfaces\CrudInterface;
use Plugins\Alert;

class UpdateService
{
    public function update($model, $data, $code)
    {
        $check = $model->updateRepository($data->all(), $code);
        if ($check['status']) {
            if(request()->wantsJson()){
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['message']);
        }
        return $check;
    }
}
