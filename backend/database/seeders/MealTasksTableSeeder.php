<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first();
        DB::table('meal_tasks')->insert([
            'name' => "MyDailyLifeへようこそ",
            'description' => "詳細は140文字まで登録できます。「タイトル・どこで・誰と」は30文字までです。",
            'date' => Carbon::now(),
            'tag_id' => 1,
            'user_id' => 1,
            'with_whom' => "任意で記入",
            'where' => "任意で記入",
            'time' => Carbon::now(),
            'protected' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
