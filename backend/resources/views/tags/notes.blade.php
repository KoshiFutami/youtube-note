@extends('layouts.app')

@section('title', '「' . $tag->name . '」にタグ付けされたメモ一覧｜SOKOMIRU')
@section('description', 'SOKOMIRUの「' . $tag->name . '」というタグに紐づいたメモの一覧ページです。')

@section('content')
<div class="section TagNotes">
    <div class="section__inner">
        <div class="notes-list">
            <div class="notes-list__head">タグ「#{{ $tag->name }}」のメモ</div>
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
