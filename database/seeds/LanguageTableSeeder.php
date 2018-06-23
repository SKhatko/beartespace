<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('language')->insert([
		    'code' => 'en',
		    'name' => 'English',
		    'is_rtl' => false,
		    'active' => true,
	    ]);
    }
}
