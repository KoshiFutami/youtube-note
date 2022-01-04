@extends('layouts.app')
@section('content')

<div class="section NoteDetail">
    <div class="section__inner">
        <div class="note-detail">
            <h2 class="note-detail__title">{{ $note->title }}</h2>
            <p class="note-detail__content">{{ $note->content }}</p>
            <div class="note-detail__figure">
                <iframe style="width:100%;aspect-ratio:16 / 9;" src="https://www.youtube.com/embed/{{ $note->video->yt_video_id }}?start={{ $note->video->start_seconds }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
