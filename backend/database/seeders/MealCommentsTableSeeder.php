<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meal_comments')->insert([
            'comment' => 'こちらはコメント欄です。\n1つのコメントにつき140文字まで登録できます。',
            'image_exist' => false,
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> true,
            'created_at' => "2021-03-18 09:50:00",
            'updated_at' => Carbon::now(),
        ]);
        DB::table('meal_comments')->insert([
            'comment' => 'コメントには編集機能はなく削除のみ可能です。\nただしデフォルトで登録されているこのページのタスク・コメントは削除できません。',
            'image_exist' => false,
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> true,
            'created_at' => "2021-03-18 09:55:00",
            'updated_at' => Carbon::now(),
        ]);
        DB::table('meal_comments')->insert([
            'comment' => 'コメントには画像を投稿することも可能です。\n投稿できる画像は1ユーザーにつき5枚までに\n制限されています。',
            'image_exist' => false,
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> true,
            'created_at' => "2021-03-18 10:00:00",
            'updated_at' => Carbon::now(),
        ]);
        DB::table('meal_comments')->insert([
            'comment' => '右上のタグ一覧のその他タブの\n＋ボタンをクリックするとオリジナルの\nタグを作成して、\nタスクを登録することもできます。',
            'image_exist' => false,
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> true,
            'created_at' => "2021-03-18 10:05:00",
            'updated_at' => Carbon::now(),
        ]);
        DB::table('meal_comments')->insert([
            'comment' => '是非色々な機能をお試しください。\nまた、ご意見ご感想をいただけますと、\n製作者の励みになります。',
            'image_exist' => false,
            'task_id'=> 1,
            'user_id'=> 1,
            'protected'=> true,
            'created_at' => "2021-03-18 10:10:00",
            'updated_at' => Carbon::now(),
        ]);
    }
}
