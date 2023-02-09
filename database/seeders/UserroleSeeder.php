<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name'=>'Admin'],
            ['name'=>'Encoder']
        ];

        foreach ($roles as $role){
            DB::table('Userroles')->insert([
                'name' => $role['name']
            ]);
        }
    }
}
