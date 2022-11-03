<?php

namespace Database\Seeders;

use App\Models\Clients\Pivot\ClientUser;
use App\Models\Clients\Pivot\OperatorUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(OperatorSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(UserSeeder::class);
        
        $this->call(WalletSeeder::class);      
        
        $this->call(ClientUserSeeder::class);
        $this->call(OperatorUserSeeder::class);

        $this->call(AccountBankEntitySeeder::class);
        $this->call(AccountBankTypeSeeder::class);

        $this->call(AccountBankSeeder::class);

        $this->call(CreditCardEntitySeeder::class);
        $this->call(CreditCardTypeSeeder::class);

        $this->call(CreditCardSeeder::class);
        
        $this->call(ScrapersSeeder::class);
        
        $this->call(TransferenceStatusSeeder::class);
        $this->call(TransferenceMethodSeeder::class);
        $this->call(TransferenceTypeSeeder::class);
        
        $this->call(TransferenceZelleSeeder::class);
        $this->call(TransferencePaypalSeeder::class);
        $this->call(TransferenceBankSeeder::class);
        $this->call(TransferenceMovilSeeder::class);

        $this->call(InvoicesStatusSeeder::class);
        $this->call(InvoicesTypeSeeder::class);
        
        $this->call(PaypalSeeder::class);
        
        $this->call(VoucherSeeder::class);        
        
        $this->call(DonativeImageSeeder::class);
        $this->call(DonativeVideoSeeder::class);
        $this->call(DonativeRegisterSeeder::class);        

    }
}
