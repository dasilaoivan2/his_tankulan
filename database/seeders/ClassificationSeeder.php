<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classifications = [
            ['name'=>'Well-Off (Rich)'],
            ['name'=>'Average'],
            ['name'=>'Poor'],
            ['name'=>'Poorest among the Poor']
        ];

        foreach ($classifications as $classification){
            DB::table('classifications')->insert([
                'name' => $classification['name']
            ]);
        }
    }
}
