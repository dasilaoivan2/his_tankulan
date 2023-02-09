<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgebracketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ages = [
            ['name'=>'Children', 'from' => '0', 'to' => '14'],
            ['name'=>'Early working age', 'from' => '15', 'to' => '24'],
            ['name'=>'Prime working age', 'from' => '25', 'to' => '54'],
            ['name'=>'Mature working age', 'from' => '55', 'to' => '64'],
            ['name'=>'Elderly', 'from' => '65', 'to' => '100'],
        ];

        foreach ($ages as $age){
            DB::table('agebrackets')->insert([
                'name' => $age['name'],
                'from' => $age['from'],
                'to' => $age['to']
            ]);
        }
    }
}
