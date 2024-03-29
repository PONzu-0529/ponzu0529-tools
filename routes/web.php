<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/helper.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/laravel', function () {
  return view('welcome');
});

Route::get('/', function () {
  return RouteHelper::makeVueResponse();
});

Route::get('/{any}', function () {
  return RouteHelper::makeVueResponse();
});
