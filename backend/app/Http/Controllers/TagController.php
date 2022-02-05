<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * タグに紐づくメモ一覧を表示
     * @return view
     * @param int $id
     */
    public function showNotes($id)
    {
        $tag = Tag::find($id);

        $notes = $tag->notes;

        return view('tags.notes', [
            'tag' => $tag,
            'notes' => $notes,
        ]);
    }
}
