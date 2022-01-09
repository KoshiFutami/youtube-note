@extends('layouts.app')
@section('content')

<div class="section UserDetail">
    <div class="section__inner">
        <div class="user-detail">
            
            <div class="thumbnail">
            @if ($user->thumbnail)
                <img src="{{ asset($user->thumbnail) }}">
            @else
                <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
            @endif
            </div>
            <h2 class="name">{{ $user->name }}  <span class="username">{{ "@" . $user->username }}</span></h2>
            @if (Auth::check() && $user->id === Auth::id())
                <div class="edit-button"><a href="{{ route('users.edit', $user->username) }}">プロフィールを編集</a></div>
            @endif
            <p class="introduction">
            @if (empty($user->introduction))
                自己紹介はまだ投稿されていません
            @else
                {!! nl2br(e($user->introduction)) !!}
            @endif
            </p>
            <p class="registration">{{ $user->created_at->format('Y年m月') }}からYouTube Noteを利用しています</p>
        </div>
    </div>
</div>
@endsection
