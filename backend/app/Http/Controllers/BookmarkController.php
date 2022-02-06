<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * メモをブックマーク（保存）
     * @param int $noteId 
     */
    public function store($noteId)
    {
        $user = \Auth::user();
        $note = Note::find($noteId);

        if (!$note->is_bookmarked_by_auth_user()) {
            $user->bookmark_notes()->attach($noteId);
        }
        return back();
    }

    /**
     * メモのブックマークを削除
     * @param int $noteId 
     */
    public function destroy($noteId)
    {
        $user = \Auth::user();
        $note = Note::find($noteId);
        
        if ($note->is_bookmarked_by_auth_user()) {
            $user->bookmark_notes()->detach($noteId);
        }
        return back();
    }
}
