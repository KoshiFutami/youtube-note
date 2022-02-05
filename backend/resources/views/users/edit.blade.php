@extends('layouts.app')

@section('title', 'プロフィール編集｜' . $user->name . '｜SOKOMIRU')
@section('description', $user->name . 'さんのプロフィールを編集しています。')

@section('content')

<div class="section UserEdit">
    <div class="section__inner">
        <div class="">
            <form class="form" action="{{ route('users.update', $user->username) }}" method="post" enctype="multipart/form-data">
                <div class="form__head">プロフィールを編集</div>
                @csrf
                
            @if (Auth::user()->username === 'guestuser')
                 <p class="form__message">※ゲストユーザーは、自己紹介文のみ自由に編集できます。</p>
            @endif
                <div class="form__item">
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
                <div class="form__item">
                    <label for="name">お名前</label>
                @if (Auth::user()->username === 'guestuser')
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
                @else
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                @endif
                </div>
                <div class="form__item">
                    <label for="username">ユーザー名</label>
                @if (Auth::user()->username === 'guestuser')
                    <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" readonly>
                @else
                    <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                @endif
                </div>
                <div class="form__item">
                    <label for="introduction">自己紹介文</label>
                    <textarea class="form-control" name="introduction" id="introduction">{{ $user->introduction }}</textarea>
                </div>
                <div class="form__item">
                    <label for="email">メールアドレス</label>
                @if (Auth::user()->username === 'guestuser')
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                @else
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                @endif
                </div>
                <input class="form__button" type="submit" value="更新する">
            </form>
        </div>
    </div>
</div>
@endsection
