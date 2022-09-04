<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache cleared';
});
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate:fresh');
    return 'Migrate finished';
});
