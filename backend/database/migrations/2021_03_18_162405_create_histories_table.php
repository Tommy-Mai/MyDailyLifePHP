<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->datetime('login_at')->nullable();
            $table->datetime('logout_at')->nullable();
            $table->string("used_time")->nullable();
            $table->datetime('last_activity_at')->nullable();
            $table->boolean('timeout')->default(false);
            $table->datetime('timeout_time')->nullable();
            $table->integer('action_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
