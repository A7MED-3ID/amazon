<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // admin
            [
                "name"=>"Admin",
                "email"=>"admin@gmail.com",
                "password"=>Hash::make("admin12345"),
                "role"=>"admin"
            ],

            // vendor
              // admin
              [
                "name"=>"Vendor",
                "email"=>"vendor@gmail.com",
                "password"=>Hash::make("vendor12345"),
                "role"=>"vendor"
              ],

            // user
              
              [
                "name"=>"User",
                "email"=>"user@gmail.com",
                "password"=>Hash::make("user12345"),
                "role"=>"user"

                
            ]
        ]);
    }
}
