@extends('layouts.app')

@section('title', 'プロフィール編集｜' . $user->name . '｜SOKOMIRU')
@section('description', $user->name . 'さんのプロフィールを編集しています。')

@section('content')

<div class="section UserEdit">
    <div class="section__inner">
        <div class="user-form">
            <form action="{{ route('users.update', $user->username) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="user-form__item">
                    <div class="thumbnail-preview" id="thumbnailPreview">
                        <input type="file" name="thumbnail" id="thumbnail">
                    @if ($user->thumbnail)
                        <img src="{{ asset($user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                        <div class="thumbnail-preview__icon"><img src="{{ asset('image/icon_photo.png') }}"></div>
                    </div>
                </div>
                <div class="user-form__item">
                    <label for="name">お名前</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="user-form__item">
                    <label for="username">ユーザー名</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                </div>
                <div class="user-form__item">
                    <label for="introduction">自己紹介文</label>
                    <textarea class="form-control" name="introduction" id="introduction">{{ $user->introduction }}</textarea>
                </div>
                <div class="user-form__item">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>
                <input class="user-form__button" type="submit" value="更新する">
            </form>
        </div>
    </div>
</div>
@endsection
