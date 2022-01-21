@extends('layouts.app')

@section('title', 'プロフィール編集｜' . $user->name . '｜SOKOMIRU')
@section('description', $user->name . 'さんのプロフィールを編集しています。')

@section('content')

<div class="section UserEdit">
    <div class="section__inner">
        <div class="user-edit">
            <form action="{{ route('users.update', $user->username) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">お名前</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="username">ユーザー名</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                </div>
                <div class="form-group">
                    <label for="introduction">自己紹介文</label>
                    <textarea class="form-control" name="introduction" id="introduction">{{ $user->introduction }}</textarea>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="thumbnail">プロフィール写真</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                    <div class="thumnail-preview" id="thumbnailPreview">
                    @if ($user->thumbnail)
                        <img src="{{ asset($user->thumbnail) }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                </div>
                <input type="submit" value="更新する">
            </form>
        </div>
    </div>
</div>
@endsection
