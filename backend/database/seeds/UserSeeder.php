<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User();
        $user->name = 'Marco Hernandez';
        $user->password = Hash::make('system');
        $user->email = 'marcohern@gmail.com';
        $user->desc = 'Main Administrator and Creator of this website';
        $user->save();
    }
}
