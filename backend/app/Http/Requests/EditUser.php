<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $redirectTo = '/users/edit';

    public function authorize()
    {
        // コメント作成リクエストか検証
        if ($this->path() == 'users/edit' && Auth::check()) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'image' => 'nullable|image|file',
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'current-password' => '現在のパスワード',
            'current_password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
            'name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'image' => '画像',
        ];
    }
}
