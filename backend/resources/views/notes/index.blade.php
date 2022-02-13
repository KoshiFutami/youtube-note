@extends('layouts.app')

@section('title', '全ユーザーが投稿したメモ一覧｜SOKOMIRU')
@section('description', 'SOKOMIRUユーザーのメモ一覧ページです。ユーザー全員がこれまでに投稿したメモをご覧いただけます。')

@section('content')
<div class="section AllNotes">
    <div class="section__inner">
        <div class="notes-list">
            <div class="notes-list__head">SOKOMIRUユーザーのメモ</div>
        @if (isset($notes) && !$notes->isEmpty())
            @include('partials.notes_list', ['notes' => $notes])
        @else
        <p>メモが1件も投稿されていません。</p>
        @endif
        </div>

    </div>
</div>
@endsection
