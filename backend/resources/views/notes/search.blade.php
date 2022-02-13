@extends('layouts.app')

@section('title', '検索｜SOKOMIRU')
@section('description', 'YouTube動画を使って語学やスポーツの勉強をしている時、「この部分をまたすぐに見ることができたら良いのに」と思ったことはありませんか？SOKOMIRUを導入することで、あなたがもう1度見たい動画の場面を一言メモと一緒に残して、後からサクッと効率的に動画を見直せるようになります。')

@section('content')
<div class="section RecentNotes">
    <div class="section__inner">

        <form method="get" action="" class="search-form">
            <input class="search-form__input" type="text" name="keywords" value="{{ isset($keywords) ? $keywords: "" }}" placeholder="キーワード検索">
            <button class="search-form__button" type="submit"><i class="material-icons">search</i></button>
        </form>

        <div class="notes-list">
        @if (isset($notes) && !$notes->isEmpty())
            @include('partials.notes_list', ['notes' => $notes])
        @elseif (isset($keywords) && $keywords != "")
            <p　　class="search-form-message"><span>「{{ $keywords}}」</span>の検索結果はありませんでした。別のキーワードで検索してみてください。</p>
        @endif
        </div>
    </div>
</div>
@endsection
