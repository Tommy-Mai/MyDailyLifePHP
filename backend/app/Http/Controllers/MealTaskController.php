<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MealTask;

class MealTaskController extends Controller
{
    public function show()
    {
        $meal_tasks = MealTask::all();

        return view('meal_tasks/show', [
            'meal_tasks' => $meal_tasks,
        ]);
    }
}
