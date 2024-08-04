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
use Symfony\Component\Process\Process;

class WebhookController extends Controller
{
    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = 'dEJ537BScul2VDkbsoiaSo3mGx9c74qsYzM36lJv3FE7wGYx';
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {
            Log::info(true);
             $root_path = base_path();
             shell_exec('cd ' . $root_path . ' && git pull origin tenancy');
        }
        else{
            Log::info(false);
        }
    }
}
