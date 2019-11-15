<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atendente = User::create([
            'name' => 'atendente',
            'email' => 'atendente@gmail.com',
            'password' => bcrypt('123456789'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now()
        ]);

        $atendente->assignRole('Atendente');


        $admin = User::create([
            'name' => 'cristiano',
            'email' => 'crjstjanojose@gmail.com',
            'password' => bcrypt('025365'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now()
        ]);
        $admin->assignRole('Administrador');
    }
}
