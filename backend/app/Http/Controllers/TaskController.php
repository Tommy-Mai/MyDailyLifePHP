<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaskTag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    
// フォームを表示する-----
# その他タスク作成フォーム
/**
 * GET /tasks/create
 */
    public function showCreateForm(Request $request)
    {
        $tags = Auth::user()->task_tags()->get();
        return view('tasks/create', [
            'tags' => $tags,
            'path' => $request->path(),
        ]);
    }

    public function create(CreateTask $request)
    {
        // 食事タスクモデルのインスタンスを作成する
        $task = new Task();

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
        Auth::user()->tasks()->save($task);

        return redirect('/users/other');
    }

    # タスク編集フォーム
    /**
    * GET /tasks/{id}/edit
    */
    public function showEditForm(int $id, Request $request)
    {
        $tags = Auth::user()->task_tags()->get();
        $task = Auth::user()->tasks()->find($id);
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
        $task = Auth::user()->tasks()->find($id);

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
        Auth::user()->tasks()->save($task);

        // タスク詳細画面へリダイレクト
        return redirect()->route('tasks.show', ['id' => $id]);
    }

    public function delete(int $id)
    {
        Task::destroy($id);

        // ユーザー その他タスクページへ遷移
        return redirect('/users/other');
    }

    public function show(int $id, Request $request)
    {
        $task = Auth::user()->tasks()->find($id);

        return view('tasks/show', [
            'task' => $task,
            'path' => $request->path(),
        ]);
    }
}
