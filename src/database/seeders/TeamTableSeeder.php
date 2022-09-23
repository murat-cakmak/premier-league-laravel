<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
           Team::insert([
              ['name' => 'Arsenal', 'logo' => 'arsenal.png', 'created_at' => now()],
              ['name' => 'Manchester City', 'logo' => 'manchestercity.png', 'created_at' => now()],
              ['name' => 'Chelsea', 'logo' => 'chelsea.png', 'created_at' => now()],
              ['name' => 'Liverpool', 'logo' => 'liverpool.png', 'created_at' => now()],
           ]);
        });
    }
}
