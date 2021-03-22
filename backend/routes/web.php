<?php

use Illuminate\Support\Facades\Route;

// ログイン時のみアクセス可能な画面グループ
Route::group(['middleware' => 'auth'], function() {
// ユーザーページ
  # ユーザー 食事タスク
  Route::get('/users', 'App\Http\Controllers\UserHomeController@meal_task')->name('user_home
  .meal_task');
  # ユーザー その他タスク
  Route::get('/users/other', 'App\Http\Controllers\UserHomeController@task')->name('user_home
  .task');

// 食事タグ関連
  # タグ一覧ページ
  Route::get('/meal_tags', 'App\Http\Controllers\MealTagController@index')->name('meal_tags.index');
  # タグ毎のタスク一覧ページ！！！！！！
  // Route::get('/meal_tags/{id}', 'App\Http\Controllers\MealTagController@show')->name('meal_tags.show');

// 食事タスク関連
  # タスク作成ページ
  Route::get('/meal_tasks/create', 'App\Http\Controllers\MealTaskController@showCreateForm')->name('meal_tasks.create');
  # タスク作成処理 Create
  Route::post('/meal_tasks/create', 'App\Http\Controllers\MealTaskController@create');
  # タスク編集ページ
  Route::get('/meal_tasks/{id}/edit', 'App\Http\Controllers\MealTaskController@showEditForm')->name('meal_tasks.edit');
  # タスク編集 Update(edit)
  Route::post('/meal_tasks/{id}/edit', 'App\Http\Controllers\MealTaskController@edit');
  # タスク削除
  Route::delete('/meal_tasks/{id}', 'App\Http\Controllers\MealTaskController@delete')->name('meal_tasks.delete');
  # タスク詳細ページ
  Route::get('/meal_tasks/{id}', 'App\Http\Controllers\MealTaskController@show')->name('meal_tasks.show');

// その他タグ関連
  # タグ一覧ページ
  Route::get('/task_tags', 'App\Http\Controllers\TaskTagController@index')->name('task_tags.index');
  # タグ作成
  Route::post('/task_tags/create', 'App\Http\Controllers\TaskTagController@create')->name('task_tags.create');
  # タグ編集
  Route::post('/task_tags/{id}/edit', 'App\Http\Controllers\TaskTagController@edit')->name('task_tags.edit');
  # タグ削除
  Route::delete('/task_tags/{id}', 'App\Http\Controllers\TaskTagController@delete')->name('task_tags.delete');
  # タグ毎のタスク一覧ページ！！！！！
  // Route::get('/meal_tags/{id}', 'App\Http\Controllers\MealTagController@show')->name('meal_tags.show');

// その他タスク関連
  # タスク作成ページ
  Route::get('/tasks/create', 'App\Http\Controllers\TaskController@showCreateForm')->name('tasks.create');
  # タスク作成処理 Create
  Route::post('/tasks/create', 'App\Http\Controllers\TaskController@create');
  # タスク編集ページ
  Route::get('/tasks/{id}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
  # タスク編集 Update(edit)
  Route::post('/tasks/{id}/edit', 'App\Http\Controllers\TaskController@edit');
  # タスク削除
  Route::delete('/tasks/{id}', 'App\Http\Controllers\TaskController@delete')->name('tasks.delete');
  # タスク詳細ページ
  Route::get('/tasks/{id}', 'App\Http\Controllers\TaskController@show')->name('tasks.show');
});

// ユーザー認証機能
Auth::routes();

// ホーム画面
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
