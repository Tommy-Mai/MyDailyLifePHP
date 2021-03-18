<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['朝食', '昼食', '夕食', '間食', '飲酒', 'お薬', 'サプリメント'];

        foreach ($names as $name) {
            DB::table('meal_tags')->insert([
                'name' => $name,
            ]);
        }
    }
}
