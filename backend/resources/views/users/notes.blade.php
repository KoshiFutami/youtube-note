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
            @include('partials.notes_list', ['notes' => $notes])
        @else
            <p>メモが1件も投稿されていません。</p>
        @endif
        </div>
        <div class="notes-list__pagination">
            {{ $notes->links() }}
        </div>

    </div>
</div>
@endsection
