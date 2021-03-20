<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserHomeController extends Controller
{
    public function meal_task()
    {
        $user =  Auth::user();
        $meal_tasks = $user->meal_tasks()->get();
        return view('user_home/meal_task', [
            'user' => $user,
            'meal_tasks' => $meal_tasks,
            ]);
    }
}
