<?php

namespace Database\Seeders;

use App\Models\Clients\Country\City;
use App\Models\Clients\Country\Estate;
use App\Models\Clients\Country\Municipality;
use App\Models\Clients\General\Gender;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status         =   Status::where('name', 'like', '%act%')->first()->id;
        $gender         =   Gender::where('name', 'like', '%masc%')->first()->id;
        $estate         =   Estate::where('name', 'like', '%lara%')->first()->id;
        $city           =   City::where('name', 'like', '%barq%')->first()->id;
        $municipality   =   Municipality::where('name', 'like', '%iriba%')->first()->id;

        $data[0]    =   [
            'mikrowisp'         =>  16,
            'name'              =>  strtoupper('Development - Cliente de pruebas'),
            'birthday'          =>  "1985-11-19",
            'address'           =>  strtoupper('avenida libertador, centro metropolitano javier'),
            'estate'            =>  $estate,
            'city'              =>  $city,
            'municipality'      =>  $municipality,
            'latitude'          =>  strtoupper('00.000000'),
            'longitude'         =>  strtoupper('-00.000000'),
            'phone_principal'   =>  strtoupper('584245387921'),
            'phone_alternative' =>  strtoupper('584145659075'),
            'email_principal'   =>  strtolower('luis.924@boomsolutions.com'),
            'email_alternative' =>  strtoupper('jesus.901@boomsolutions.com'),
            'batch'             =>  1,
            'facebook'          =>  strtoupper('boomsolutionsve'),
            'instagram'         =>  strtoupper('boomsolutionsve'),
            'twitter'           =>  strtoupper('boomsolutionsve'),
            'youtube'           =>  strtoupper('boomsolutionsve'),
            'advertising'       =>  strtoupper('si'),
            'gender'            =>  $gender,
            'status'            =>  $status,
        ];

        foreach ($data as $d => $da) 
        {
            $new    =   New Client();
            $new->mikrowisp         =   $da['mikrowisp'];
            $new->name              =   $da['name'];
            $new->birthday          =   $da['birthday'];
            $new->address           =   $da['address'];
            $new->estate_id         =   $da['estate'];
            $new->city_id           =   $da['city'];
            $new->municipality_id   =   $da['municipality'];
            $new->latitude          =   $da['latitude'];
            $new->longitude         =   $da['longitude'];
            $new->phone_principal   =   $da['phone_principal'];
            $new->phone_alternative =   $da['phone_alternative'];
            $new->email_principal   =   $da['email_principal'];
            $new->email_alternative =   $da['email_alternative'];
            $new->batch             =   $da['batch'];
            $new->facebook          =   $da['facebook'];
            $new->instagram         =   $da['instagram'];
            $new->twitter           =   $da['twitter'];
            $new->youtube           =   $da['youtube'];
            $new->advertising       =   $da['advertising'];
            $new->gender_id         =   $da['gender'];
            $new->status_id         =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }

    }
}
