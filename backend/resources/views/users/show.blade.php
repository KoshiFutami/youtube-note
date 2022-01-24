@extends('layouts.app')

@section('title', $user->name . '｜SOKOMIRU')
@section('description', $user->introduction)

@section('content')

<div class="section UserProfile">
    <div class="section__inner">

        <div class="user-profile">
            
            <div class="user-profile__main">
                <div class="thumbnail">
                @if ($user->thumbnail)
                    <img src="{{ asset($user->thumbnail) }}">
                @else
                    <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                @endif
                </div>
            </div>

            <div class="user-profile__sub">
                <h2 class="name">{{ $user->name }}  <span class="username">{{ "@" . $user->username }}</span></h2>
                <p class="introduction">
                @if (empty($user->introduction))
                    自己紹介はまだ投稿されていません
                @else
                    {!! nl2br(e($user->introduction)) !!}
                @endif
                </p>
                <p class="registration">{{ $user->created_at->format('Y年m月') }}からSOKOMIRUを利用しています</p>
                @if (Auth::check() && $user->id === Auth::id())
                <a class="edit-button" href="{{ route('users.edit', $user->username) }}"><i class="material-icons">edit</i>プロフィールを編集</a>
                @endif
            </div>
        </div>

        <div class="user-notes">
            <div class="user-notes__head"></div>
            <div class="notes-list">
                @if (!$user->notes->isEmpty())
                    @foreach ($user->notes as $note)
                    <a href="/notes/{{ $note->id }}" class="note">
                        <div class="note__figure">
                            <img src="https://img.youtube.com/vi/{{ $note->yt_video_id }}/mqdefault.jpg">
                        </div>
                    @if (count($note->tags) > 0)
                        <div class="note__tags">
                        @foreach ($note->tags as $tag)
                            <span class="note__tag">{{ $tag->name }}</span>
                        @endforeach
                        </div>
                    @endif
                        <div class="note__title">{{ $note->title }}</div>
                    </a>
                    @endforeach
                @else
                    <p>メモが1件も投稿されていません。</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
