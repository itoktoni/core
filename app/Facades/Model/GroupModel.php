<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class GroupModel extends \App\Dao\Models\Core\SystemGroup
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
