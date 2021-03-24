<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_comments')->insert([
            'comment' => 'テストコメント',
            'image' => '',
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('task_comments')->insert([
            'comment' => '',
            'image' => 'icon_penguin.jpg',
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
