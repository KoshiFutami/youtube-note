<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        if (!$user->is_bookmark($noteId)) {
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

        if ($user->is_bookmark($noteId)) {
            $user->bookmark_notes()->detach($noteId);
        }
        return back();
    }
}
