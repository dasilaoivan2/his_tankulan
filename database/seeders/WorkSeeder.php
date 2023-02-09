<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $works = [
            ['name'=>'Farmer'],
            ['name'=>'Housewife'],
            ['name'=>'Government Employee']
        ];

        foreach ($works as $work){
            DB::table('works')->insert([
                'name' => $work['name']
            ]);
        }
    }
}
