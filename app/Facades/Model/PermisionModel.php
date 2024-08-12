<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class PermisionModel extends \App\Dao\Models\Core\SystemPermision
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
