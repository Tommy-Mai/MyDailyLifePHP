<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\MealTag;
use App\Models\MealTask;
use App\Models\MealComment;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonMethod;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Storage;

class MealTaskController extends Controller
{
    use CommonMethod;
// フォームを表示する-----
# 食事タスク作成フォーム
/**
 * GET /tasks/create
 */
    public function showCreateForm(Request $request)
    {
        $tags = MealTag::all();

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

        // time変数を作成後にタグを選択しないとエラーになるため、上記で先にtime変数の値を決定する
        // リクエストにタグ情報があるか確認し、デフォルトのタグを設定
        if(!empty($tags->where('id', $request->tag_id)->first())){
            $selected_tag = $request->tag_id;
        }else{
            // リクエストにタグ指定がない場合は、
            // 現在の時刻に応じてデフォルトの食事タグを変更
            if($time >= '06:00' && $time < '11:00'){
                $selected_tag = 1;
            }elseif($time >= '11:00' && $time < '14:30'){
                $selected_tag = 2;
            }elseif($time >= '14:30' && $time < '18:30'){
                $selected_tag = 4;
            }elseif($time >= '18:30' && $time < '22:30'){
                $selected_tag = 3;
            }else{
                $selected_tag = 5;
            }
        }

        // ここから <”タイトル”サジェスト機能>
        // データベースに登録されたタスクのうち、作成日の新しい”タスク名”を配列に保存
        $tasks = Auth::user()->meal_tasks()
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
        $tasks = Auth::user()->meal_tasks()
        ->select('with_whom', 'created_at')
        ->orderBy('date', 'desc')
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
        $tasks = Auth::user()->meal_tasks()
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
            Auth::user()->meal_tasks()->save($task);

            return redirect()->route('meal_tasks.show', ['id' => $id]);
        }else{
            // タスク詳細画面へ
            return redirect()->route('meal_tasks.show', ['id' => $id])
            ->with('message', '保護されているコンテンツです。');
        }
    }

    public function delete(int $id)
    {
        $task = Auth::user()->meal_tasks()->find($id);
        if(!empty($task)){
            if($task->protected == false){
                $comments = $task->meal_comments()->get();
                foreach($comments as $comment){
                    if(!empty($comment->image)){
                        $img = $comment->image;
                        $path = "public/comments/{$img}";
                        Storage::disk('local')->delete($path);
                    }
                }
                MealTask::destroy($id);
                return redirect('/users');
            }else{
                // ユーザー 食事タスクページへ
                return redirect()->route('meal_tasks.show', ['id' => $id])
                ->with('message', '保護されているコンテンツです。');
            }
        }
        return redirect()->route('meal_tasks.show', ['id' => $id])
        ->with('message', 'リクエストの実行に失敗しました。');
    }

    public function show(int $id, Request $request)
    {
        $task = Auth::user()->meal_tasks()->find($id);
        $comments = $task->meal_comments()->get();

        return view('tasks/show', [
            'task' => $task,
            'path' => $request->path(),
            'comments' => $comments,
        ]);
    }
}
