<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['name'=>'Concrete'],
            ['name'=>'Semi or Half Concrete'],
            ['name'=>'Made up of Light Materials'],
            ['name'=>'Salvaged house']
        ];

        foreach ($materials as $material){
            DB::table('materials')->insert([
                'name' => $material['name']
            ]);
        }
    }
}
