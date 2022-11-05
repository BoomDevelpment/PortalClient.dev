<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\Scrapers;
use App\Models\Clients\Paypal\Paypal;
use App\Models\Clients\Transference\TransferenceFile;
use App\Models\Clients\Transference\TransferenceMethod;
use App\Models\Clients\Transference\TransferencePaypal;
use App\Models\Clients\Transference\TransferencePending;
use App\Models\Clients\Transference\TransferenceStatus;
use App\Models\Clients\Transference\TransferenceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as GuzzleClient;
use Image;

class PaypalController extends Controller
{
    private $paypalClient;
    private $accessToken;

    public function __construct()
    {

        $this->middleware('auth');

        $credentials    =   Paypal::WHERE('status_id', 'like', '%'. Status::WHERE('name', 'LIKE', '%act%')->get()[0]->id .'%')->get();

        if(COUNT($credentials) > 0)
        {
            if( $credentials[0]->mode == 'live' )
            {
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
            $clientId       =   $credentials[0]->client;
            $secret         =   $credentials[0]->secret;

        }else{

            if(config('paypal')['credentials']['settings']['mode'] === 'live')
            {
                $clientId   =   config('paypal')['credentials']['live_client'];
                $secret     =   config('paypal')['credentials']['live_secret'];
                $baseUri    =   'https://api-m-paypal.com';
            }else{
                $clientId   =   config('paypal')['credentials']['sandbox_client'];
                $secret     =   config('paypal')['credentials']['sandbox_secret'];
                $baseUri    =   'https://api-m.sandbox.paypal.com';
            }
        }

        try {
            $this->client       =   new GuzzleClient(['verify' => false,'base_uri' => $baseUri]);
            $this->accessToken  =   $this->getAccessToken($clientId, $secret);
        } catch (\Exception $e) {   $this->accessToken  =   false;  $this->client = false;    }

    }

    public function Verificate(Request $request)
    {
        try 
        {
            
            $verf   =   TransferencePaypal::GeTransferences(auth()->user()->client->client_id);

            $iComp  =   false;
    
            if($verf)
            {
                foreach ($verf as $v => $ver)   {   if( strpos( substr($ver->reference, -5), substr($request->r, -5) ) !== false ){   $iComp  =   true; }  }
                
                if($iComp == true)
                {
                    return response()->json([
                        'success'   =>  false,
                        'message'   => 'El código de referencia ya se encuentra registrado',
                    ],  Response::HTTP_UNAUTHORIZED);
    
                }
            }

            $data   =   $this->CalculatorPaypal($request->a, 2);

            return response()->json([
                'success'   =>  true,
                'iPUSD'     =>  round($data['tInv'],2),
                'cPUSD'     =>  round($data['tCom'], 2),
                'aPUSD'     =>  round($data['tAmo'], 2),
            ],  Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'success'   =>  false,
            ],  Response::HTTP_UNAUTHORIZED);
        }
    }
    
    public function Register(Request $request)
    {
        
        $validator      =   Validator::make($request->all(), [
            'p_asu'         => 'required|min:5',
            'p_date'        => 'required',
            'p_total'       => 'required',
            'p_reference'   => 'required',
            'p_email'       => 'required|min:5',
        ]);
       
        if ($validator->fails()) 
        {   
            return response()->json([
                'success' => false,
                'message' => 'Parametros Incompletos',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $verf   =   TransferencePaypal::GeTransferences(auth()->user()->client->client_id);

        $iComp  =   false;

        if(COUNT(TransferenceFile::SearchFile($request->p_ide)) == 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Para completar la solicitud debe ingresar al menos un archivo adjunto.',
            ], Response::HTTP_UNAUTHORIZED); 
        }
        
        $divisa     =   Scrapers::getLast();
        $type       =   TransferenceType::where([ ['status_id', '=', 1], ['name', 'like', '%dol%'] ])->get()[0];
        $status     =   TransferenceStatus::where([ ['status_id', '=', 1], ['name', 'like', '%pen%'] ])->get()[0];

        $total      =   round( ($request->p_total - ( ($request->p_total * 0.054) + 0.30) ), 2);

        $iData  =   [
            'identified'    =>   $request->p_ide,
            'client_id'     =>   auth()->user()->client->client_id,
            'subject'       =>   $request->p_asu,
            'title'         =>   $request->p_asu,
            'date_trans'    =>   $request->p_date,
            'reference'     =>   $request->p_reference,
            'total'         =>   round( $total, 2),
            'bs'            =>   round( ($total * $divisa->dolar), 2),
            'email'         =>   $request->p_email,
            'description'   =>   ($request->p_message <> '') ? $request->p_message : 'Transference date: '.date("Y-m-d H:m:s").'',
            'type'          =>   $type->id,
            'status'        =>   $status->id,
        ];

        $reg    =   TransferencePaypal::RegisteTrans($iData);
      
        if($reg <> false)
        {
            $user       =   User::find(auth()->user()->id);
            $myWallet   =   $user->getWallet(auth()->user()->identified);

            $transaction    =   $myWallet->depositFloat($iData['total'], 
                [
                    'Description'   =>  $iData['description'],
                    'USD'           =>  $iData['total'],
                    'BS'            =>  $iData['bs'],
                    'DIVISA'        =>  $divisa->dolar,
                ], false);
            
            $iPend   =   [
                'identified'    =>  $request->p_ide,
                'client'        =>  auth()->user()->client->client_id,
                'transaction'   =>  $transaction->id,
                'status'        =>  $status->id,
                'method'        =>  TransferenceMethod::where('name', 'like', '%pay%')->get()[0]->id
            ];

            $pen    =   TransferencePending::RegisteTrans($iPend);

            if($pen <> false)
            {
                return response()->json([
                    'success'   =>  true,
                    'message'   =>  'Datos almacenados correctamente.',
                    'url'       =>  url('/wallet')
                ], Response::HTTP_OK);        

            }else{

                return response()->json([
                    'success' => false,
                    'message' => 'Error al intentar almancenar la informaci&oacute;n, intente nuevamente.',
                ], Response::HTTP_UNAUTHORIZED); 

            }

        }else{

            return response()->json([
                'success' => false,
                'message' => 'Error al intentar almancenar la informaci&oacute;n, intente nuevamente.',
            ], Response::HTTP_UNAUTHORIZED); 
        }

    }

    public function Files(Request $request)
    {
        if($request->file('p_file'))
        {
            try {
                $fileName   =   auth()->user()->client->client_id.'-'.$request->p_ide_f.'-'.time().'.'.$request->file('p_file')->extension();
                $request->file('p_file')->move(public_path('files/paypal'), $fileName);

                $data   =   [
                    'identified'    =>  $request->p_ide_f,
                    'name'          =>  $fileName,
                    'dir'           =>  'files/movil'
                ];

                $res    =   TransferenceFile::RegFile($data);

                if($res <> false)
                {
                    return response()->json([
                        'success'   =>  true,
                        'file'      =>  $fileName,
                        'tp'        =>  3,
                        'id'        =>  $request->p_ide_f
                    ],  Response::HTTP_OK);

                }else{
                    return response()->json([
                        'success'   => false,
                        'file'      => '',
                    ], Response::HTTP_UNAUTHORIZED);
                }    

            } catch (\Throwable $th) {
                return response()->json([
                    'success'   => false,
                    'file'      => '',
                ], Response::HTTP_UNAUTHORIZED);
            }

        }else{
            return response()->json([
                'success'   => false,
                'file'      => 'asdfasf',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function Delete(Request $request)
    {
        try {
            $files  =   TransferenceFile::where('identified', '=', $request->id)->delete();
            
            return response()->json([
                'success'   =>  true,
            ],  Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'file'      => '',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    private function CalculatorPaypal($amount, $ty)
    {

        $por        =   5.4;
        $fee        =   0.3;

        if($ty == 1)
        {
            $tAmo       =   (100 * ($fee + $amount)) / ((0-$por) + 100);
            $tCom       =   ($tAmo - $amount);
            $tGen       =   $amount + $tCom;
            
        }else{
            $tAmo       =   $amount - ((($por * $amount) / 100) + $fee);
            $tCom       =   (($por * $amount) / 100) + $fee;
            $tGen       =   $amount - $tCom;
        }


        $iData      =   [
            'tInv'  =>  ROUND($amount ,2),
            'tCom'  =>  ROUND($tCom, 2),
            'tAmo'  =>  ROUND($tGen, 2)
        ];

        return $iData;
    }
}