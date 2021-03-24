<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateMemo;
use App\Http\Requests\EditMemo;

class MemoController extends Controller
{
/**
 * POST /memos/create
 */
    public function create(CreateMemo $request)
    {
        $memo = new Memo();

        $memo->name = $request->name;
        $memo->description = $request->description;

        Auth::user()->memos()->save($memo);

        return redirect('/users/memo');
    }

/**
 * POST /users/memo/{id}/edit
 */
    public function edit(int $id, EditMemo $request)
    {
        $memo = Auth::user()->memos()->find($id);

        if($memo->protected == false){
            // 要素に入力値を代入する
            $memo->name = $request->name;
            $memo->description = $request->description;

            // インスタンスの状態をデータベースに書き込む
            // ユーザーに紐付けて保存
            Auth::user()->memos()->save($memo);
            return redirect('/users/memo');
        }else{
            // メモ一覧ページに戻る
            return redirect('/users/memo')
            ->with('message', '保護されているコンテンツです。');
        }
    }

/**
 * POST(DELETE) /users/memo/{id}
 */
    public function delete(int $id)
    {
        $memo = Auth::user()->memos()->find($id);
        if(!empty($memo)){
            if($memo->protected == false){
                Memo::destroy($id);
                return redirect('/users/memo');
            }else{
                // メモ一覧ページへ遷移
                return redirect('/users/memo')
                ->with('message', '保護されているコンテンツです。');
            }
        }
        return redirect('/users/memo')
        ->with('message', 'リクエストの実行に失敗しました。');
    }

}
