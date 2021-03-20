<?php

use Illuminate\Support\Facades\Route;

// ログイン時のみアクセス可能な画面グループ
Route::group(['middleware' => 'auth'], function() {
  // ユーザーページ
  Route::get('/users', 'App\Http\Controllers\UserHomeController@meal_task')->name('user_home
  .meal_task');
  // ↑'/users' URL要確認！！！！！！！！！！！！！！！！！！！！

  # 食事タグ一覧ページ
  Route::get('/meal_tags', 'App\Http\Controllers\MealTagController@index')->name('meal_tags.index');
  
  # 食事タグ毎のタスク一覧ページ
  Route::get('/meal_tags/{id}', 'App\Http\Controllers\MealTagController@show')->name('meal_tags.show');
  
  // 食事タスク関連------
  # 食事タスク作成ページ
  Route::get('/meal_tasks/create', 'App\Http\Controllers\MealTaskController@showCreateForm')->name('meal_tasks.create');
  # 食事タスク作成処理 Create
  Route::post('/meal_tasks/create', 'App\Http\Controllers\MealTaskController@create');
  # 食事タスク編集ページ
  Route::get('/meal_tasks/{id}/edit', 'App\Http\Controllers\MealTaskController@showEditForm')->name('meal_tasks.edit');
  # 食事タスク編集 Update(edit)
  Route::post('/meal_tasks/{id}/edit', 'App\Http\Controllers\MealTaskController@edit');

  Route::delete('/tasks/{id}', 'App\Http\Controllers\MealTaskController@remove')->name('meal_tasks.remove');
  
  # ユーザーの食事タスク一覧ページ
  Route::get('/meal_tasks/{id}', 'App\Http\Controllers\MealTaskController@show')->name('meal_tasks.show');
});

// ユーザー認証機能
Auth::routes();

// ホーム画面
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
