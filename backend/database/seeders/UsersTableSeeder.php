<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'テストユーザー',
            'email' => 'sample@example.com',
            'password' => bcrypt('test'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'protected'=> true,
            'last_login_at' => Carbon::now(),
            'last_activity_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'adminuser@development.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'admin'=> true,
            'protected'=> true,
            'last_login_at' => Carbon::now(),
            'last_activity_at' => Carbon::now(),
        ]);
    }
}
