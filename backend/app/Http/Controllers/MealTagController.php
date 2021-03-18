<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MealTag;

class MealTagController extends Controller
{
    public function index()
    {
        $meal_tags = MealTag::all();

        return view('meal_tags/index', [
            'meal_tags' => $meal_tags,
        ]);
    }
}
