<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMemo extends CreateMemo
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        // メモ編集リクエストか検証
        if (preg_match("#users/memo/[0-9]{1,}/edit#", $this->path())) {
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
}
