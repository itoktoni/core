<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class FilterModel extends \App\Dao\Models\Core\Filters
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
