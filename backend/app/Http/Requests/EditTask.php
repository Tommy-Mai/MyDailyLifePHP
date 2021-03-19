<?php

namespace App\Http\Requests;

use App\MealTask;
use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // タスク編集ページか検証
        if (preg_match("#meal_tasks/[0-9]{1,}/edit#", $this->path()) || preg_match('#tasks/[0-9]{1,}/edit#', $this->path())) {
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
// 不要？？？？
//     public function rules()
//     {
//         return parent::rules();
//     }

//     public function attributes()
//     {
//         return parent::attributes();
//     }
}
