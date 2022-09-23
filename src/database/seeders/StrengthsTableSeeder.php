<?php

namespace Database\Seeders;

use App\Models\Strengths;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrengthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            Strengths::insert([
               ['team_id' => 1, 'is_home' => 1,'strengths' => 'strong', 'created_at' => now()],
               ['team_id' => 1, 'is_home' => 0,'strengths' => 'average', 'created_at' => now()],
               ['team_id' => 2, 'is_home' => 1,'strengths' => 'strong', 'created_at' => now()],
               ['team_id' => 2, 'is_home' => 0,'strengths' => 'average', 'created_at' => now()],
               ['team_id' => 3, 'is_home' => 1,'strengths' => 'average', 'created_at' => now()],
               ['team_id' => 3, 'is_home' => 0,'strengths' => 'weak', 'created_at' => now()],
               ['team_id' => 4, 'is_home' => 1,'strengths' => 'weak', 'created_at' => now()],
               ['team_id' => 4, 'is_home' => 0,'strengths' => 'weak', 'created_at' => now()],
           ]);
        });
    }
}
