<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brgys = [
            ['name'=>'Agusan Canyon'],
            ['name'=>'Alae'],
            ['name'=>'Dahilayan'],
            ['name'=>'Dalirig'],
            ['name'=>'Damilag'],
            ['name'=>'Dicklum'],
            ['name'=>'Guilang-guilang'],
            ['name'=>'Kalugmanan'],
            ['name'=>'Lindaban'],
            ['name'=>'Lingion'],
            ['name'=>'Lunocan'],
            ['name'=>'Maluko'],
            ['name'=>'Mambatangan'],
            ['name'=>'Mampayag'],
            ['name'=>'Mantibugao'],
            ['name'=>'Minsuro'],
            ['name'=>'San Miguel'],
            ['name'=>'Sankanan'],
            ['name'=>'Santiago'],
            ['name'=>'Sto. Nino'],
            ['name'=>'Tankulan'],
            ['name'=>'Ticala']
        ];

        foreach ($brgys as $brgy){
            DB::table('barangays')->insert([
                'name' => $brgy['name']
            ]);
        }
    }
}
