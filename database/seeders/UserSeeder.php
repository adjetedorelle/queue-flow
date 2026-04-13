<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom'=>"ADJETE",
            'prenom'=>"Dorelle",
            'email'=>"adjetedorelle@gmail.com",
            'tel'=>'1234567',
            'password'=>bcrypt('dorelle26'),
            'role'=>'super-admin',
            'email_verified_at'=>now()
        ]);

        User::create([
            'nom'=>"AKOUETE",
            'prenom'=>"Serah",
            'email'=>"akoueteserah@gmail.com",
            'tel'=>'567894',
            'password'=>bcrypt('esenam08'),
            'role'=>'super-admin',
            'email_verified_at'=>now()

        ]);
    }
}
