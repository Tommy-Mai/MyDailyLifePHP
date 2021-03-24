<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AdminUsersIndex;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    // ユーザー情報更新
    public function usersIndex(Request $request){
        $user = Auth::user();
        $path = $request->path();
        if($user->admin && $user->protected && $path == 'admin/users_index'){
            $users = User::all();

            // Viewを表示
            return view('admin/users_index', [
                'users' => $users,
            ]);
        }else{
            return redirect('/users');
        }
    }

    public function delete(int $id, Request $request)
    {
        $user = Auth::user();
        $path = $request->path();
        $path = preg_match("#admin/[0-9]{1,}/users_delete#", $path);
        if($user->admin && $user->protected && $path){
            $request_user = User::find($id);
            if($request_user->protected == false){
                if($request_user->image != 'icon_penguin.jpg'){
                    $img = $request_user->image;
                    $path = "public/profiles/{$img}";
                    Storage::disk('local')->delete($path);
                }
                User::destroy($id);
            }
            // 管理者要ユーザー一覧ページへ戻る
            return redirect('/admin/users_index')
                ->with('message', '削除できないユーザーです');
        }else{
            return redirect('/users');
        }

    }
}
