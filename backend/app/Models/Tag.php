<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * この　タグに紐づくメモを取得
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
