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
        $users = [
            ['name' => 'Ivan Dasilao',
                'email' => 'dasilaoivan2@gmail.com',
                'password' => Hash::make('mingkhalifa2')
                
            ],
            ['name' => 'Jigs',
                'email' => 'juneljigjimenez@gmail.com',
                'password' => Hash::make('jigs')
        
            ],
            ['name' => 'Barangay Tankulan',
                    'email' => 'brgytankulan@gmail.com',
                    'password' => Hash::make('brgytankulan')
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        }
    }
}
