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

        foreach (range(1, 3) as $num) {
            DB::table('meal_tasks')->insert([
                'name' => "サンプルタスク".$num,
                'description' => "サンプルタスク詳細".$num,
                'date' => Carbon::now()->addDay($num),
                'tag_id' => $num,
                'user_id' => $user->id,
                'with_whom' => "{$num}人",
                'where' => "",
                'time' => Carbon::now(),
                'protected' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
