<?php

namespace App\Http\Requests;

use App\MealTask;
use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // タスク作成ページか検証
        if ($this->path() == 'meal_tasks/create' || $this->path() == 'tasks/create') {
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

    // これらはコンソール以外からは変更不可
    // 'user_id' => 'required|integer',
    // 'protected' => 'required',
    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'date' => 'required|date_format:"Y年m月d日"',
            'tag_id' => 'required|integer',
            'description' => 'present|max:140',
            'with_whom' => 'present|max:30',
            'where' => 'present|max:30',
            'time' => 'required|date_format:"H:i"',
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'name' => 'タイトル',
            'date' => '日付',
            'description' => '詳細',
            'tag_id' => 'タグ',
            'with_whom' => '誰と',
            'where' => 'どこで',
            'time' => 'いつ',
        ];
    }
}
