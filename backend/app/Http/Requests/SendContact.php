<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $fillable = [
      'contact_name',
      'contact_email',
      'contact_description',
    ];

    public function authorize()
    {
        // コメント作成リクエストか検証
        if ($this->path() == 'contact') {
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
          'contact_name' => 'required|string|max:30',
          'contact_email' => 'required|email',
          'contact_description' => 'required|max:500',
        ];
    }

    // 入力欄の名称のカスタマイズ
    public function attributes()
    {
        return [
            'contact_name' => '名前',
            'contact_email' => 'メールアドレス',
            'contact_description' => 'メッセージ',
        ];
    }
}
