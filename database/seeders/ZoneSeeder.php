<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = [
            ['name'=>'Zone 1 - Centro', 'barangay_id' => '21'],
            ['name'=>'Zone 2A - Upper Sosohon', 'barangay_id' => '21'],
            ['name'=>'Zone 2B - Lower Sosohon', 'barangay_id' => '21'],
            ['name'=>'Zone 3 - Proper Calanawan', 'barangay_id' => '21'],
            ['name'=>'Zone 3A - Upper Calanawan', 'barangay_id' => '21'],
            ['name'=>'Zone 3B - Lower Calanawan', 'barangay_id' => '21'],
            ['name'=>'Zone 4A - Lower Kihare', 'barangay_id' => '21'],
            ['name'=>'Zone 4B - Upper Kihare', 'barangay_id' => '21'],
            ['name'=>'Zone 5A - Upper Pol-oton', 'barangay_id' => '21'],
            ['name'=>'Zone 5B - Lower Pol-oton', 'barangay_id' => '21'],
            ['name'=>'Mangima', 'barangay_id' => '21'],
            ['name'=>'St. Joseph Village', 'barangay_id' => '21'],
            ['name'=>'Mulberry Village', 'barangay_id' => '21'],
            ['name'=>'Sitio Tomampong', 'barangay_id' => '21']
        ];

        foreach ($zones as $zone){
            DB::table('zones')->insert([
                'name' => $zone['name'],
                'barangay_id' => $zone['barangay_id'],
            ]);
        }
    }
}
