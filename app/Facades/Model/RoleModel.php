<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class RoleModel extends \App\Dao\Models\Core\SystemRole
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
