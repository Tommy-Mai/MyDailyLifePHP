<?php

use Illuminate\Support\Facades\Route;

// ホーム画面（未認証ユーザーのみアクセス可能）
Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');

// 全てのユーザーがアクセス可能
Route::get('/about_MyDailyLife', 'App\Http\Controllers\AboutWebsiteController@about_mydailylife')->name('home.about_mydailylife');
Route::get('/policy', 'App\Http\Controllers\AboutWebsiteController@policy')->name('home.policy');
Route::get('/privacy_policy', 'App\Http\Controllers\AboutWebsiteController@privacy_policy')->name('home.privacy_policy');
Route::get('/faqs', 'App\Http\Controllers\AboutWebsiteController@faqs')->name('home.faqs');

  // 問い合わせページ
Route::get('/contact', 'App\Http\Controllers\AboutWebsiteController@contact')->name('contact');
Route::post('/contact', 'App\Http\Controllers\AboutWebsiteController@sendContact');

// ログイン時のみアクセス可能な画面グループ
Route::group(['middleware' => 'auth'], function() {
// ユーザーページ
  # ユーザー 食事タスク
  Route::get('/users', 'App\Http\Controllers\UserHomeController@meal_task')->name('user_home.meal_task');
  # ユーザー その他タスク
  Route::get('/users/other', 'App\Http\Controllers\UserHomeController@task')->name('user_home.task');
  // ユーザー メモ
  # メモ一覧
  Route::get('/users/memo', 'App\Http\Controllers\UserHomeController@memo')->name('user_home.memo');
  # メモ作成
  Route::post('/users/memo/create', 'App\Http\Controllers\MemoController@create')->name('memo.create');
  # メモ編集
  Route::post('/users/memo/{id}/edit', 'App\Http\Controllers\MemoController@edit')->name('memo.edit');
  # メモ削除
  Route::delete('/users/memo/{id}', 'App\Http\Controllers\MemoController@delete')->name('memo.delete');

  # ユーザー情報編集ページ
  Route::get('/users/edit', 'App\Http\Controllers\UserHomeController@showEditForm')->name('user_home.edit');
  # ユーザー情報編集 Update(edit)
  Route::post('/users/edit', 'App\Http\Controllers\UserHomeController@edit');
  # ユーザー情報編集ページ
  Route::get('/users/edit/password', 'App\Http\Controllers\UserHomeController@showEditPasswordForm')->name('user_home.edit_password');
  # ユーザー情報編集 Update(edit)
  Route::post('/users/edit/password', 'App\Http\Controllers\UserHomeController@editPassword');

// 食事タグ関連
  # タグ一覧ページ
  Route::get('/meal_tags', 'App\Http\Controllers\MealTagController@index')->name('meal_tags.index');

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

  // 食事タスク コメント関連
  # コメント作成処理 Create
  Route::post('/meal_tasks/{task_id}/comments/create', 'App\Http\Controllers\MealCommentController@create')->name('meal_comments.create');
  # コメント削除
  Route::delete('/meal_tasks/{task_id}/comments/{id}', 'App\Http\Controllers\MealCommentController@delete')->name('meal_comments.delete');

// その他タグ関連
  # タグ一覧ページ
  Route::get('/task_tags', 'App\Http\Controllers\TaskTagController@index')->name('task_tags.index');
  # タグ作成
  Route::post('/task_tags/create', 'App\Http\Controllers\TaskTagController@create')->name('task_tags.create');
  # タグ編集
  Route::post('/task_tags/{id}/edit', 'App\Http\Controllers\TaskTagController@edit')->name('task_tags.edit');
  # タグ削除
  Route::delete('/task_tags/{id}', 'App\Http\Controllers\TaskTagController@delete')->name('task_tags.delete');

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

// その他タスク コメント関連
  # コメント作成処理 Create
  Route::post('/tasks/{task_id}/comments/create', 'App\Http\Controllers\TaskCommentController@create')->name('task_comments.create');
  # コメント削除
  Route::delete('/task_tasks/{task_id}/comments/{id}', 'App\Http\Controllers\TaskCommentController@delete')->name('task_comments.delete');

  // カレンダー
  Route::get('/calendar/month', 'App\Http\Controllers\CalendarController@month')->name('calendar.month');
  Route::get('/calendar/day/meal', 'App\Http\Controllers\CalendarController@dayMeal')->name('calendar.day_meal');
  Route::get('/calendar/day/other', 'App\Http\Controllers\CalendarController@dayOther')->name('calendar.day_other');

// 管理者画面
  Route::get('/admin/users_index', 'App\Http\Controllers\AdminUserController@usersIndex')->name('admin.users_index');
// 管理者画面
  Route::delete('/admin/{id}/users_delete', 'App\Http\Controllers\AdminUserController@delete')->name('admin.users_delete');
});

// ユーザー認証機能
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
