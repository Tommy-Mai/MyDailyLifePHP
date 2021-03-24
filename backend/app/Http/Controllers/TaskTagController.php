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

        if($tag->protected == false){
            // 要素に入力値を代入する
            $tag->name = $request->name;

            // インスタンスの状態をデータベースに書き込む
            // ユーザーに紐付けて保存
            Auth::user()->task_tags()->save($tag);
            return redirect('/task_tags');
        }else{
            // その他タグ一覧ページに戻る
            return redirect('/task_tags')
            ->with('message', '保護されているコンテンツです。');
        }
    }


/**
 * POST(DELETE) /task_tags/{id}
 */
    public function delete(int $id)
    {
        $tag = Auth::user()->task_tags()->find($id);
        if(!empty($tag)){
            if($tag->protected == false){
                TaskTag::destroy($id);
                return redirect('/task_tags');
            }else{
                // その他タグ一覧ページへ遷移
                return redirect('/task_tags')
                ->with('message', '保護されているコンテンツです。');
            }
        }
        return redirect('/task_tags')
        ->with('message', 'リクエストの実行に失敗しました。');
    }
}
