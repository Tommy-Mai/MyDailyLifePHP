<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MealTag;
use App\Models\MealTask;
use Illuminate\Support\Facades\Auth;

class MealTagController extends Controller
{
    public function index()
    {
	$user = Auth::user();
        $tags = MealTag::all();
        $tasks = $user->meal_tasks()->get();

        return view('meal_tags/index', [
            'tags' => $tags,
	    'tasks' => $tasks,    
        ]);
    }
}
