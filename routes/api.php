<?php

use App\Dao\Enums\Core\BooleanType;
use App\Dao\Enums\Core\CetakType;
use App\Dao\Enums\Core\CuciType;
use App\Dao\Enums\Core\OpnameType;
use App\Dao\Enums\Core\ProcessType;
use App\Dao\Enums\Core\RegisterType;
use App\Dao\Enums\Core\TransactionType;
use App\Dao\Models\Cetak;
use App\Dao\Models\Detail;
use App\Dao\Models\History as ModelsHistory;
use App\Dao\Models\Opname;
use App\Dao\Models\Rs;
use App\Dao\Models\Transaksi;
use App\Dao\Models\ViewDetailLinen;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Core\UserController;
use App\Http\Controllers\Core\WebhookController;
use App\Http\Requests\DetailDataRequest;
use App\Http\Requests\DetailUpdateRequest;
use App\Http\Requests\OpnameDetailRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\DetailCollection;
use App\Http\Resources\DetailResource;
use App\Http\Resources\DownloadCollection;
use App\Http\Resources\OpnameResource;
use App\Http\Resources\RsResource;
use App\Http\Services\SaveOpnameService;
use App\Http\Services\SaveTransaksiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Plugins\History;
use Plugins\Notes;
use Plugins\Query;
use Symfony\Component\Process\Process;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('login', [UserController::class, 'postLoginApi'])->name('postLoginApi');
Route::post('deploy', [WebhookController::class, 'deploy'])->name('deploy');

Route::middleware(['auth:sanctum'])->group(function () use ($routes) {



});
