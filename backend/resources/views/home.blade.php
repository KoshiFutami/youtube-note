@extends('layouts.app')

@section('content')
<div class="section NotesList">
    <div class="section__inner">
        <div class="notes-list">
        @foreach ($notes as $note)
            <a href="/notes/{{ $note->id }}" class="note">
                <div class="note__figure">
                    <img src="https://img.youtube.com/vi/{{ $note->video->yt_video_id }}/mqdefault.jpg">
                </div>
                <div class="note__info">
                    <div class="note__title">{{ $note->title }}</div>
                    <div class="note__user">{{ $note->user->name }}</div>
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
@endsection
