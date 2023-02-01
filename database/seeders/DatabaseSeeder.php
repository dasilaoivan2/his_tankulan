<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BarangaySeeder::class,
            GenderSeeder::class,
            ProgramSeeder::class,
            CategorySeeder::class,
            PendingcaseSeeder::class,
            FamilyroleSeeder::class,
            ClassificationSeeder::class,
            ZoneSeeder::class,
            TypeSeeder::class
        ]);
    }
}
