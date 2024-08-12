<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class TeamModel extends \App\Dao\Models\Core\Team
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
