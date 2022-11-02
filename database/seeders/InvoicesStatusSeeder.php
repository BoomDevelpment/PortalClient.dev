<?php

namespace Database\Seeders;

use App\Models\Clients\General\Status;
use App\Models\Clients\Invoices\InvoicesStatus;
use Illuminate\Database\Seeder;

class InvoicesStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;

        $data[0]   =  ["name"  =>  "pagado",    "status" => $status];
        $data[1]   =  ["name"  =>  "no pagado", "status" => $status];
        $data[2]   =  ["name"  =>  "cancelado", "status" => $status];
        
        foreach ($data as $d => $da) 
        {
            $new    = New InvoicesStatus();
            $new->name          =   $da['name'];
            $new->status_id     =   $da['status'];
            
            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }

        }
    }
}
