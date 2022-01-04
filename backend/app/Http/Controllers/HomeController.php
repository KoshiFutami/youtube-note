<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

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
        return view('home', [
            'notes' => $notes,
        ]);
    }
}
