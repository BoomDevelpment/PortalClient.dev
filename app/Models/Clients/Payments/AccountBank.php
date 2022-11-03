<?php

namespace App\Models\Clients\Payments;

use App\Helpers\DataCypher;
use App\Models\Clients\General\Bank;
use App\Models\Clients\General\Status;
use App\Models\Clients\Profile\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBank extends Model
{
    use HasFactory;

    public function status()    {   return $this->belongsTo(Status::class);             }
    public function bank()      {   return $this->belongsTo(Bank::class);               }
    public function type()      {   return $this->belongsTo(AccountBankType::class);    }
    public function entity()    {   return $this->belongsTo(AccountBankEntity::class);  }
    public function client()    {   return $this->belongsTo(Client::class);             }

    public static function RegisterData($data)
    {

        $kCy    =   bin2hex(random_bytes(16));
        $key    =   bin2hex(random_bytes(16));
        
        $cy     =   new DataCypher($key);

        $new                =   new AccountBank();
        $new->name          =   strtoupper($data['name']);
        $new->last          =   strtoupper($data['last']);
        $new->cypher        =   $cy->CypherData(json_encode($data['cypher']), $kCy)['cypher'];
        $new->keygen        =   $key;
        $new->key_id        =   AccountBankKey::Register($cy->CypherData(json_encode($kCy), $key), $key);
        $new->type_id       =   strtoupper($data['type_id']);
        $new->entity_id     =   strtoupper($data['entity_id']);
        $new->bank_id       =   strtoupper($data['bank_id']);
        $new->status_id     =   strtoupper($data['status_id']);
        $new->client_id     =   strtoupper($data['client_id']);

        try {
            return  ( $new->save() ) ? true : false;
        } catch (\Exception $e) {
            return false;
        }

    }
}
