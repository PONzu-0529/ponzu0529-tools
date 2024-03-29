<?php

use App\Http\Controllers\AutomaticNiconicoMylistGeneratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandLogController;
use App\Http\Controllers\MylistAssistantController;
use App\Http\Controllers\SettingController;

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

Route::get('get-user-name', function () {
  return Auth::check() ? Auth::user()['name'] : '';
});

Route::get('get-csrf-token', function () {
  $session = app('session');

  if (isset($session)) {
    return $session->token();
  }

  throw new RuntimeException('Application session store not set.');
});

// Command Log
Route::post('command-log', [CommandLogController::class, 'store']);

// Mylist Assistant
Route::get('auth/mylist-assistant', [MylistAssistantController::class, 'authentication']);
Route::get('mylist-assistant/get-niconico-info', [MylistAssistantController::class, 'getNiconicoInfo']);
Route::get('mylist-assistant/get-now-playing-info', [MylistAssistantController::class, 'getNowPlayingInfo']);
Route::post('mylist-assistant/create-custom-mylist', [MylistAssistantController::class, 'createCustomMylist']);
Route::resource('mylist-assistant', MylistAssistantController::class, ['except' => ['create', 'edit']]);
Route::post('automatic-niconico-mylist-generator/create-custom-mylist', [AutomaticNiconicoMylistGeneratorController::class, 'createCustomMylist']);

// Setting
Route::post('setting', [SettingController::class, 'show']);
