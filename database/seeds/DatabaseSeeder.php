<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(TestingSeeder::class);
        $this->call(OptionsTableSeeder::class);
    }
}
