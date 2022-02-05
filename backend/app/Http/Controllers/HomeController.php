<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * ホーム画面を表示（アプリの使い方や最近の投稿一覧など）
     *
     * @return view
     */
    public function home()
    {
        // 自分の最新のメモ
        if (auth()->user()) {
            $my_notes = Note::where('user_id', auth()->id())->orderBy('created_at', 'DESC')->take(4)->get();
        }
        
        // SOKOMIRUユーザーの最新のメモ
        $users_notes = Note::orderBy('created_at', 'DESC')->take(4)->get();

        // 人気のタグ
        $popular_tags = Tag::withCount('notes')->orderBy('notes_count', 'DESC')->take(3)->get();

        $popular_tags_notes = [];
        foreach ($popular_tags as $index => $tag) {
            $popular_tags_notes[$index] = $tag->notes()->orderBy('created_at', 'DESC')->take(4)->get();
        }
        if (auth()->user()) {
            return view('home', [
                'my_notes' => $my_notes,
                'users_notes' => $users_notes,
                'popular_tags' => $popular_tags,
                'popular_tags_notes' => $popular_tags_notes,
            ]);
        } else {
            return view('home', [
                'users_notes' => $users_notes,
                'popular_tags' => $popular_tags,
                'popular_tags_notes' => $popular_tags_notes,
            ]);
        }
        
    }
}
