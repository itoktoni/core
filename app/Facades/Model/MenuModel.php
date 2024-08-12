<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class MenuModel extends \App\Dao\Models\Core\SystemMenu
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
