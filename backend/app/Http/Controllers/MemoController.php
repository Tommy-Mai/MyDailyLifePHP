<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::all();

        return view('memos/index', [
            'memos' => $memos,
        ]);
    }
}
