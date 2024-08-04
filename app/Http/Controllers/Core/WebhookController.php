<?php

namespace App\Http\Controllers\Core;

use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\MasterController;
use App\Http\Requests\Core\LoginRequest;
use App\Http\Requests\Core\UserRequest;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\SingleService;
use App\Http\Services\Master\UpdateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Plugins\Notes;
use Plugins\Response;

class WebhookController extends Controller
{
    public function deploy(Request $request)
    {
        Log::info(json_encode($request->all()));
    }
}
