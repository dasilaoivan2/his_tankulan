<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitizentypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name'=>'Transient'],
            ['name'=>'Permanent']
        ];

        foreach ($types as $type){
            DB::table('citizentypes')->insert([
                'name' => $type['name']
            ]);
        }
    }
}
