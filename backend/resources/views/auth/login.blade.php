@extends('layouts.app')

@section('title', 'ログイン｜SOKOMIRU')
@section('description', 'こちらはSOKOMIRUのユーザーログインページです。SOKOMIRUは、YouTube動画の場面をちょっとしたメモと一緒にアプリに残すことができるアプリです。')

@section('content')
<div class="section Login">
    <div class="section__inner">
        <div class="auth-form">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form__head">SOKOMIRUにログイン</div>
                <div class="form__item">
                    <label for="username">ユーザー名</label>
                    <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                    @if ($errors->has('username'))
                        <div class="form__error">{{ $errors->first('username') }}</div>
                    @endif
                </div>
                <div class="form__item">
                    <label for="password">パスワード</label>
                    <div class="form__item__password">
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span class="js-password-toggle material-icons">visibility</span>
                    </div>
                    @if ($errors->has('password'))
                        <div class="form__error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form__item">
                    <label class="form__item__check-label remember-me" for="remember"><input class="form__item__check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>ログインしたままにする</label>
                </div>
                <button type="submit" class="form__button">ログイン</button>
                <div class="form__button-subtext"><a href="{{ route('register') }}">会員登録</a> / <a href="{{ route('login.guest') }}">ゲストログイン</a> / <a href="{{ route('password.request') }}">パスワードを忘れた方</a></div>
                
            </form>
        </div>
    </div>
</div>
@endsection
