<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ownerships = [
            ['name'=>'Owned'],
            ['name'=>'Rented']
        ];

        foreach ($ownerships as $ownership){
            DB::table('ownerships')->insert([
                'name' => $ownership['name']
            ]);
        }
    }
}
