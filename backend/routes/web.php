<?php

use Illuminate\Support\Facades\Route;

Route::get('/meal_tags', 'App\Http\Controllers\MealTagController@index')->name('meal_tags.index');

Route::get('/meal_tags/{id}', 'App\Http\Controllers\MealTagController@show')->name('meal_tags.show');

Route::get('/meal_tasks/{id}', 'App\Http\Controllers\MealTagController@show')->name('meal_tasks.show');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
