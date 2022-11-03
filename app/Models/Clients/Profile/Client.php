<?php

namespace App\Models\Clients\Profile;

use App\Models\Clients\General\Gender;
use App\Models\Clients\General\Status;
use App\Models\Clients\Payments\CreditCard;
use App\Models\Clients\Pivot\ClientUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);             }
    public function gender()    {   return $this->belongsTo(Gender::class);             }    
    public function clientab()  {   return $this->hasOne(AccountBank::class);           }
    public function clientcc()  {   return $this->hasOne(CreditCard::class);            }
}
