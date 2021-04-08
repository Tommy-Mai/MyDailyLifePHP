<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\TaskTag;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonMethod;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use CommonMethod;
// フォームを表示する-----
# その他タスク作成フォーム
/**
 * GET /tasks/create
 */
    public function showCreateForm(Request $request)
    {
        $tags = Auth::user()->task_tags()->get();

        // リクエストにタグ情報があるか確認し、デフォルトのタグを設定
        if(!empty(Auth::user()->task_tags()->where('id', $request->tag_id)->first())){
            $selected_tag = $request->tag_id;
        }else{
            $selected_tag = null;
        }

        // リクエストに日付があるか確認し、デフォルトの日付を判定
        $date = $request->date;
        if(!empty($date)){
            $date = Carbon::createFromDate($date);
        }else{
            $date = Carbon::createFromDate();
        }
        
        $date = date("Y年m月d日", strtotime($date));

        // 現在の時刻をデフォルトの時刻として表示
        $time = Carbon::createFromDate();
        $time = date("H:i", strtotime($time));

        // ここから <”タイトル”サジェスト機能>
        // データベースに登録されたタスクのうち、作成日の新しい”タスク名”を配列に保存
        $tasks = Auth::user()->tasks()
        ->select('name', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();

        $tmp= [];
        $suggestTaskNames = [];
        foreach ($tasks as $task){
            if (!in_array($task->name, $tmp)) {
                $tmp[] = $task->name;
                $suggestTaskNames[] = $task;
            }
        }
        //  データ数を5つに絞り込み
        $suggestTaskNames = array_slice($suggestTaskNames , 0, 5);
        //  ここまで <”タイトル”サジェスト機能>

        // ここから <”誰と”サジェスト機能>
        // データベースに登録されたタスクのうち、作成日の新しい”誰と”を配列に保存
        $tasks = Auth::user()->tasks()
        ->select('with_whom', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();

        $tmp = [];
        $suggestWithWhom = [];
        foreach ($tasks as $task){
            if (!in_array($task->with_whom, $tmp)) {
                $tmp[] = $task->with_whom;
                $suggestWithWhom[] = $task;
            }
        }
        //  データ数を5つに絞り込み
        $suggestWithWhom = array_slice($suggestWithWhom , 0, 5);
        //  ここまで <”誰と”サジェスト機能>

        // ここから <”どこで”サジェスト機能>
        // データベースに登録されたタスクのうち、作成日の新しい”どこで”を配列に保存
        $tasks = Auth::user()->tasks()
        ->select('where', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();

        $tmp = [];
        $suggestWhere = [];
        foreach ($tasks as $task){
            if (!in_array($task->where, $tmp)) {
                $tmp[] = $task->where;
                $suggestWhere[] = $task;
            }
        }
        //  データ数を5つに絞り込み
        $suggestWhere = array_slice($suggestWhere , 0, 5);
        //  ここまで <”どこで”サジェスト機能>

        return view('tasks/create', [
            'tags' => $tags,
            'path' => $request->path(),
            'date' => $date,
            'time' => $time,
            'selected_tag' => $selected_tag,
            'tasks' => $suggestTaskNames,
            'suggest_with_whom_list' => $suggestWithWhom,
            'suggest_where_list' => $suggestWhere,
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

        if($task->protected == false){
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

            return redirect()->route('tasks.show', ['id' => $id]);
        }else{
            // タスク詳細画面へリダイレクト
            return redirect()->route('tasks.show', ['id' => $id])
            ->with('message', '保護されているコンテンツです。');
        }
    }

    public function delete(int $id)
    {
        $task = Auth::user()->tasks()->find($id);
        if(!empty($task)){
            if($task->protected == false){
                $comments = $task->task_comments()->get();
                foreach($comments as $comment){
                    if(!empty($comment->image)){
                        $img = $comment->image;
                        $path = "public/comments/{$img}";
                        Storage::disk('local')->delete($path);
                    }
                }
                Task::destroy($id);
                return redirect('/users/other');
            }else{
                // ユーザー その他タスクページへ遷移
                return redirect()->route('tasks.show', ['id' => $id])
                ->with('message', '保護されているコンテンツです。');
            }
        }
        return redirect()->route('tasks.show', ['id' => $id])
        ->with('message', 'リクエストの実行に失敗しました。');
    }

    public function show(int $id, Request $request)
    {
        $task = Auth::user()->tasks()->find($id);
        $comments = $task->task_comments()->get();

        return view('tasks/show', [
            'task' => $task,
            'path' => $request->path(),
            'comments' => $comments,
        ]);
    }
}
