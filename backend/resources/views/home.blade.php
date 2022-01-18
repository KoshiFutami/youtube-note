@extends('layouts.app')

@section('title', 'YouTube Note｜あなたの動画学習をブーストして効率的にスキルアップ！')
@section('description', 'YouTube動画を使って語学やスポーツの勉強をしている時、「この部分をまたすぐに見ることができたら良いのに」と思ったことはありませんか？YouTube Noteを導入することで、あなたがもう1度見たい動画の場面を一言メモと一緒に残して、後からサクッと効率的に動画を見直せるようになります。')

@section('content')
<div class="section RecentNotes">
    <div class="section__inner">
        <h2 class="section-title">みんなが投稿した最近のメモ</h2>
        <div class="notes-list">
        @foreach ($notes as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__title">{{ $note->title }}</div>
                <div class="note__user">
                    <div class="thumbnail">
                    @if ($note->user->thumbnail)
                        <img src="{{ asset($note->user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
<div class="section PopularTags">
    <div class="section__inner">
        <h2 class="section-title">
            人気タグ「#{{ $popular_tags[0]->name }}」<span>投稿数1位</span>
            <div class="notes-list-button"><a href="">「#{{ $popular_tags[0]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
        </h2>
        <div class="notes-list">
        @foreach ($popular_tags_notes[0] as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__title">{{ $note->title }}</div>
                <div class="note__user">
                    <div class="thumbnail">
                    @if ($note->user->thumbnail)
                        <img src="{{ asset($note->user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </div>
            </a>
        @endforeach
        </div>
        <h2 class="section-title">
            人気タグ「#{{ $popular_tags[1]->name }}」<span>投稿数2位</span>
            <div class="notes-list-button"><a href="">「#{{ $popular_tags[1]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
        </h2>
        <div class="notes-list">
        @foreach ($popular_tags_notes[1] as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__title">{{ $note->title }}</div>
                <div class="note__user">
                    <div class="thumbnail">
                    @if ($note->user->thumbnail)
                        <img src="{{ asset($note->user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </div>
            </a>
        @endforeach
        </div>
        
        <h2 class="section-title">
            人気タグ「#{{ $popular_tags[2]->name }}」<span>投稿数3位</span>
            <div class="notes-list-button"><a href="">「#{{ $popular_tags[2]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
        </h2>
        <div class="notes-list">
        @foreach ($popular_tags_notes[2] as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__title">{{ $note->title }}</div>
                <div class="note__user">
                    <div class="thumbnail">
                    @if ($note->user->thumbnail)
                        <img src="{{ asset($note->user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
@endsection
