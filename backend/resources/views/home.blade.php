@extends('layouts.app')

@section('title', 'YouTube Note｜あなたの動画学習をブーストして効率的にスキルアップ！')
@section('description', 'YouTube動画を使って語学やスポーツの勉強をしている時、「この部分をまたすぐに見ることができたら良いのに」と思ったことはありませんか？YouTube Noteを導入することで、あなたがもう1度見たい動画の場面を一言メモと一緒に残して、後からサクッと効率的に動画を見直せるようになります。')

@section('content')
<div class="section NotesList">
    <div class="section__inner">
        <div class="notes-list">
        @foreach ($notes as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->video->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__title">{{ $note->title }}</div>
                <div class="note__user">
                    <div class="thumbnail">
                        <img src="{{ $note->user->thumbnail }}" alt="">
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
@endsection
