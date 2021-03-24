<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/users';
    }
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログイン直後の処理追加
    protected function authenticated(Request $request, $user)
    {
        // 他のデバイス上のセッションを無効化する（新しくログインしたセッションを有効にする）
        auth()->logoutOtherDevices($request->input('password'));

        // テストユーザーの場合、ログイン時に保護されたコンテンツ以外削除
        if($user->id == 1){
            $user->meal_tasks()->where('protected', false)->delete();
            $user->tasks()->where('protected', false)->delete();
            $user->task_tags()->where('protected', false)->delete();
            $user->task_comments()->where('protected', false)->delete();
            $user->memos()->where('protected', false)->delete();
    
            // コメントは紐づいた画像があれば削除してから、コメント削除
            $meal_comments = $user->meal_comments()->where('protected', false)->get();
            foreach($meal_comments as $comment){
                if(!empty($comment->image)){
                    $img = $comment->image;
                    $path = "public/comments/{$img}";
                    Storage::disk('local')->delete($path);
                }
            }
            $user->meal_comments()->where('protected', false)->delete();

            $task_comments = $user->task_comments()->where('protected', false)->get();
            foreach($task_comments as $comment){
                if(!empty($comment->image)){
                    $img = $comment->image;
                    $path = "public/comments/{$img}";
                    Storage::disk('local')->delete($path);
                }
            }
            $user->task_comments()->where('protected', false)->delete();
        }
    }
}
