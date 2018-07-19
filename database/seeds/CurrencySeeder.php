<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    \Artisan::call('currency:manage', ['action' => 'add', 'currency' => 'EUR, USD, DKK, UAH']);

	    currency()->update('EUR', ['exchange_rate' => 1]);
	    currency()->update('USD', ['exchange_rate' => 1.16]);
	    currency()->update('DKK', ['exchange_rate' => 7.45]);
	    currency()->update('UAH', ['exchange_rate' => 30.48]);

    }
}
