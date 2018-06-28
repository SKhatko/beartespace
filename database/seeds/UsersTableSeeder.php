<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Stanislav',
            'last_name' => 'Khatko',
            'email' => 's.a.hatko@gmail.com',
            'user_name' => 'admin',
            'password' => bcrypt('123456'),
            'gender' => 'male',
            'user_type' => 'admin',
        ]);

	    factory(App\User::class, 100)->create();

    }
}
