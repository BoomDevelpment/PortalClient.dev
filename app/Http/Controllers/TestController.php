<?php

namespace App\Http\Controllers;

use App\Models\Clients\Donative\DonativeImage;
use App\Models\Clients\Donative\DonativeRegister;
use App\Models\Clients\Donative\DonativeVideo;
use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Gender;
use App\Models\Clients\General\Profile;
use App\Models\Clients\General\Role;
use App\Models\Clients\Invoices\InvoicesStatus;
use App\Models\Clients\Invoices\InvoicesType;
use App\Models\Clients\Payments\AccountBank;
use App\Models\Clients\Payments\AccountBankEntity;
use App\Models\Clients\Payments\AccountBankType;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Payments\CreditCardEntity;
use App\Models\Clients\Payments\CreditCardType;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Paypal\Paypal;
use App\Models\Clients\Profile\Client;
use App\Models\Clients\Profile\Operator;
use App\Models\Clients\Transference\TransferenceBank;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferenceMovil;
use App\Models\Clients\Transference\TransferencePaypal;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\Clients\Transference\TransferenceZelle;
use App\Models\Clients\Voucher\VoucherLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

use FrittenKeeZ\Vouchers\Facades\Vouchers;
use FrittenKeeZ\Vouchers\Models\Voucher;

use Symfony\Component\HttpClient\HttpClient;

use Image;
use Goutte\Client as gClient;
use Carbon\Carbon;
use Carbon\CarbonInterval;

use Symfony\Component\Process\Process;

use Revolution\Google\Sheets\Facades\Sheets;

class TestController extends Controller
{
    public static function index(Request $request)
    {
        
        $data   =   Scrapers::getLast();
        $rows = [
            [$data->dolar, $data->euro, $data->yuan, $data->lira, $data->rublo, $data->paralelo, date_format($data->created_at,"Y-m-d H:i:s")]
        ];

        Sheets::spreadsheet(env('SPREADSHEET_BCV'))->sheet('BCV')->range('B4:H4')->append($rows);
        
        dd(config('google.spreadsheet_id'));


        // $process = new Process(['speedtest']);

        // dd($process, $process->run());
        
        $user       =   User::find(3);
        $myWallet   =   $user->getWallet($user->identified);
        dd($myWallet->balanceFloat);


        dd("Test Controller");
    }

    public static function Models(Request $request)
    {
        // dd(strtoupper(Str::random(10)));
        /** Banks Relationship - One to Many */
        // $bank   =   Bank::first();
        // dd($bank->name, $bank->status->name);

        /** Genders Relationship - One to Many */
        // $gender =   Gender::first();
        // dd($gender->name, $gender->status->name);

        /** Profile Relationship - One to Many */
        // $profile =   Profile::first();
        // dd($profile->name, $profile->status->name);

        /** Roles Relationship - One to Many */
        // $role =   Role::first();
        // dd($role->name, $role->status->name);

        /** User Client Relationship - One to Many */
        // $user =   User::find(3);
        // dd($user->id, $user->name, $user->status->name, $user->profile->name, "Client id: ".$user->client->client_id);

        /** User Opertaor Relationship - One to Many */
        // $user =   User::find(1);
        // dd($user->id, $user->name, $user->status->name, $user->profile->name, "Operator id: ".$user->operator->operator_id);

        /** Operator Relationship - One to Many */
        // $operator =   Operator::find(1);
        // dd($operator->id, $operator->name, $operator->status->name, $operator->role->name, $operator);

        /** Scrapers Relationship - One to Many */
        // $scraper =   Scrapers::first();
        // dd($scraper->dolar, $scraper->status->name);

        /** AccountBankEntities Relationship - One to Many */
        // $ABEntities =   AccountBankEntity::first();
        // dd($ABEntities->name, $ABEntities->status->name);

        /** AccountBankType Relationship - One to Many */
        // $ABType =   AccountBankType::first();
        // dd($ABType->name, $ABType->status->name);

        /** AccountBank Relationship - One to Many */
        // $AB =   AccountBank::first();
        // dd($AB, $AB->name, $AB->status->name, $AB->bank->name, $AB->type->name, $AB->entity->name, $AB->client->name);

        /** CreditCardEntities Relationship - One to Many */
        // $CCEntities =   CreditCardEntity::first();
        // dd($CCEntities->name, $CCEntities->status->name);

        /** CreditCardType Relationship - One to Many */
        // $CCType =   CreditCardType::first();
        // dd($CCType->name, $CCType->status->name);

        /** CreditCard Relationship - One to Many */
        // $cc =   CreditCard::first();
        // dd($cc, $cc->name, $cc->status->name, $cc->type->name, $cc->entity->name, $cc->client->name);

        /** TransferenceStatus Relationship - One to Many */
        // $tStatus =   TransferenceStatus::first();
        // dd($tStatus->name, $tStatus->status->name);

        /** TransferenceType Relationship - One to Many */
        // $tStatus =   TransferenceType::first();
        // dd($tStatus->name, $tStatus->status->name);

        /** TransferenceMethod Relationship - One to Many */
        // $tStatus =   TransferenceMethod::first();
        // dd($tStatus->name, $tStatus->status->name);
        
        // /** TransferenceZelle Relationship - One to Many */
        // $tZelle =   TransferenceZelle::first();
        // $iZelle =   TransferenceZelle::GetImage($tZelle->identified);
        // dd($tZelle, $tZelle->identified, $tZelle->status->name, $tZelle->type->name, $iZelle);

        /** TransferencePaypal Relationship - One to Many */
        // $tPaypal    =   TransferencePaypal::first();
        // $iPaypal    =   TransferencePaypal::GetImage($tPaypal->identified);
        // dd($tPaypal, $tPaypal->identified, $tPaypal->status->name, $tPaypal->type->name, $iPaypal);

        /** TransferenceBank Relationship - One to Many */
        // $tBank    =   TransferenceBank::first();
        // $iBank    =   TransferenceBank::GetImage($tBank->identified);
        // dd($tBank, $tBank->identified, $tBank->status->name, $tBank->type->name, $iBank);

        /** TransferenceMovil Relationship - One to Many */
        // $tMovil    =   TransferenceMovil::first();
        // $iMovil    =   TransferenceMovil::GetImage($tMovil->identified);
        // dd($tMovil, $tMovil->identified, $tMovil->status->name, $tMovil->type->name, $iMovil);

        /** InvoicesStatus Relationship - One to Many */
        // $tStatus =   InvoicesStatus::first();
        // dd($tStatus->name, $tStatus->status->name);

        /** InvoicesType Relationship - One to Many */
        // $tStatus =   InvoicesType::first();
        // dd($tStatus->name, $tStatus->status->name);

        /** Paypal Relationship - One to Many */
        // $paypal =   Paypal::first();
        // dd($paypal->mode, $paypal->status->name);

        /** VoucherLog Relationship - One to Many */
        // $vou =   VoucherLog::first();
        // dd($vou, $vou->ticket, $vou->client->name);

        /** DonativeImage Relationship - One to Many */
        // $dImage =   DonativeImage::first();
        // dd($dImage->name, $dImage->status->name);

        /** DonativeVideo Relationship - One to Many */
        // $dVideo =   DonativeVideo::first();
        // dd($dVideo->name, $dVideo->status->name);

        /** VoucherLog Relationship - One to Many */
        // $donative =   DonativeRegister::first();
        // dd($donative, $donative->client->name, $donative->status->name);

    }

    public static function Scrapers(Request $request)
    {
    
        $client     =   new gClient(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
        $crawler    =   $client->request('GET', 'https://www.bcv.org.ve/');
        
        $euro       =   $crawler->filter('#euro')->each(function ($node){ return    $node->text(); });
        $yuan       =   $crawler->filter('#yuan')->each(function ($node){ return    $node->text(); });
        $lira       =   $crawler->filter('#lira')->each(function ($node){ return    $node->text(); });
        $rublo      =   $crawler->filter('#rublo')->each(function ($node){ return    $node->text(); });
        $dolar      =   $crawler->filter('#dolar')->each(function ($node){ return    $node->text(); });    
       
        $client     =   new gClient(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
        $Goutte    =   $client->request('GET', 'https://monitordolarvenezuela.com/');
        $filter     =   $Goutte->filter('#Costo')->each(function ($node){ return    $node->text(); });
        $paralelo   =   ( empty($filter) == true ) ? "0.00" : trim(substr( str_replace(',','.',substr($filter[0],'0',  strlen($filter[0]))),   0, -3));
        
        $iData  =   [
            'euro'      =>  substr( str_replace(',','.',substr($euro[0],'4',  strlen($euro[0]))),   0, -6),
            'yuan'      =>  substr( str_replace(',','.',substr($yuan[0],'4',  strlen($yuan[0]))),   0, -6),
            'lira'      =>  substr( str_replace(',','.',substr($lira[0],'4',  strlen($lira[0]))),   0, -6),
            'rublo'     =>  substr( str_replace(',','.',substr($rublo[0],'4', strlen($rublo[0]))),  0, -6),
            'dolar'     =>  substr( str_replace(',','.',substr($dolar[0],'4', strlen($dolar[0]))),  0, -6),
            'paralelo'  =>  $paralelo
        ];


        dd($iData);

        $get    =   Scrapers::getLast();
        $st     =   0;

        $iRes  =   [ 'euro'  =>  $get->euro, 'yuan'  =>  $get->yuan, 'lira'  =>  $get->lira, 'rublo' =>  $get->rublo, 'dolar' =>  $get->dolar];
        
        $sE     =   ($iRes['euro']  <> $iData['euro'])  ? 1 : 0;
        $sY     =   ($iRes['lira']  <> $iData['lira'])  ? 1 : 0;
        $sL     =   ($iRes['yuan']  <> $iData['yuan'])  ? 1 : 0;
        $sR     =   ($iRes['rublo'] <> $iData['rublo']) ? 1 : 0;
        $sD     =   ($iRes['dolar'] <> $iData['dolar']) ? 1 : 0;

        if( ($sE == 1) || ($sY == 1) || ($sL == 1) || ($sR == 1) || ($sD == 1) )
        {
            $insert     =   Scrapers::insertData($iData);
            
            if($insert <> false)
            {
                \Log::info(date("Y-m-d H:m:s")." - Scraper - Update values of reference rates BCV - Dolar: ".$iData['dolar']." - Euro: ".$iData['euro']." - Yuan: ".$iData['euro']." - Lira: ".$iData['lira']." - Rublo: ".$iData['rublo']."");
            }else{
                \Log::info(date("Y-m-d H:m:s")." - Scraper - It is not possible to update values of reference rates BCV");
            }
        }

        dd("Scrapers TestController");
    }

    public static function Ticket(Request $request)
    {
        $amount     =   1.00;
        $user       =   User::findOrFail(auth()->user()->id);

        $voucher    =   Vouchers::withMask('***-***')
            ->withOwner($user)
            ->withMetadata([
                'amount'    =>  $amount,
                'title'     =>  'Premiamos tu fidelidad',
                'message'   =>  'Por ser tan buen cliente, te obsequiamos un vale por el monto de $ '.$amount.''
                ])
            ->withStartDateIn(CarbonInterval::create('P0D'))
            ->withExpireDateIn(CarbonInterval::create('P1W'))
            ->create();
        dd($voucher);
    }
    
}