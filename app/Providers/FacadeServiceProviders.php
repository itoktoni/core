<?php

namespace App\Providers;

use App\Dao\Models\Core\Filters;
use App\Dao\Models\Core\User;
use App\Dao\Models\Core\SystemGroup;
use App\Dao\Models\Core\SystemLink;
use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Core\SystemPermision;
use App\Dao\Models\Core\SystemRole;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserModel', User::class);
        $this->app->bind('MenuModel', SystemMenu::class);
        $this->app->bind('LinkModel', SystemLink::class);
        $this->app->bind('RoleModel', SystemRole::class);
        $this->app->bind('GroupModel', SystemGroup::class);
        $this->app->bind('PermisionModel', SystemPermision::class);
        $this->app->bind('FilterModel', Filters::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
