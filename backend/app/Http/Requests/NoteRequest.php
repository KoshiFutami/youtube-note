<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'video_url' => 'required | active_url',
            "start_seconds_h" => 'sometimes | nullable | numeric | min:0',
            'start_seconds_m' => 'sometimes | nullable | numeric | min:0 | max:59',
            'start_seconds_s' => 'sometimes | nullable | numeric | min:0 | max:59',
            'tags' => 'nullable',
            'content' => 'required',
        ];
    }

    /**
     * 日本語
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'video_url' => 'YouTube動画のURL',
            'start_seconds' => '再生位置',
            'tags' => 'タグ',
            'content' => 'メモ内容',
        ];
    }

    /**
     * オリジナルの処理
     * 
     * @param $validator
     */
    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {

            $video_url = $this->input('video_url');
            $is_full_url = (strpos($video_url, 'https://www.youtube.com/') !== false);
            $is_short_url = (strpos($video_url, 'https://youtu.be/') !== false);
            $is_invalid_url = ($is_full_url === false) && ($is_short_url === false);

            if ($this->filled('video_url')) {
                if ($is_invalid_url) {
                    $validator->errors()->add('video_url', 'YouTube動画のURLを貼り付けてください。');
                } else if ($is_full_url && (strpos($video_url, 'v=') === false)) {
                    $validator->errors()->add('video_url', '動画ページのURLをそのまま貼り付けてください。');
                } else if ($is_short_url && (int) mb_strlen($video_url, "UTF-8") !== 28) {
                    $validator->errors()->add('video_url', '動画ページのURLをそのまま貼り付けてください。');
                }
            }
        });
    }
}
