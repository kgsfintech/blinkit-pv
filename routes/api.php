<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\StaffrequestController;
use App\Http\Controllers\Api\TeammemberController;
use App\Http\Controllers\Api\FinanceController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\TenderController;
use App\Http\Controllers\Api\KnowledgebaseController;
use App\Http\Controllers\Api\AssetticketController;
use App\Http\Controllers\Api\AssetmailController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\PvformController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ClientloginController;
use App\Http\Controllers\Api\ClientinformationController;
use App\Http\Controllers\Api\AssetregisterController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UserController::class, 'login']);
Route::post('pvform', [PvformController::class, 'pvForm']);
Route::post('pvformupdate', [PvformController::class,'pvformUpDate']);
Route::post('assetregister', [PvformController::class, 'assetRegister']);
Route::post('assetregister/fetchbystoreid', [AssetregisterController::class, 'showbyid']);
Route::post('assetregister/fetchbystoreid2', [AssetregisterController::class, 'showbyid2']);
Route::post('assetregistermail/fetchbystoreid', [AssetmailController::class, 'showbyid']);
