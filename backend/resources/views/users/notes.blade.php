@extends('layouts.app')

@section('title', $user->name . 'のメモ一覧｜SOKOMIRU')
@section('description', $user->name . 'がSOKOMIRUに投稿したメモをすべてご覧いただけます。')

@section('content')
<div class="section UsersNotes">
    <div class="section__inner">
        <div class="interests">
            <div class="interests__head">{{ $user->name }}さんの興味・関心は？</div>
            <div class="interests-list">
            @if (count($tags) > 0)
                @foreach ($tags as $tag)
                <a href="{{ route('tags.notes', $tag['id']) }}" class="interest">{{ $tag['name'] }}</a>
                @endforeach
            @else
                <p class="interests-list__message">{{ $user->name }}さんの興味・関心はまだ不明です･･･</p>
            @endif
            </div>
        </div>

        <div class="notes-list">
            <div class="notes-list__head">{{ $user->name }}さんのメモ一覧</div>
        @if (isset($notes) && !$notes->isEmpty())
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
        @else
        <p>メモが1件も投稿されていません。</p>
        @endif
        </div>

    </div>
</div>
@endsection
