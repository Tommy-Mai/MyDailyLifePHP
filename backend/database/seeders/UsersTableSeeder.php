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
        ]);
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'admin-user@mydailylifephp.com',
            'password' => bcrypt('8d0ajI3O9hrs'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'admin'=> true,
            'protected'=> true,
        ]);
    }
}
