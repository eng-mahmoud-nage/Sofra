<?php

use App\User;
use App\General\Setting;
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
        $user = User::all();
        $setting = Setting::all();
        if(!$user){
            $this->call(UsersTableSeeder::class);
        }elseif(!$setting){
            $this->call(SettingsTableSeeder::class);
        }
    }
}
