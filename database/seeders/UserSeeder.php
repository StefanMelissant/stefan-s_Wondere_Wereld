<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Voorbeeld Gebruiker',
            'email' => 'voorbeeld@gebruiker.com',
            'password' => Hash::make('wachtwoord'),
            'token' => Str::random(60),
        ]);


    }
}
