<?php

namespace App\Models\Clients\Transference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenceMovil extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(TransferenceStatus::class);     }
    public function type()      {   return $this->belongsTo(TransferenceType::class);       }

    public static function RegisteTrans($data)
    {

        try{
            $new    =   New TransferenceMovil();
            $new->identified    =   $data['identified'];
            $new->client_id     =   $data['client_id'];
            $new->subject       =   strtoupper(trim($data['subject']));
            $new->title         =   strtoupper(trim($data['title']));
            $new->date_trans    =   strtoupper(trim($data['date_trans']));
            $new->dni           =   strtoupper(trim($data['dni']));
            $new->phone         =   strtoupper(trim($data['phone']));
            $new->reference     =   strtoupper(trim($data['reference']));
            $new->total         =   $data['total'];
            $new->bs            =   $data['bs'];
            $new->description   =   strtoupper(trim($data['description']));
            $new->bank_id       =   $data['bank'];
            $new->type_id       =   $data['type'];
            $new->status_id     =   $data['status'];

            return  ( $new->save() ) ? true : false;

        } catch (\Exception $e) {
            return false;
        }
    }

    public static function GetReference($data)
    {
        try {
            $reference  =   TransferenceMovil::where('reference', '=', $data)->first();
            return ($reference != null) ? $reference : false;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public static function GetImage($data)
    {
        try {
            return  TransferenceFile::where('identified', '=', $data)->get();
        } catch (\Exception $e) {
            return false;
        }
    }
}
