<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 50,
            'name' => 'デモ用ユーザー',
            'email' => 'test@test.com',
            'password' => bcrypt('test'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'protected'=> true,
        ]);

        foreach (range(50, 64) as $num) {
            DB::table('task_tags')->insert([
                'id' => $num,
                'name' => "タグ".$num,
                'user_id' => 50,
                'protected' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach (range(1, 10) as $num) {
            DB::table('tasks')->insert([
                'name' => "サンプルタスク".$num,
                'description' => "サンプルタスク詳細".$num,
                'date' => Carbon::now()->addDay($num),
                'tag_id' => 49 + $num,
                'user_id' => 50,
                'with_whom' => "{$num}人",
                'where' => "場所{$num}",
                'time' => Carbon::now(),
                'protected' => false,
                'created_at' => Carbon::now()->addDay($num),
                'updated_at' => Carbon::now()->addDay($num),
            ]);
        }

        foreach (range(1, 7) as $num) {
            DB::table('meal_tasks')->insert([
                'name' => "サンプル食事タスク".$num,
                'description' => "サンプル食事タスク詳細".$num,
                'date' => Carbon::now()->addDay($num),
                'tag_id' => $num,
                'user_id' => 50,
                'with_whom' => "{$num}人",
                'where' => "場所{$num}",
                'time' => Carbon::now(),
                'protected' => false,
                'created_at' => Carbon::now()->addDay($num),
                'updated_at' => Carbon::now()->addDay($num),
            ]);
        }

        foreach (range(1, 7) as $num) {
            DB::table('memos')->insert([
                'name' => "メモ機能について".$num,
                'description' => "サンプルメモ".$num,
                'user_id' => 50,
                'protected' => false,
                'created_at' => Carbon::now()->addDay($num),
                'updated_at' => Carbon::now()->addDay($num),
            ]);
        }
    }
}
