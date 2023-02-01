<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendingcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendingcases = [
            ['name'=>'Thief'],
            ['name'=>'Rape'],
            ['name'=>'Murder']
        ];

        foreach ($pendingcases as $pendingcase){
            DB::table('pendingcases')->insert([
                'name' => $pendingcase['name']
            ]);
        }
    }
}
