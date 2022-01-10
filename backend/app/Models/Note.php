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
        return $this->belongsTo(Video::class);
    }

    /**
     * このメモを投稿したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * このメモに紐づくタグを取得
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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

    /**
     *  入力された動画の再生位置を時間・分から秒に変換
     */
    public static function hourToSec(string $h, string $m, string $s): int
    {
        $h = (int) $h;
        $m = (int) $m;
        $s = (int) $s;

        return ($h * 60 * 60) + ($m * 60) + $s;
    }

    /**
     *  秒の再生位置を時間・分・秒の配列に変換
     */
    public static function secToHour(int $sec): array
    {
        $h = floor($sec / 3600);
        $m = floor(($sec / 60) % 60);
        $s = floor($sec % 60);

        $time =  [$h, $m, $s];

        return $time;
    }

    /**
     * 入力されたタグを登録してidを配列にまとめる
     */
    public static function saveTagsAndGetIds($request_tags)
    {
        // 全角スペースを半角スペースに変換
        $input_tags = mb_convert_kana($request_tags, 's', 'utf-8');
        // 入力値を半角スペースで区切って配列に追加
        $input_tags = preg_split('/ ++/', $input_tags, -1, PREG_SPLIT_NO_EMPTY);

        // 配列の単語を1つずつタグとして登録（すでにあれば登録はしない）し、登録したデータを新しい配列に追加
        $tags = [];
        foreach ($input_tags as $tag_name) {
            $record = Tag::firstOrCreate(['name' => $tag_name]);
            array_push($tags, $record);
        }
        
        // それぞれのタグのidを配列に保存
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        }

        return $tags_id;
    }
}
