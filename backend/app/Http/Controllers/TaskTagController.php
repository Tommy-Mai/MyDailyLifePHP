<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaskTag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateTag;
use App\Http\Requests\EditTag;

class TaskTagController extends Controller
{
/**
 * GET /task_tags
 */
    public function index()
    {
        $user = Auth::user();
        $tags = $user->task_tags()->get();
        $tasks = $user->tasks()->get();

        return view('task_tags/index', [
            'tags' => $tags,
            'tasks' => $tasks,
        ]);
    }

/**
 * POST /task_tags/create
 */
    public function create(CreateTag $request)
    {
        $tag = new TaskTag();

        // 要素に入力値を代入する
        $tag->name = $request->name;

        // インスタンスの状態をデータベースに書き込む
        // ユーザーに紐付けて保存
        Auth::user()->task_tags()->save($tag);
        return redirect('/task_tags');
    }

/**
 * POST /task_tags/{id}/edit
 */
    public function edit(int $id, EditTag $request)
    {
        $tag = Auth::user()->task_tags()->find($id);

        // 要素に入力値を代入する
        $tag->name = $request->name;

        // インスタンスの状態をデータベースに書き込む
        // ユーザーに紐付けて保存
        Auth::user()->task_tags()->save($tag);

        // その他タグ一覧ページに戻る
        return redirect('/task_tags');
    }


/**
 * POST(DELETE) /task_tags/{id}
 */
    public function delete(int $id)
    {
        if(Auth::user()->task_tags()->find($id)->exists()){
            TaskTag::destroy($id);
        }

        // その他タグ一覧ページへ遷移
        return redirect('/task_tags');
    }
}
