<?php

namespace App\Providers;

use App\Dao\Interfaces\CrudInterface;
use App\Dao\Models\Core\Category;
use App\Dao\Repositories\Core\CategoryRepository;
use App\Dao\Repositories\Core\GroupsRepository;
use App\Dao\Repositories\Core\LinkRepository;
use App\Dao\Repositories\Core\MasterRepository;
use App\Dao\Repositories\Core\MenuRepository;
use App\Dao\Repositories\Core\PermisionRepository;
use App\Dao\Repositories\Core\RolesRepository;
use App\Dao\Repositories\Core\UserRepository;
use App\Facades\Model\GroupModel;
use App\Facades\Model\LinkModel;
use App\Facades\Model\MenuModel;
use App\Facades\Model\PermisionModel;
use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Plugins\Query;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CrudInterface::class, MasterRepository::class);
        /**
         * Register repository
         */
        $this->app->bind(UserRepository::class, function(){
            return new UserRepository(UserModel::getModel());
        });
        $this->app->bind(GroupsRepository::class, function(){
            return new GroupsRepository(GroupModel::getModel());
        });
        $this->app->bind(PermisionRepository::class, function(){
            return new PermisionRepository(PermisionModel::getModel());
        });
        $this->app->bind(LinkRepository::class, function(){
            return new LinkRepository(LinkModel::getModel());
        });
        $this->app->bind(MenuRepository::class, function(){
            return new MenuRepository(MenuModel::getModel());
        });
        $this->app->bind(RolesRepository::class, function(){
            return new RolesRepository(RoleModel::getModel());
        });
        $this->app->bind(CategoryRepository::class, function(){
            return new CategoryRepository(new Category());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $roles = Query::role();
        if($roles){
            foreach($roles as $role){
                Blade::if($role->field_primary, function () use($role) {
                    return auth()->check() && auth()->user()->role == $role->field_primary;
                });
            }
        }

        Blade::if('level', function ($value) {
            return auth()->check() && auth()->user()->level >= $value;
        });
    }
}
