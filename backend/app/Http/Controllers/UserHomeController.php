<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MealTag;
use App\Models\MealTask;
use App\Models\TaskTag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    use CommonMethod;
    public function meal_task(Request $request)
    {
        $user = Auth::user();
        $tags = MealTag::all();
        $user_id = $user->id;

    // タスク検索機能
        $query = MealTask::query();
        $query->where('user_id', $user_id);

        // 入力値をdate型に変換
        $from_date = str_replace("年","-",$request->from_date);
        $from_date = str_replace("月","-",$from_date);
        $from_date = str_replace("日","",$from_date);
        $from_date = date("Y-m-d", strtotime($from_date));
        $to_date = str_replace("年","-",$request->to_date);
        $to_date = str_replace("月","-",$to_date);
        $to_date = str_replace("日","",$to_date);
        $to_date = date("Y-m-d", strtotime($to_date));

        //$request->input()で検索時に入力した項目を取得します。
        $search_name = $request->name;
        $search_description = $request->description;
        $search_tag_id = $request->tag_id;
        $search_with_whom = $request->with_whom;
        $search_where = $request->where;

        // 入力値のある各条件で検索
        if(!empty($search_tag_id)){
            $query->where('tag_id', $search_tag_id);
        }

        if(!empty($search_name)){
            $query->where('name', 'like', '%'.$search_name.'%');
        }

        if(!empty($search_description)){
            $query->where('description', 'like', '%'.$search_description.'%');
        }

        if(!empty($search_with_whom)){
            $query->where('with_whom', 'like', '%'.$search_with_whom.'%');
        }

        if(!empty($search_where)){
            $query->where('where', 'like', '%'.$search_where.'%');
        }

        if(!empty($from_date)){
            $query->whereDate('date', '>=',$from_date);
        };

        $from_not_empty = !empty($request->from_date);
        $to_not_empty = !empty($request->to_date);
        if($from_not_empty && $to_not_empty){
            $query->whereDate('date', '>=',$from_date)->whereDate('date', '<=',$to_date);
        }elseif($from_not_empty){
            $query->whereDate('date', '>=',$from_date);
        }elseif($to_not_empty){
            $query->whereDate('date', '<=',$to_date);
        }

        $tasks = $query->get();

        // 1ページにつき5件ずつ表示させます
        // $tasks = $query->paginate(5);

    // Viewを表示
        return view('user_home/meal_task', [
            'user' => $user,
            'tasks' => $tasks,
            'tags' => $tags,
            'path' => $request->path(),
        ]);
    }

    public function task(Request $request)
    {
        $user = Auth::user();
        $tags = $user->task_tags()->get();
        $user_id = $user->id;

    // タスク検索機能
        $query = Task::query();
        $query->where('user_id', $user_id);

        // 入力値をdate型に変換
        $from_date = str_replace("年","-",$request->from_date);
        $from_date = str_replace("月","-",$from_date);
        $from_date = str_replace("日","",$from_date);
        $from_date = date("Y-m-d", strtotime($from_date));
        $to_date = str_replace("年","-",$request->to_date);
        $to_date = str_replace("月","-",$to_date);
        $to_date = str_replace("日","",$to_date);
        $to_date = date("Y-m-d", strtotime($to_date));

        //$request->input()で検索時に入力した項目を取得します。
        $search_name = $request->name;
        $search_description = $request->description;
        $search_tag_id = $request->tag_id;
        $search_with_whom = $request->with_whom;
        $search_where = $request->where;

        // 入力値のある各条件で検索
        if(!empty($search_tag_id)){
            $query->where('tag_id', $search_tag_id);
        }

        if(!empty($search_name)){
            $query->where('name', 'like', '%'.$search_name.'%');
        }

        if(!empty($search_description)){
            $query->where('description', 'like', '%'.$search_description.'%');
        }

        if(!empty($search_with_whom)){
            $query->where('with_whom', 'like', '%'.$search_with_whom.'%');
        }

        if(!empty($search_where)){
            $query->where('where', 'like', '%'.$search_where.'%');
        }

        if(!empty($from_date)){
            $query->whereDate('date', '>=',$from_date);
        };

        $from_not_empty = !empty($request->from_date);
        $to_not_empty = !empty($request->to_date);
        if($from_not_empty && $to_not_empty){
            $query->whereDate('date', '>=',$from_date)->whereDate('date', '<=',$to_date);
        }elseif($from_not_empty){
            $query->whereDate('date', '>=',$from_date);
        }elseif($to_not_empty){
            $query->whereDate('date', '<=',$to_date);
        }

        $tasks = $query->get();

        // 1ページにつき5件ずつ表示させます
        // $tasks = $query->paginate(5);

    // Viewを表示
        return view('user_home/task', [
            'user' => $user,
            'tasks' => $tasks,
            'tags' => $tags,
            'path' => $request->path(),
        ]);
    }
}
