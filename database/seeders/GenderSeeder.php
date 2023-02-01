<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['name'=>'Male'],
            ['name'=>'Female']
        ];

        foreach ($genders as $gender){
            DB::table('genders')->insert([
                'name' => $gender['name']
            ]);
        }
    }
}
