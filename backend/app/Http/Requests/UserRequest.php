<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    // ゲストユーザーのID指定
    private const GUEST_USER_ID = 24; /* 本番環境 */
    // private const GUEST_USER_ID = 2; /* ローカル環境 */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(\Auth::id() == self::GUEST_USER_ID) {
            return [
                'introduction' => 'string | sometimes | nullable | max:200',
            ];
        } else {
            return [
                'name' => 'required | string | max:15',
                'username' => 'required | string | max:15',
                'email' => 'required | string | email | max:255',
                'thumbnail' => 'sometimes | nullable | file | mimes:jpg,png,jpeg | max:10240',
                'introduction' => 'string | sometimes | nullable | max:200',
            ];
        }
    }

    /**
     * 日本語
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'required',
            'username' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'thumbnail' => 'プロフィール写真',
            'introduction' => '自己紹介文',
        ];
    }

}
