<?php

namespace App\Providers;

use App\Dao\Models\Core\Category;
use App\Dao\Models\Core\Filters;
use App\Dao\Models\Core\User;
use App\Dao\Models\Core\SystemGroup;
use App\Dao\Models\Core\SystemLink;
use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Core\SystemPermision;
use App\Dao\Models\Core\SystemRole;
use App\Dao\Repositories\Core\CategoryRepository;
use App\Dao\Repositories\Core\GroupsRepository;
use App\Dao\Repositories\Core\LinkRepository;
use App\Dao\Repositories\Core\MenuRepository;
use App\Dao\Repositories\Core\PermisionRepository;
use App\Dao\Repositories\Core\RolesRepository;
use App\Dao\Repositories\Core\UserRepository;
use Illuminate\Contracts\Foundation\Application;
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

        $this->app->bind('CategoryModel', Category::class);
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
