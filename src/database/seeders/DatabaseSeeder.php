<?php

namespace Database\Seeders;

use App\Models\Strengths;
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
        $this->call(SeasonTableSeeder::class);
        $this->call(StrengthsTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(WeekTableSeeder::class);
    }
}
