<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MealTag;
use App\Models\MealTask;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class MealTaskController extends Controller
{
// フォームを表示する-----
# 食事タスク作成フォーム
/**
 * GET /meal_tasks/create
 */
    public function showCreateForm()
    {
        $meal_tags = MealTag::all();
        return view('meal_tasks/create', [
            'meal_tags' => $meal_tags,
        ]);
    }

    public function create(CreateTask $request)
    {
        // 食事タスクモデルのインスタンスを作成する
        $task = new MealTask();

        // 要編集！！！！！！！！
        $task->user_id = 1;

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
        $task->save();

        return redirect()->route('meal_tags.index', []);
    }

# 食事タスク編集フォーム
/**
 * GET /meal_tasks/{id}/edit
 */
    public function showEditForm(int $id)
    {
        $meal_tags = MealTag::all();
        $task = MealTask::find($id);
        $task_date = date("Y年m月d日", strtotime($task->date));
        $task_time = date("H:i", strtotime($task->time));

        return view('meal_tasks/edit', [
            'meal_tags' => $meal_tags,
            'task' => $task,
            'task_date' => $task_date,
            'task_time' => $task_time,
        ]);
    }

    public function edit(int $id, EditTask $request)
    {
        $task = MealTask::find($id);

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
        $task->save();

        // 要編集！！！！！！！！
        return redirect()->route('meal_tags.index');
    }

    // public function show()
    // {
    //     $meal_tasks = MealTask::all();

    //     return view('meal_tasks/show', [
    //         'meal_tasks' => $meal_tasks,
    //     ]);
    // }
}
