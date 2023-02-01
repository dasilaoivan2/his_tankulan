<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name'=>'Head of the Family'],
            ['name'=>'Member']
        ];

        foreach ($roles as $role){
            DB::table('familyroles')->insert([
                'name' => $role['name']
            ]);
        }
    }
}
