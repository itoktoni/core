<?php

use Carbon\Carbon;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Str;

define('ACTION_CREATE', 'getCreate');
define('ACTION_UPDATE', 'getUpdate');
define('ACTION_DELETE', 'getDelete');
define('ACTION_EMPTY', 'empty');
define('ACTION_TABLE', 'getTable');
define('ACTION_PRINT', 'getPrint');
define('ACTION_EXPORT', 'getExport');
define('ERROR_PERMISION', 'Maaf anda tidak punya otorisasi untuk melakukan hal ini');

define('UPLOAD', 'upload');
define('KEY', 'key');

function module($module = null){
    return SharedData::get($module);
}

function moduleCode($name = null)
{
    return !empty($name) ? $name : SharedData::get('module_code');
}

function moduleName($name = null)
{
    return !empty($name) ? __($name) : __(SharedData::get('menu_name'));
}

function moduleAction($name = null)
{
    return moduleCode() . '.' . $name;
}

function moduleRoute($action, $param = false)
{
    return $param ? route(moduleAction($action), $param) : route(moduleAction($action));
}

function modulePath($name = null)
{
    return !empty($name) ? $name : moduleCode($name);
}

function modulePathTable($name = null)
{
    if ($name) {
        return 'pages.' . $name . '.table';
    }

    return 'pages.' . moduleCode() . '.table';
}

function modulePathPrint($name = null)
{
    if ($name) {
        return 'pages.' . moduleCode() . '.'.$name;
    }

    return 'pages.master.print';
}

function modulePathForm($name = null, $template = null)
{
    if ($template && $name) {
        return 'pages.' . $template . '.' . $name;
    }

    if ($name) {
        return 'pages.' . moduleCode() . '.' . $name;
    }

    if ($template) {
        return 'pages.' . $template . '.form';
    }

    return 'pages.' . moduleCode() . '.form';
}

function moduleView($template, $data = []){
    $view = view($template)->with($data);

    if(request()->header('hx-request') && env('APP_SPA', false)){
        $view = $view->fragment('content');
    }

    return $view;
}

function formatLabel($value){

    $label = Str::of($value);
    if($label->contains('_')){
        $label = $label = $label->explode('_')->last();
    }
    else{
        $label = $label->replace('[]', '');
    }

    return ucfirst($label);
}

function formatAttribute($value){

    $label = Str::of($value);
    if($label->contains(' ')){
        $label = $label = $label->explode(' ')->last();
    }
    else{
        $label = $label->replace('[]', '');
    }

    return ucfirst($label);
}

function formatWorld($value){
    if (!empty($value)) {
        return Str::title(str_replace('_', ' ', Str::snake($value))) ?? 'Unknow';
    }
}

function showValue($value){
    if($value == 0){
        return '';
    }

    return $value;
}

function role($role){
    return auth()->check() && auth()->user()->role == $role;
}

function level($value){
    return auth()->check() && auth()->user()->level >= $value;
}

function imageUrl($value, $folder = null){
    $path = $folder ? $folder : moduleCode();
    return asset('public/storage/'.$path.'/'.$value);
}

function formatDateMySql($value, $datetime = false){

    if($datetime === false){
        $format = 'Y-m-d';
    }
    else if($datetime === true){
        $format = 'Y-m-d H:i:s';
    }
    else{
        $format = $datetime;
    }

    if($value instanceof Carbon){
        $value = $value->format($format);
    } else if(is_string($value)){
        $value = SupportCarbon::parse($value)->format($format);
    }

    return $value ?  : null;
}

function formatDate($value, $datetime = false){

    if($datetime === false){
        $format = 'd/m/Y';
    }
    else if($datetime === true){
        $format = 'd/m/Y H:i:s';
    }
    else{
        $format = $datetime;
    }

    if(empty($value)){
        return null;
    }

    if($value instanceof Carbon){
        $value = $value->format($format);
    } else if(is_string($value)){
        $value = SupportCarbon::parse($value)->format($format);
    }

    return $value ?  : null;
}

function iteration($model, $key){
    return $model->firstItem() + $key;
}

function unic($length)
{
    $chars = array_merge(range('a', 'z'), range('A', 'Z'));
    $length = intval($length) > 0 ? intval($length) : 16;
    $max = count($chars) - 1;
    $str = "";

    while ($length--) {
        shuffle($chars);
        $rand = mt_rand(0, $max);
        $str .= $chars[$rand];
    }

    return $str;
}

function getClass($class)
{
    return (new \ReflectionClass($class))->getShortName();
}

function getLowerClass($class)
{
    return strtolower(getClass($class));
}

function setString($value)
{
    return '"'.$value.'"';
}