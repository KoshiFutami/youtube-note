@extends('layouts.app')
@section('content')

<div class="section NoteDetail">
    <div class="section__inner">
        <div class="note-detail">
            <div class="note-detail__tags">
            @foreach ($note->tags as $tag)
                <span class="note_detail__tag">{{ $tag->name }}</span>
            @endforeach
            </div>
            <h2 class="note-detail__title">{{ $note->title }}</h2>
            <div class="note-detail__figure">
                <iframe style="width:100%;aspect-ratio:16 / 9;" src="https://www.youtube.com/embed/{{ $note->video->yt_video_id }}?start={{ $note->video->start_seconds }}" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="note-detail__content">
                <p>{{ $note->content }}</p>
            @if (Auth::check() && $note->user_id === Auth::id())
                <div class="note-detail__action">
                    <div class="note-detail__action__item edit" id="openNoteEdit">編集</div>
                    <form action="{{ route('notes.destroy', $note) }}" method="post" class="note-detail__action__item delete">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除"　onclick='return confirm("削除しますか？");'>
                    </form>
                </div>
            @else
                <a href="/users/{{ $note->user_id }}" class="post-detail__user">
                    <?php /*
                    <div class="thumb">
                        <img src="/storage/image/{{  $note->user->profile_image }}" alt="{{ $note->user->name }}">
                    </div> */ ?>
                    <div class="username"><span>{{ $note->user->name }}</span>さん</div>
                </a>
            @endif
            </div>
        @if (Auth::check() && $note->user_id === Auth::id())
            <div class="note-detail__edit {{ $errors->any() ? 'is-active' : '' }}" id="noteEdit">
                <div class="note-detail__edit__inner">
                    <div class="note-detail__edit__close">×</div>
                    <form class="form" action="{{ route('notes.update', $note) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $note->id }}">
                        <div class="form__item">
                            <label for="title">タイトル</label>
                            <input type="text" name="title" id="title" class="{{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $note->title }}">
                            @if ($errors->has('title'))
                            <div class="form__error-msg">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form__item">
                            <label for="video_url">YouTube動画のURL</label>
                            <input type="text" name="video_url" id="video_url" class="{{ $errors->has('video_url') ? 'is-invalid' : '' }}" value="https://www.youtube.com/watch?v={{ $note->video->yt_video_id }}">
                            @if ($errors->has('video_url'))
                            <div class="form__error-msg">{{ $errors->first('video_url') }}</div>
                            @endif
                        </div>
                        <div class="form__item">
                            <label for="start_seconds">再生位置（秒で指定）</label>
                            <input type="number" name="start_seconds" id="start_seconds" class="{{ $errors->has('start_seconds') ? 'is-invalid' : '' }}" value="{{ $note->video->start_seconds }}">
                            @if ($errors->has('start_seconds'))
                            <div class="form__error-msg">{{ $errors->first('start_seconds') }}</div>
                            @endif
                        </div>
                        <div class="form__item">
                            <label for="tags">タグ（複数のタグを追加する場合にはスペースで区切ってください）</label>
                            <input type="text" name="tags" id="tags" class="{{ $errors->has('tags') ? 'is-invalid' : '' }}"　value="" placeholder="新規タグ">
                        @foreach ($note->tags as $tag)
                            <div class="form__checkbox">
                                <input type="checkbox" value="{{ $tag->id }}" name="current_tags[]" id="{{ $tag->id }}" checked>
                                <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                        @if ($errors->has('tags'))
                            <div class="form__error-msg">{{ $errors->first('tags') }}</div>
                        @endif
                        </div>
                        <div class="form__item">
                            <label for="content">補足内容</label>
                            <textarea type="text" name="content" id="content" class="{{ $errors->has('content') ? 'is-invalid' : '' }}">{{ $note->content }}</textarea>
                            @if ($errors->has('content'))
                            <div class="form__error-msg">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="form__submit-btn">更新する</button>
                        <div class="form__cancel-btn">キャンセル</div>
                    </form>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
