<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MealTag;
use App\Models\MealTask;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class MealTaskController extends Controller
{
// フォームを表示する-----
# 食事タスク作成フォーム
/**
 * GET /tasks/create
 */
    public function showCreateForm(Request $request)
    {
        $tags = MealTag::all();
        return view('tasks/create', [
            'tags' => $tags,
            'path' => $request->path(),
        ]);
    }

    public function create(CreateTask $request)
    {
        // 食事タスクモデルのインスタンスを作成する
        $task = new MealTask();

        // 各要素に入力値を代入する
        $task->name = $request->name;
        $task->description = $request->description;
        $task->tag_id = $request->tag_id;
        $task->with_whom = $request->with_whom;
        $task->where = $request->where;
        // 入力値をdate型に変換
        $date = str_replace("年","-",$request->date);
        $date = str_replace("月","-",$date);
        $date = str_replace("日","",$date);
        $task->date = date("Y-m-d", strtotime($date));
        $task->time = date("H:i:00", strtotime($request->time));
        // インスタンスの状態をデータベースに書き込む
        // ユーザーに紐付けて保存
        Auth::user()->meal_tasks()->save($task);

        return redirect('/users');
    }

# 食事タスク編集フォーム
/**
 * GET /meal_tasks/{id}/edit
 */
    public function showEditForm(int $id, Request $request)
    {
        $tags = MealTag::all();
        $task = Auth::user()->meal_tasks()->find($id);
        $task_date = date("Y年m月d日", strtotime($task->date));
        $task_time = date("H:i", strtotime($task->time));

        return view('tasks/edit', [
            'tags' => $tags,
            'task' => $task,
            'task_date' => $task_date,
            'task_time' => $task_time,
            'path' => $request->path(),
        ]);
    }

    public function edit(int $id, EditTask $request)
    {
        $task = Auth::user()->meal_tasks()->find($id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->tag_id = $request->tag_id;
        $task->with_whom = $request->with_whom;
        $task->where = $request->where;
        // 入力値をdate型に変換
        $date = str_replace("年","-",$request->date);
        $date = str_replace("月","-",$date);
        $date = str_replace("日","",$date);
        $task->date = date("Y-m-d", strtotime($date));
        $task->time = date("H:i:00", strtotime($request->time));
        // インスタンスの状態をデータベースに書き込む
        // ユーザーに紐付けて保存
        Auth::user()->meal_tasks()->save($task);

        // タスク詳細画面へリダイレクト
        return redirect()->route('meal_tasks.show', ['id' => $id]);
    }

    public function delete(int $id)
    {
        if(Auth::user()->meal_tasks()->find($id)->exists()){
            MealTask::destroy($id);
        }

        // ユーザー 食事タスクページへ遷移
        return redirect('/users');
    }

    public function show(int $id, Request $request)
    {
        $task = Auth::user()->meal_tasks()->find($id);

        return view('tasks/show', [
            'task' => $task,
            'path' => $request->path(),
        ]);
    }
}
