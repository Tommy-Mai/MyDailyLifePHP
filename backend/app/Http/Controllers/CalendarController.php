<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Models\MealTask;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use \App\Traits\CommonMethod;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    use CommonMethod;
    // 月別カレンダー表示
    public function month(Request $request){
        $user = Auth::user();
        $meal_tasks = $user->meal_tasks()->get();
        $tasks = $user->tasks()->get();

        // // カレンダー表示月を決定
        $y = $request->y;
        $m = $request->m;
        if($m!=''||$y!=''){
            $date = Carbon::createFromDate($y,$m,null);
        }else{
            $date = Carbon::createFromDate();
        }

        $date->startOfMonth(); //今月の最初の日
        $date->timezone = 'Asia/Tokyo'; //日本時刻で表示

        //１ヶ月前
        $sub = Carbon::createFromDate($date->year,$date->month,$date->day);
        $subMonth = $sub->subMonth();
        $subY = $subMonth->year;
        $subM = $subMonth->month;

        //1ヶ月後
        $add = Carbon::createFromDate($date->year,$date->month,$date->day);
        $addMonth = $add->addMonth();
        $addY = $addMonth->year;
        $addM = $addMonth->month; 
        
        //今月は何日まであるか
        $daysInMonth = $date->daysInMonth;
        
        // 今日
        $today = Carbon::createFromDate();
        $today_comp = Carbon::today()->format('Y-n-j');

        return view('calendar/month',[
            'meal_tasks' => $meal_tasks,
            'tasks' => $tasks,
            'date' => $date,
            'today_comp' => $today_comp,
            'subY' => $subY,
            'subM' => $subM,
            'addY' => $addY,
            'addM' => $addM,
            'daysInMonth' => $daysInMonth,
            'y' => $y,
            'm' => $m,
        ]);
    }

    // 日別カレンダー 食事タスク
    public function dayMeal(Request $request){
        $user = Auth::user();

        // // カレンダー表示月を決定
        $date = $request->date;
        if(!empty($date)){
            $date = Carbon::createFromDate($date);
        }else{
            $date = Carbon::createFromDate();
        }

        $tasks = $user->meal_tasks()->whereDate('date', $date)->get();

        return view('calendar/day_meal',[
            'tasks' => $tasks,
            'path' => $request->path(),
            'date' => date("Y-m-d", strtotime($date)),
        ]);
    }

    // 日別カレンダー その他タスク
    public function dayOther(Request $request){
        $user = Auth::user();
        $tags = $user->task_tags()->get();

        // // カレンダー表示月を決定
        $date = $request->date;
        if(!empty($date)){
            $date = Carbon::createFromDate($date);
        }else{
            $date = Carbon::createFromDate();
        }

        $tasks = $user->tasks()->whereDate('date', $date)->get();

        return view('calendar/day_other',[
            'tasks' => $tasks,
            'path' => $request->path(),
            'date' => date("Y-m-d", strtotime($date)),
            'tags' => $tags,
        ]);
    }
}
