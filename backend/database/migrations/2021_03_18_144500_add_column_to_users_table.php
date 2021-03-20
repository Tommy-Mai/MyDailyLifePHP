<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->default('icon_penguin.jpg');
            $table->boolean('admin')->default(false);
            $table->boolean('protected')->default(false);
            $table->datetime('last_login_at');
            $table->datetime('last_logout_at')->nullable();
            $table->integer('login_count')->default(0);
            $table->datetime('last_activity_at');
            $table->boolean('logged_in')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('admin');
            $table->dropColumn('protected');
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_logout_at');
            $table->dropColumn('login_count');
            $table->dropColumn('last_activity_at');
            $table->dropColumn('logged_in"');
        });
    }
}
