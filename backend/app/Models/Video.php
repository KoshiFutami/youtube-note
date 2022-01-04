<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'yt_video_id',
        'start_seconds',
        'note_id',
    ];


    /**
     * この動画に紐づくメモを取得
     */
    public function note()
    {
        return $this->belongsTo(Note::class);
    }

}
