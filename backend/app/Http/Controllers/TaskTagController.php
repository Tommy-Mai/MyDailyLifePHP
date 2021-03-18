<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function index()
    {
        $task_tags = TaskTag::all();

        return view('task_tags/index', [
            'task_tags' => $task_tags,
        ]);
    }
}
