<?php

namespace App\Facades\Model;

/**
 * @see \App\Dao\Models\Core\User
 */

class UserModel extends \App\Dao\Models\Core\User
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
