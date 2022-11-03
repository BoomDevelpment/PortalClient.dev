<?php

namespace Database\Seeders;

use App\Models\Clients\General\Role;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Operator;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status     =   Status::where('name', 'like', '%act%')->first()->id;
        $role       =   Role::where('name', 'like', '%adm%')->first()->id;
        
        $data[0]    =   [
            'name'      =>  strtoupper('admin'),
            'username'  =>  strtolower('admin'),  
            'ext_pr'    =>  0, 
            'ext_vz'    =>  0,
            'ext_us'    =>  0,
            'role'      =>  $role,
            'status'    =>  $status
        ];
        
        $data[1]    =   [
            'name'      =>  strtoupper('Luis Campos'),
            'username'  =>  strtolower('lcampos'),  
            'ext_pr'    =>  0, 
            'ext_vz'    =>  0,
            'ext_us'    =>  0,
            'role'      =>  $role,
            'status'    =>  $status
        ];
        
        foreach ($data as $d => $da) 
        {
            $new    =   New Operator();
            $new->name      =   $da['name'];
            $new->username  =   $da['username'];
            $new->ext_pr    =   $da['ext_pr'];
            $new->ext_vz    =   $da['ext_vz'];
            $new->ext_us    =   $da['ext_us'];
            $new->role_id   =   $da['role'];
            $new->status_id =   $da['status'];

            try {
                $new->save();
            } catch (\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
