<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Wakil Direktur',
                'email'=>'wadir@gmail.com',
                'role'=>'wakildirektur',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ], 
            [
                'name'=>'Superadmin',
                'email'=>'superadmin@gmail.com',
                'role'=>'superadmin',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Admin Prodi Farmasi',
                'email'=>'adminprodfarmasi@gmail.com',
                'role'=>'adminprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ], 
            [
                'name'=>'Admin Prodi Kimia',
                'email'=>'adminprodkimia@gmail.com',
                'role'=>'adminprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Admin Prodi Analisis Kesehatan',
                'email'=>'adminprodankes@gmail.com',
                'role'=>'adminprodankes',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Admin Lab Prodi Farmasi',
                'email'=>'adminlabprodfarmasi@gmail.com',
                'role'=>'adminlabprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Admin Lab Prodi Kimia',
                'email'=>'adminlabprodkimia@gmail.com',
                'role'=>'adminlabprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Admin Lab Prodi Analisis Kesehatan',
                'email'=>'adminlabprodankes@gmail.com',
                'role'=>'adminlabprodankes',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Koor Lab Prodi Farmasi',
                'email'=>'koorlabprodfarmasi@gmail.com',
                'role'=>'koorlabprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Koor Lab Prodi Kimia',
                'email'=>'koorlabprodkimia@gmail.com',
                'role'=>'koorlabprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'Koor Lab Prodi Analisis Kesehatan',
                'email'=>'koorlabprodankes@gmail.com',
                'role'=>'koorlabprodankes',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
