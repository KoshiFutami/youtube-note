@extends('layouts.app')

@section('title', 'SOKOMIRU｜あなたの動画学習をブーストして効率的にスキルアップ！')
@section('description', 'YouTube動画を使って語学やスポーツの勉強をしている時、「この部分をまたすぐに見ることができたら良いのに」と思ったことはありませんか？SOKOMIRUを導入することで、あなたがもう1度見たい動画の場面を一言メモと一緒に残して、後からサクッと効率的に動画を見直せるようになります。')

@section('content')
@if (auth()->check())    
<div class="section MyNotes">
    <div class="section__inner">
        <div class="notes-list">
            <div class="notes-list__head">{{ auth()->user()->name }}さんが最近投稿したメモ</div>
            <div class="notes-list__button"><a href="{{ route('users.notes', auth()->user()->username) }}">自分のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
        @if (!$my_notes->isEmpty())
            @foreach ($my_notes as $note)
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
        @else
            <p>メモが1件も投稿されていません。</p>
        @endif
        </div>
    </div>
</div>
@endif
<div class="section AllUsersNotes">
    <div class="section__inner">
        <div class="notes-list">
            <div class="notes-list__head">SOKOMIRUユーザーのメモ</div>
            <div class="notes-list__button"><a href="">SOKOMIRUユーザーのメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
        @if (!$users_notes->isEmpty())
            @foreach ($users_notes as $note)
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
        @else
            <p>メモが1件も投稿されていません。</p>
        @endif
        </div>
    </div>
</div>
@if (!$popular_tags->isEmpty())
<div class="section PopularTags">
    <div class="section__inner">
        <div class="notes-list">
            <div class="notes-list__head">タグ別投稿数1位「#{{ $popular_tags[0]->name }}」</div>
            <div class="notes-list__button"><a href="">「#{{ $popular_tags[0]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
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

        @if (isset($popular_tags[1]))
        <div class="notes-list">
            <div class="notes-list__head">タグ別投稿数2位「#{{ $popular_tags[1]->name }}」</div>
            <div class="notes-list__button"><a href="">「#{{ $popular_tags[1]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
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
        @endif

        @if (isset($popular_tags[2]))
        <div class="notes-list">
            <div class="notes-list__head">タグ別投稿数3位「#{{ $popular_tags[2]->name }}」</div>
            <div class="notes-list__button"><a href="">「#{{ $popular_tags[2]->name }}」のメモをすべて見る<span class="material-icons">chevron_right</span></a></div>
            
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
        @endif
        
    </div>
</div>
@endif
@endsection
