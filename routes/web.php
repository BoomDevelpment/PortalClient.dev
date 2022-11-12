<?php

use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Clients\CustomersController;
use App\Http\Controllers\Clients\DonateController;
use App\Http\Controllers\Clients\InvoicesController;
use App\Http\Controllers\Clients\PagoMovilController;
use App\Http\Controllers\Clients\PaypalController;
use App\Http\Controllers\Clients\ProfileController;
use App\Http\Controllers\Clients\TicketController;
use App\Http\Controllers\Clients\TransferenceController;
use App\Http\Controllers\Clients\WalletController;
use App\Http\Controllers\Clients\ZelleController;
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
    Route::get('/register',                 [WalletController::class,   'WaRegister'])->name('/register');
    Route::get('/view',                     [WalletController::class,   'View'])->name('/view'); 
    Route::get('/view/all',                 [WalletController::class,   'ViewAll'])->name('/view/all'); 
});

Route::group(['prefix'  =>  '/zelle'], function() 
{
    Route::post('/verificate',              [ZelleController::class,   'Verificate'])->name('/verificate'); 
    Route::post('/register',                [ZelleController::class,   'Register'])->name('/register'); 
    Route::post('/files',                   [ZelleController::class,   'Files'])->name('/files'); 
    Route::post('/files/delete',            [ZelleController::class,   'Delete'])->name('/files/delete'); 
});

Route::group(['prefix'  =>  '/paypal'], function() 
{
    Route::post('/verificate',              [PaypalController::class,   'Verificate'])->name('/verificate'); 
    Route::post('/register',                [PaypalController::class,   'Register'])->name('/register'); 
    Route::post('/files',                   [PaypalController::class,   'Files'])->name('/files'); 
    Route::post('/files/delete',            [PaypalController::class,   'Delete'])->name('/files/delete'); 
    
    // Pay with Paypal Javascritp    
    Route::post('/calculate',               [PaypalController::class,   'Calculate'])->name('/calculate');
    Route::post('/order',                   [PaypalController::class,   'Order'])->name('/order');
    Route::get('/process',                  [PaypalController::class,   'Process'])->name('/process');
    Route::get('/cancel',                   [PaypalController::class,   'Cancel'])->name('/cancel'); 
    
});

Route::group(['prefix'  =>  '/transference'], function() 
{
    Route::post('/register',                [TransferenceController::class,   'Register'])->name('/register'); 
    Route::post('/files',                   [TransferenceController::class,   'Files'])->name('/files'); 
    Route::post('/files/delete',            [TransferenceController::class,   'Delete'])->name('/files/delete'); 
    Route::post('/confirms',                [TransferenceController::class,   'Confirm'])->name('/confirms'); 
});

Route::group(['prefix'  =>  '/movil'], function() 
{
    Route::post('/register',                [PagoMovilController::class,   'Register'])->name('/register'); 
    Route::post('/files',                   [PagoMovilController::class,   'Files'])->name('/files'); 
    Route::post('/files/delete',            [PagoMovilController::class,   'Delete'])->name('/files/delete'); 
    Route::post('/confirms',                [PagoMovilController::class,   'Confirm'])->name('/confirms'); 
});

Route::group(['prefix'  =>  '/invoices'], function() 
{
    Route::get('/',                         [InvoicesController::class,   'index'])->name('/');
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

Route::group(['prefix'  =>  '/customers'], function() 
{
    Route::get('/',                         [CustomersController::class,   'index'])->name('/'); 
    Route::post('/info',                    [CustomersController::class,   'Info'])->name('/info'); 
    Route::post('/register',                [CustomersController::class,   'Register'])->name('/register'); 
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