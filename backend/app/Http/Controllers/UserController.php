<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    /**
     * ユーザー詳細ページを表示
     * @return view
     * @param int $id
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',[
            'user' => $user,
        ]);
    }

    /**
     * ユーザー情報編集ページを表示
     * @return view
     */
    public function edit()
    {
        $user = User::find(Auth::id());
   
        return view('users.edit',[
            'user' => $user,
        ]);
    }

    /**
     * ユーザー情報を更新
     * @return view
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

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

        return redirect(route('users.show', $user->id));
    }
}
