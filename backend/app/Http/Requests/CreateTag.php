<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTag extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // タグ作成ページか検証
        if ($this->path() == 'task_tags/create') {
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
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'name' => 'タグ名',
        ];
    }
}
