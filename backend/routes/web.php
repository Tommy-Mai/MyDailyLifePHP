<?php

use Illuminate\Support\Facades\Route;

Route::get('/meal_tags', 'App\Http\Controllers\MealTagController@index')->name('mealTags.index');

Route::get('/meal_tags/{id}', 'App\Http\Controllers\MealTagController@show')->name('mealTags.show');

// Route::get('/meal_tasks/{id}', 'MealTagController@show')->name('mealTasks.show');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
