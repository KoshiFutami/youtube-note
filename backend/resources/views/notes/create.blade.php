@extends('layouts.app')
@section('content')

<div class="section NotesList">
    <div class="section__inner">
        <h2>メモを追加</h2>
        <form action="{{ route('notes.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">タイトル</label>
                <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="video_url">YouTube動画のURL</label>
                <input type="text" name="video_url" id="video_url" class="form-control {{ $errors->has('video_url') ? 'is-invalid' : '' }}" value="{{ old('video_url') }}">
                @if ($errors->has('video_url'))
                    <div class="text-danger">{{ $errors->first('video_url') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="start_seconds">再生位置（秒で指定）</label>
                <input type="number" name="start_seconds" id="start_seconds" class="form-control {{ $errors->has('start_seconds') ? 'is-invalid' : '' }}" value="{{ old('start_seconds') }}">
                @if ($errors->has('start_seconds'))
                    <div class="text-danger">{{ $errors->first('start_seconds') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="tags" class="form-label">タグ（複数のタグを追加する場合にはスペースで区切ってください）</label>
                <input type="text" name="tags" id="tags" class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"　value="{{ old('tags') }}">
            @if ($errors->has('tags'))
                <div class="text-danger">{{ $errors->first('tags') }}</div>
            @endif
            </div>

            <div class="form-group">
                <label class="form-label" for="content">メモ内容</label>
                <textarea type="text" name="content" id="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
</div>
@endsection
