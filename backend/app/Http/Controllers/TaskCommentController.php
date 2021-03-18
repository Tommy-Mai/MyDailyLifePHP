<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function index()
    {
        $task_comments = TaskComment::all();
    }
}
