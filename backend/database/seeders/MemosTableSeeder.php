<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first();

        DB::table('memos')->insert([
            'name' => "メモ機能について",
            'description' => "このメモ機能は「タイトル」と「詳細」のみを記録するシンプルな機能です。\n「何時・どこで・誰と・経過」なども記録できる食事・その他タスク機能と違い、シンプルな記録機能にですので名前の通り「メモ」として覚えておきたい事柄を書き留めておくなどの用途にお使いいただくことに適しています。",
            'user_id' => $user->id,
            'protected' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
