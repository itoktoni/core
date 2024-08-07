<?php

namespace App\Providers;

use App\Dao\Models\Core\Filters;
use App\Dao\Models\Core\User;
use App\Dao\Models\Core\SystemGroup;
use App\Dao\Models\Core\SystemLink;
use App\Dao\Models\Core\SystemMenu;
use App\Dao\Models\Core\SystemPermision;
use App\Dao\Models\Core\SystemRole;
use App\Dao\Models\Core\Team;
use Illuminate\Support\Facades\File;
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

        $this->app->bind('TeamModel', Team::class);
    }

    public static function getControllerFile(){

        $path = app_path('Facades/Model');
        $fileNames = [];
        $files = File::allFiles($path);

        foreach($files as $file) {
            if(!in_array($file->getFilenameWithoutExtension(), ['ForgotPasswordController', 'LoginController', 'RegisterController', 'ResetPasswordController', 'VerificationController'])){
                $code = $file->getFilenameWithoutExtension();
                $fileNames[$code] = '\\App\\Dao\\Models\\'.str_replace('Model', '', $code).'::class';
            }
        }

        return $fileNames;
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
