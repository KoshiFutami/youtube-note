@extends('layouts.app')

@section('title', '新規メモを作成｜SOKOMIRU')
@section('description', 'こちらはSOKOMIRUの新規メモ作成ページです。お気に入りのYouTube動画の好きな場面をアプリに残して、効率良く見直せるようにしましょう。')

@section('content')

<div class="section NoteCreate">
    <div class="section__inner">
        <div class="note-create">
            <form class="form" action="{{ route('notes.store') }}" method="post">
                @csrf
                <div class="form__head">新しいメモを作成</div>
                <div class="form__item">
                    <label for="title">タイトル<span　class="is-required">※必須</span></label>
                    <input type="text" name="title" id="title" class="{{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                    <div class="form__error">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="form__item">
                    <label for="video_url">YouTube動画のURL<span　class="is-required">※必須</span></label>
                    <input type="text" name="video_url" id="video_url" class="{{ $errors->has('video_url') ? 'is-invalid' : '' }}" value="{{ old('video_url') }}">
                    @if ($errors->has('video_url'))
                    <div class="form__error">{{ $errors->first('video_url') }}</div>
                    @endif
                </div>
                <div class="form__item">
                    <label for="start_seconds">再生位置<span class="instruction">（時:分:秒）</span></label>
                    <input type="number" min="0"　name="start_seconds_h" id="start_seconds_h" class="{{ $errors->has('start_seconds_h') ? 'is-invalid' : '' }}" value="{{ old('start_seconds_h', 0) }}"> : <input type="number" min="0" max="59"　name="start_seconds_m" id="start_seconds_m" class="{{ $errors->has('start_seconds_m') ? 'is-invalid' : '' }}" value="{{ old('start_seconds_m', 0) }}"> : <input type="number" min="0" max="59"　name="start_seconds_s" id="start_seconds_s" class="{{ $errors->has('start_seconds_s') ? 'is-invalid' : '' }}" value="{{ old('start_seconds_s', 0) }}">
                @if ($errors->has('start_seconds'))
                    <div class="text-danger">{{ $errors->first('start_seconds') }}</div>
                @endif
                </div>
                <div class="form__item">
                    <label for="tags">タグ<span class="instruction">（複数のタグを追加する場合にはスペースで区切ってください）</span></label>
                    <input type="text" name="tags" id="tags" class="{{ $errors->has('tags') ? 'is-invalid' : '' }}"　value="{{ old('tags') }}" placeholder="新規タグ">
                @if ($errors->has('tags'))
                    <div class="form__error">{{ $errors->first('tags') }}</div>
                @endif
                </div>
                <div class="form__item">
                    <label for="content">メモ内容<span　class="is-required">※必須</span></label>
                    <textarea type="text" name="content" id="content" class="{{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                    <div class="form__error">{{ $errors->first('content') }}</div>
                    @endif
                </div>
                <button type="submit" class="form__button">登録する</button>
            </form>
        </div>

    </div>
</div>
@endsection
