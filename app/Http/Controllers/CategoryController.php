<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Core\MasterController;
use App\Http\Requests\Core\GeneralRequest;
use Plugins\Response;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Http\Services\Master\SingleService;
use App\Facades\Model\CategoryModel;

class CategoryController extends MasterController
{
    use CreateFunction, UpdateFunction;

    public function __construct(CategoryModel $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
    }
}
