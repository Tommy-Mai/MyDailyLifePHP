<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description')->nullable();
            $table->date('date');
            $table->foreignId('tag_id')
                ->constrained('meal_tags')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('with_whom', 30)->nullable();
            $table->string('where', 30)->nullable();
            $table->time('time');
            $table->boolean('protected')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_tasks');
    }
}
