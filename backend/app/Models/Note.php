<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prophecy\Argument\Token\InArrayToken;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'yt_video_id',
        'start_seconds',
    ];

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
     * このメモに紐づくブックマークを取得
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'note_id');
    }

    /**
     * ブックマークされているか判定
     * @return bool true→ブックマーク済、false→未ブックマーク
     */
    public function is_bookmarked_by_auth_user()
    {
        $auth_id = \Auth::id();

        $users_bookmarking = [];

        foreach ($this->bookmarks as $bookmark) {
            array_push($users_bookmarking, $bookmark->user_id);
        } 

        if (in_array($auth_id, $users_bookmarking)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * YouTube動画のURLから動画IDを取得
     */
    public static function getYtVideoId($video_url)
    {
        // Todo: 一箇所にまとめる
        $is_full_url = (strpos($video_url, 'https://www.youtube.com/') !== false);
        $is_short_url = (strpos($video_url, 'https://youtu.be/') !== false);

        if ($is_full_url) {
            $yt_video_id_pos = strpos($video_url, 'v=');
            $yt_video_id = substr($video_url, $yt_video_id_pos + 2, 11);
        } else if ($is_short_url) {
            $yt_video_id_pos = strpos($video_url, 'be/');
            $yt_video_id = substr($video_url, $yt_video_id_pos + 3, 11);
        }

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
