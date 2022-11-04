<?php

use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Clients\DonateController;
use App\Http\Controllers\Clients\ProfileController;
use App\Http\Controllers\Clients\TicketController;
use App\Http\Controllers\Clients\WalletController;
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

/**
 * AUTH ROUTES
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
    }
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

/**
 * ROUTES FOR CLIENTS DASHBOARD
 */

Route::group(['prefix'  =>  '/dashboard'], function() 
{
    Route::get('/',                [ClientsController::class,   'Dashboard'])->name('/');
});

Route::group(['prefix'  =>  '/profile'], function() 
{
    Route::get('/',                 [ProfileController::class,   'index'])->name('/profile');
    Route::post('/load',            [ProfileController::class,   'Load'])->name('/load');
    Route::post('/update',          [ProfileController::class,   'Update'])->name('/update');
});

Route::group(['prefix'  =>  '/creditcard'], function() 
{
    Route::post('/register',        [ProfileController::class,   'RegisterTDC'])->name('/register'); 
    Route::get('/search',           [ProfileController::class,   'SearchTDC'])->name('/search'); 
    Route::post('/update',          [ProfileController::class,   'UpdateTDC'])->name('/update'); 
});

Route::group(['prefix'  =>  '/accountbank'], function() 
{
    Route::post('/register',        [ProfileController::class,   'RegisterAB'])->name('/register'); 
    Route::get('/search',           [ProfileController::class,   'SearchAB'])->name('/search'); 
    Route::post('/update',          [ProfileController::class,   'UpdateAB'])->name('/update'); 
});

Route::group(['prefix'  =>  '/wallet'], function() 
{
    Route::get('/',                         [WalletController::class,   'index'])->name('/');
    // Route::get('/register',                 [WalletController::class,   'WaRegister'])->name('/register');
    Route::get('/view',                     [WalletController::class,   'View'])->name('/view'); 
    Route::get('/view/all',                 [WalletController::class,   'ViewAll'])->name('/view/all'); 
});

Route::group(['prefix'  =>  '/tickets'], function() 
{
    Route::get('/',                 [TicketController::class,   'index'])->name('/');
    Route::post('/change',          [TicketController::class,   'Change'])->name('/change');

});

Route::group(['prefix'  =>  '/donate'], function() 
{
    Route::get('/',                 [DonateController::class,   'index'])->name('/');
    Route::post('/register',        [DonateController::class,   'Register'])->name('/register');

});

/**
 * ROUTES FOR ADMINS DASHBOARD
 */

Route::group(['prefix'  =>  '/admins'], function() 
{
    Route::get('/',                [DashboardController::class,   'Dashboard'])->name('/');
});

/**
 * ROUTES FOR ERROS
 */

Route::get('/404', function () {    return view('page/errors/404'); });

/**
 * ROUTES FOR TEST
 */

Route::group(['prefix'  =>  '/test'], function() 
{
    Route::get('/',             [TestController::class,   'index'])->name('/');
    Route::get('/models',       [TestController::class, 'Models'])->name('/models');
    Route::get('/scrapers',     [TestController::class, 'Scrapers'])->name('/scrapers');
    Route::get('/ticket',       [TestController::class, 'Ticket'])->name('/ticket');
});