<?php

use App\Http\Controllers\Api\CampaignOutboxController;
use App\Http\Controllers\Api\CampaignsController;
use App\Http\Controllers\Api\CancelCampaginController;
use App\Http\Controllers\Api\CheckEmailListUsedController;
use App\Http\Controllers\Api\ImportSubscribersController;
use App\Http\Controllers\Api\ResubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('campaigns', [CampaignsController::class, 'index']);
Route::get('campaigns/{campaign}', [CampaignsController::class, 'show']);
Route::post('campaigns/{campaign}/cancel', CancelCampaginController::class)->name('api.campaigns.cancel');
Route::get('campaigns/{campaign}/outbox', CampaignOutboxController::class);
Route::post('subscribers/{subscriber}/resubscribe', ResubscribeController::class);
Route::post('email-lists/{emailList}/check-used', CheckEmailListUsedController::class);
Route::get('email-lists/{emailList}/import-subscribers', [ImportSubscribersController::class, 'show']);