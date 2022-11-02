<?php

namespace Database\Seeders;

use App\Models\Clients\Payments\Scrapers;
use Illuminate\Database\Seeder;

use Goutte;

class ScrapersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url        =   'https://www.bcv.org.ve/';

        dd($url);
        $crawler    =   Goutte::request('GET', $url, CURLOPT_SSL_VERIFYPEER, false);
        $euro       =   $crawler->filter('#euro')->each(function ($node){ return    $node->text(); });
        $yuan       =   $crawler->filter('#yuan')->each(function ($node){ return    $node->text(); });
        $lira       =   $crawler->filter('#lira')->each(function ($node){ return    $node->text(); });
        $rublo      =   $crawler->filter('#rublo')->each(function ($node){ return    $node->text(); });
        $dolar      =   $crawler->filter('#dolar')->each(function ($node){ return    $node->text(); });    
                
        $data  =   [
            'euro'  =>  substr( str_replace(',','.',substr($euro[0],'4',  strlen($euro[0]))),   0, -6),
            'yuan'  =>  substr( str_replace(',','.',substr($yuan[0],'4',  strlen($yuan[0]))),   0, -6),
            'lira'  =>  substr( str_replace(',','.',substr($lira[0],'4',  strlen($lira[0]))),   0, -6),
            'rublo' =>  substr( str_replace(',','.',substr($rublo[0],'4', strlen($rublo[0]))),  0, -6),
            'dolar' =>  substr( str_replace(',','.',substr($dolar[0],'4', strlen($dolar[0]))),  0, -6),
        ];

        $new    =   new Scrapers();
        $new->euro      =   $data['euro'];
        $new->yuan      =   $data['yuan'];
        $new->lira      =   $data['lira'];
        $new->rublo     =   $data['rublo'];
        $new->dolar     =   $data['dolar'];
        $new->status_id =   Status::where('name', 'like', '%act%')->first()->id;;

        try {

            $new->save();

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
