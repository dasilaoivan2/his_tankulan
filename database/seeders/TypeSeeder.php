<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'One-person households'],
            ['name' => 'Households made up of a couple without children'],
            ['name' => 'Households made up of a couple and children'],
            ['name' => 'Lone-parent households'],
            ['name' => 'Households including extended family']
        ];

        foreach($types as $type){
            DB::table('types')->insert([
                'name' => $type['name']
            ]);
        }
    }
}
