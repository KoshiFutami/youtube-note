<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    /**
     * ユーザー詳細ページを表示
     * @return view
     * @param string $username
     */
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        $notes = Note::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(4)->get();

        return view('users.show',[
            'user' => $user,
            'notes' => $notes,
        ]);
    }

    /**
     * ユーザー情報編集ページを表示
     * @return view
     */
    public function edit()
    {
        $user = Auth::user();
   
        return view('users.edit',[
            'user' => $user,
        ]);
    }

    /**
     * ユーザー情報を更新
     * @return view
     * @param array $request
     */
    public function update(UserRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->introduction = $request->introduction;

        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
            $user->email = $request->email;
        }

        $user_thumbnail = $request->file('thumbnail');

        if ($user_thumbnail != null) {
            $user->thumbnail = User::storeProfileThumbnail($user_thumbnail, $user->id);
        } 
        

        $user->save();

        return redirect(route('users.show', $user->username));
    }

    /**
     * ユーザーが投稿したメモの一覧を表示
     * @return view
     * @param string $username
     */
    public function showNotes($username)
    {
        $user = User::where('username', $username)->first();
        $notes = $user->notes()->orderBy('created_at', 'DESC')->get();

        $tags = [];
        foreach ($notes as $note) {
            $note_tags = $note->tags->toArray();
            $tags = array_merge($tags, $note_tags);
        }

        return view('users.notes', [
            'user' => $user,
            'notes' => $notes,
            'tags' => $tags,
        ]);
    }

    /**
     * ユーザーが保存したメモの一覧を表示
     * @return view
     * @param string $username
     */
    public function showBookmarks($username)
    {
        $user = User::where('username', $username)->first();
        $notes = $user->bookmark_notes()->orderBy('created_at', 'desc')->get();

        return view('users.bookmarks', [
            'user' => $user,
            'notes' => $notes,
        ]);
    }
}
