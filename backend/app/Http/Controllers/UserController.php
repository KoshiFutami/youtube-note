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
    public function __construct()
    {
        $this->middleware('auth')->only(['edit', 'update', 'showBookmarks']);
    }

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
     * @param string $username
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->first();

        $this->authorize('edit', $user);

        return view('users.edit',[
            'user' => $user,
        ]);
    }

    /**
     * ユーザー情報を更新
     * @return view
     * @param string $username
     * @param array $request
     */
    public function update($username, UserRequest $request)
    {
        $user = User::where('username', $username)->first();

        $this->authorize('update', $user);

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

        session()->flash('toastr', config('toastr.user.update'));

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

        // すべてのメモに紐づくタグを取得
        $tags = collect([]);
        foreach ($notes as $note) {
            $note_tags = $note->tags;
            $tags = $tags->concat($note_tags);
        }
        // 重複を解消
        $tags = $tags->unique('id');

        // ページネーション出力用メモ一覧
        $notes = $user->notes()->orderBy('created_at', 'DESC')->paginate(12);

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
        $notes = $user->bookmark_notes()->orderBy('created_at', 'DESC')->paginate(12);

        return view('users.bookmarks', [
            'user' => $user,
            'notes' => $notes,
        ]);
    }
}
