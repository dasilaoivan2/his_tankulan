<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            ['name'=>'4ps'],
            ['name'=>'DA Benificiary'],
            ['name'=>'LGU Scholar']
        ];

        foreach ($programs as $program){
            DB::table('programs')->insert([
                'name' => $program['name']
            ]);
        }
    }
}
