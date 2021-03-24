<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUserPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // コメント作成リクエストか検証
        if ($this->path() == 'users/edit/password' && Auth::check()) {
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
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if(!(\Hash::check($value, \Auth::user()->password))) {
                        return $fail('現在のパスワードを正しく入力してください');
                    }
                },
            ],
            'new_password' => 'required|string|min:8|confirmed|different:current_password',
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'current_password' => '現在のパスワード',
            'new_password' => '新しいパスワード',
        ];
    }
}
