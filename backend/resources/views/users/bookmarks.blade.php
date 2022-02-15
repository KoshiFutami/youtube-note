@extends('layouts.app')

@section('title', $user->name . 'が保存したメモ一覧｜SOKOMIRU')
@section('description', $user->name . 'がSOKOMIRUで保存したメモをすべてご覧いただけます。')

@section('content')
<div class="section BookmarkedNotes">
    <div class="section__inner">

        <div class="notes-list">
            <div class="notes-list__head">{{ $user->name }}さんが保存したメモ一覧</div>
        @if (isset($notes) && !$notes->isEmpty())
            @include('partials.notes_list', ['notes' => $notes])
        @else
        <p>メモが1件も保存されていません。</p>
        @endif
        </div>
        <div class="notes-list__pagination">
            {{ $notes->links() }}
        </div>

    </div>
</div>
@endsection
