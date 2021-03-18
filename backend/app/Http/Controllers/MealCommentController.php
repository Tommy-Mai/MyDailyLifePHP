<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MealCommentController extends Controller
{
    public function index()
    {
        $meal_comments = MealComment::all();
    }
}
