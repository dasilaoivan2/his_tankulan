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
                'password' => Hash::make('mingkhalifa2'),
                'userrole_id' => '1'
                
            ],
            ['name' => 'Jigs',
                'email' => 'juneljigjimenez@gmail.com',
                'password' => Hash::make('jigs'),
                'userrole_id' => '1'
        
            ],
            ['name' => 'Brgy Tankulan Admin',
                    'email' => 'brgytankulan@gmail.com',
                    'password' => Hash::make('brgytankulan@dmin'),
                    'userrole_id' => '1'
            ],
            ['name' => 'Brgy Tankulan Encoder',
                    'email' => 'brgytankulan.encoder@gmail.com',
                    'password' => Hash::make('encoder123465'),
                    'userrole_id' => '2'
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'userrole_id' => $user['userrole_id'],
            ]);
        }
    }
}
