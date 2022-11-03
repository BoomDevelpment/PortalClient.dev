<?php

namespace App\Models\Clients\Transference;

use App\Models\Clients\General\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenceStatus extends Model
{
    use HasFactory;

    public function status()        {   return $this->belongsTo(Status::class);             }
    public function zelle()         {   return $this->hasOne(TransferenceZelle::class);     }
    public function paypal()        {   return $this->hasOne(TransferencePaypal::class);    }
    public function transference()  {   return $this->hasOne(TransferenceBank::class);      }
    public function movil()         {   return $this->hasOne(TransferenceMovil::class);     }

}
