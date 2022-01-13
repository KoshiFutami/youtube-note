@extends('layouts.app')

@section('title', $note->title . '｜' . $note->user->name . '｜YouTube Note')
@section('description', $note->user->name . 'さんのメモ「' . $note->title . '」をご覧いただけます。')

@section('content')

<div class="section NoteDetail">
    <div class="section__inner">
        <div class="note-detail">
            <div class="note-detail__figure">
                <iframe style="width:100%;aspect-ratio:16 / 9;" src="https://www.youtube.com/embed/{{ $note->video->yt_video_id }}?start={{ $note->video->start_seconds }}" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="note-detail__info">
            @if (Auth::check() && $note->user_id === Auth::id())
                <div class="note-detail__nav-button" id="js-note-nav-button"><span class="material-icons">more_horiz</span></div>
                <div class="note-detail__nav-bg" id="js-note-nav-bg"></div>
                <div class="note-detail__nav" id="js-note-nav">
                    <div class="note-detail__nav__items">
                        <div class="note-detail__nav__item edit" id="js-note-nav-edit">編集</div>
                        <form action="{{ route('notes.destroy', $note) }}" method="post" class="note-detail__nav__item delete">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除"　onclick='return confirm("こちらのメモを本当に削除しますか？");'>
                        </form>
                    </div>
                </div>
            @endif
                <div class="note-detail__tags">
                @foreach ($note->tags as $tag)
                    <span class="note-detail__tag">{{ $tag->name }}</span>
                @endforeach
                </div>
                <h2 class="note-detail__title">{{ $note->title }}</h2>
                <div class="note-detail__content">
                    <p>{!! nl2br(e($note->content)) !!}</p>
                </div>
                <a href="/{{ $note->user->username }}" class="note-detail__user">
                    <div class="thumbnail">
                        <img src="{{ asset($note->user->thumbnail) }}" alt="{{ $note->user->name }}">
                    </div>
                    <div class="username">{{ '@' . $note->user->username }}</div>
                </a>
            </div>
        </div>
    @if (Auth::check() && $note->user_id === Auth::id())
        <div class="note-edit-bg" id="js-note-edit-bg"></div>
        <div class="note-edit {{ $errors->any() ? 'is-active' : '' }}" id="js-note-edit">
            <div class="note-edit__inner">
                <div class="note-edit__close" id="js-note-edit-close"><span class="material-icons">close</span></div>
                <form class="note-form" action="{{ route('notes.update', $note) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $note->id }}">
                    <div class="note-form__item">
                        <label for="title">タイトル<span　class="is-required">※必須</span></label>
                        <input type="text" name="title" id="title" class="{{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $note->title }}">
                        @if ($errors->has('title'))
                        <div class="note-form__error">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="note-form__item">
                        <label for="video_url">YouTube動画のURL<span　class="is-required">※必須</span></label>
                        <input type="text" name="video_url" id="video_url" class="{{ $errors->has('video_url') ? 'is-invalid' : '' }}" value="https://www.youtube.com/watch?v={{ $note->video->yt_video_id }}">
                        @if ($errors->has('video_url'))
                        <div class="note-form__error">{{ $errors->first('video_url') }}</div>
                        @endif
                    </div>
                    <div class="note-form__item">
                        <label for="start_seconds">再生位置<span class="instruction">（時:分:秒）</span></label>
                        <input type="number" min="0"　name="start_seconds_h" id="start_seconds_h" class="{{ $errors->has('start_seconds_h') ? 'is-invalid' : '' }}" value="{{ $start_seconds[0] }}"> : <input type="number" min="0" max="59"　name="start_seconds_m" id="start_seconds_m" class="{{ $errors->has('start_seconds_m') ? 'is-invalid' : '' }}" value="{{ $start_seconds[1] }}"> : <input type="number" min="0" max="59"　name="start_seconds_s" id="start_seconds_s" class="{{ $errors->has('start_seconds_s') ? 'is-invalid' : '' }}" value="{{ $start_seconds[2] }}">
                    @if ($errors->has('start_seconds'))
                        <div class="text-danger">{{ $errors->first('start_seconds') }}</div>
                    @endif
                    </div>
                    <div class="note-form__item">
                        <label for="tags">タグ<span class="instruction">（複数のタグを追加する場合にはスペースで区切ってください）</span></label>
                        <input type="text" name="tags" id="tags" class="{{ $errors->has('tags') ? 'is-invalid' : '' }}"　value="" placeholder="新規タグ">
                    @foreach ($note->tags as $tag)
                        <div class="checkbox-group">
                            <input type="checkbox" value="{{ $tag->id }}" name="current_tags[]" id="{{ $tag->id }}" checked>
                            <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                    @if ($errors->has('tags'))
                        <div class="note-form__error">{{ $errors->first('tags') }}</div>
                    @endif
                    </div>
                    <div class="note-form__item">
                        <label for="content">メモ内容<span　class="is-required">※必須</span></label>
                        <textarea type="text" name="content" id="content" class="{{ $errors->has('content') ? 'is-invalid' : '' }}">{{ $note->content }}</textarea>
                        @if ($errors->has('content'))
                        <div class="note-form__error">{{ $errors->first('content') }}</div>
                        @endif
                    </div>
                    <button type="submit" class="note-form__button">更新する</button>
                    <div　　class="note-form__cancel" id="js-note-edit-cancel">キャンセル</div>
                </form>
            </div>
        </div>
    @endif
    </div>
</div>
@endsection
