<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'video_id',
    ];

    /**
     * このメモに関連する動画を取得
     */
    public function video()
    {
        return $this->hasOne(Video::class);
    }

    /**
     * このメモを投稿したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * YouTube動画のURLから動画IDを取得
     */
    public static function getYtVideoId($video_url)
    {
        $yt_video_id_pos = strpos($video_url, 'v=');
        $yt_video_id = substr($video_url, $yt_video_id_pos + 2, 11);

        return $yt_video_id;
    }
}
