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
                'name'=>'wakildirektur',
                'email'=>'wadir@gmail.com',
                'role'=>'wakildirektur',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ], 
            [
                'name'=>'superadmin',
                'email'=>'superadmin@gmail.com',
                'role'=>'superadmin',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'adminprodifarmasi',
                'email'=>'adminprodfarmasi@gmail.com',
                'role'=>'adminprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ], 
            [
                'name'=>'adminprodikimia',
                'email'=>'adminprodkimia@gmail.com',
                'role'=>'adminprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'adminprodianalisiskesehatan',
                'email'=>'adminprodankes@gmail.com',
                'role'=>'adminprodankes',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'adminlabprodifarmasi',
                'email'=>'adminlabprodfarmasi@gmail.com',
                'role'=>'adminlabprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'adminlabprodikimia',
                'email'=>'adminlabprodkimia@gmail.com',
                'role'=>'adminlabprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'adminlabprodianalisiskesehatan',
                'email'=>'adminlabprodankes@gmail.com',
                'role'=>'adminlabprodankes',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'koorlabprodifarmasi',
                'email'=>'koorlabprodfarmasi@gmail.com',
                'role'=>'koorlabprodfarmasi',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'koorlabprodikimia',
                'email'=>'koorlabprodkimia@gmail.com',
                'role'=>'koorlabprodkimia',
                'password'=>bcrypt('password'),
                'avatar'=>'null',
            ],
            [
                'name'=>'koorlabprodianalisiskesehatan',
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
