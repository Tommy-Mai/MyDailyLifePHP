<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // コメント作成リクエストか検証
        if (preg_match("#meal_tasks/[0-9]{1,}/comments/create#", $this->path()) || preg_match('#tasks/[0-9]{1,}/comments/create#', $this->path())) {
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
            'comment' => 'string|max:140|nullable',
            'image' => 'nullable|image|file',
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'comment' => 'コメント',
            'image' => '画像',
            'created_at' => '作成日時',
        ];
    }
}
