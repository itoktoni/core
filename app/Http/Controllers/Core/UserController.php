<?php

namespace App\Http\Controllers\Core;

use App\Dao\Repositories\Core\UserRepository;
use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\MasterController;
use App\Http\Requests\Core\LoginRequest;
use App\Http\Requests\Core\UserRequest;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\SingleService;
use App\Http\Services\Master\UpdateService;
use Illuminate\Support\Facades\Hash;
use Plugins\Notes;
use Plugins\Response;

class UserController extends MasterController
{
    public function __construct(UserRepository $repository, SingleService $service)
    {
        self::$repository = self::$repository ?? $repository;
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $roles = RoleModel::getOptions();

        self::$share = [
            'roles' => $roles,
        ];
    }

    public function postCreate(UserRequest $request, CreateService $service)
    {
        $data = $service->save(self::$repository, $request);
        return Response::redirectBack($data);
    }

    public function postUpdate($code, UserRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$repository, $request, $code);
        return Response::redirectBack($data);
    }

    public function changePassword(){

        if(request()->method() == 'POST'){

            UserModel::find(auth()->user()->id)->update([
                'password' => bcrypt(request()->get('password'))
            ]);

            return redirect()->route('home');
        }
        return view('auth.change_password')->with($this->share());
    }

    public function postLoginApi(LoginRequest $request)
    {
        $user = UserModel::where('username', $request->username)->first();

        if (!Hash::check($request->password, $user->password)) {
            return Notes::error([
                'password' => 'Password Tidak Di temukan',
            ],'Login Gagal');
        }

        $token = $user->createToken($user->name);
        $string_token = $token->plainTextToken;
        $user->api_token = $string_token;
        $user->save();

        return Notes::token($user->toArray());
    }
}
