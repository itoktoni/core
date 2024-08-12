<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class LinkModel extends \App\Dao\Models\Core\SystemLink
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
