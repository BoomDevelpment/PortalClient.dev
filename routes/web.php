<?php

use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\TestController;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
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
    try {
        $user       =   Client::findOrFail(auth()->user()->client->client_id);
        return redirect('/dashboard');

    } catch (\Exception $e) {
        try {
            $ope    =   Operator::findOrFail(auth()->user()->operator->operator_id);
            return redirect('/admins');
        } catch (\Throwable $th) {
            return redirect('/login');
        }
        dd("Controller Admin");
    }
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test',         [TestController::class, 'index']);
Route::get('/models',       [TestController::class, 'Models']);
Route::get('/scrapers',     [TestController::class, 'Scrapers']);

Auth::routes();

Route::group(['prefix'  =>  '/dashboard'], function() 
{
    Route::get('/',                [ClientsController::class,   'Dashboard'])->name('/');
});

Route::group(['prefix'  =>  '/admins'], function() 
{
    Route::get('/',                [DashboardController::class,   'Dashboard'])->name('/');
});
