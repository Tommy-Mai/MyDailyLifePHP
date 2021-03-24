<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // メモ作成リクエストか検証
        if ($this->path() == 'users/memo/create') {
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
            'name' => 'required|max:30',
            'description' => 'nullable|string'
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'name' => 'タイトル',
            'description' => '詳細',
        ];
    }
}
