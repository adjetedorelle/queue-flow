<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\SuperAdmin;
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
    {   $this->creerClients();
        $this->creerSuperAdmins();
        $this->creerAdmin();
    }

    protected function creerSuperAdmins()
    {
        $user1 = User::create([
            'nom' => "ADJETE",
            'prenom' => "Dorelle",
            'email' => "adjetedorelle@gmail.com",
            'tel' => '1234567',
            'password' => bcrypt('dorelle26'),
            'role' => 'super-admin',
            'email_verified_at' => now()
        ]);

        SuperAdmin::create([
            'utilisateur_id' => $user1->id
        ]);



        $user2 = User::create([
            'nom' => "AKOUETE",
            'prenom' => "Serah",
            'email' => "akoueteserah@gmail.com",
            'tel' => '567894',
            'password' => bcrypt('esenam08'),
            'role' => 'super-admin',
            'email_verified_at' => now()

        ]);

        SuperAdmin::create([
            'utilisateur_id' => $user2->id
        ]);
    }

    protected function creerClients()
    {
         $user1 = User::create([
            'nom' => "SOHOU",
            'prenom' => "Merveille",
            'email' => "merveille@gmail.com",
            'password' => bcrypt('merveille26'),
            'role' => 'client',
            'email_verified_at' => now()
        ]);
   
        Client::create([
            'utilisateur_id' => $user1->id,
             'vip'=> true

        ]);

        $user2 = User::create([
            'nom' => "SOSSA",
            'prenom' => "Mireille",
            'email' => "mireille@gmail.com",
            'password' => bcrypt('mireille26'),
            'role' => 'client',
            'email_verified_at' => now()
        ]);
   
        Client::create([
            'utilisateur_id' => $user2->id,
            'vip'=> true
        ]);
    }

    protected function creerAdmin()
    {
        $user1 = User::create([
            'nom' => "Admin",
            'prenom' => "Main",
            'email' => "admin@gmail.com",
            'tel' => '0000000',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        Admin::create([
            'utilisateur_id' => $user1->id
        ]);

        $user2 = User::create([
            'nom' => "ADMIN",
            'prenom' => "Secondary",
            'email' => "admin2@gmail.com",
            'tel' => '1111111',
            'password' => bcrypt('admin456'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        Admin::create([
            'utilisateur_id' => $user2->id
        ]);

        $user3 = User::create([
            'nom' => "ADMIN",
            'prenom' => "Tertiary",
            'email' => "admin3@gmail.com",
            'tel' => '2222222',
            'password' => bcrypt('admin789'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        Admin::create([
            'utilisateur_id' => $user3->id
        ]);
    }

}
