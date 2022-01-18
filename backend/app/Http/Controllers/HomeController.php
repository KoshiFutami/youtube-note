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
        // 最新の投稿
        $notes = Note::orderBy('created_at', 'DESC')->take(6)->get();

        // 人気のタグ
        $popular_tags = Tag::withCount('notes')->orderBy('created_at', 'DESC')->take(3)->get();

        $popular_tags_notes = [];
        foreach ($popular_tags as $index => $tag) {
            $popular_tags_notes[$index] = $tag->notes()->orderBy('created_at', 'DESC')->take(2)->get();
        }

        return view('home', [
            'notes' => $notes,
            'popular_tags' => $popular_tags,
            'popular_tags_notes' => $popular_tags_notes,
        ]);
    }
}
