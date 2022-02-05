@extends('layouts.app')

@section('title', '会員登録｜SOKOMIRU')
@section('description', 'こちらはSOKOMIRUの会員登録ページです。SOKOMIRUは、YouTube動画の場面をちょっとしたメモと一緒にアプリに残すことができるアプリです。')

@section('content')
<div class="section Signup">
    <div class="section__inner">
        <div class="signup">
            <div class="signup__introduction">
                <h1 class="title">Welcome to SOKOMIRU</h1>
                <div class="description">
                    <p>SOKOMIRU（そこみる）は、YouTubeを通じてスキルを身につけたい方にピッタリのアプリケーション。</p>
                    <p>動画のなかの、何度でも見返したい場面をメモと一緒に記録できるのが大きな特徴です。</p>
                    <p>さっそく登録してあなたの学びをブーストしましょう。</p>
                </div>
            </div>
            <div class="signup__form">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form__head">会員登録</div>
                    <div class="form__item">
                        <label for="name">お名前<span　class="is-required">※必須</span></label>
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                        @if ($errors->has('name'))
                            <div class="form__error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="form__item">
                        <label for="username">ユーザー名<span　class="is-required">※必須</span></label>
                        <div class="form__item__description">半角英数字・あとから変更可能</div>
                        <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                        @if ($errors->has('username'))
                            <div class="form__error">{{ $errors->first('username') }}</div>
                        @endif
                    </div>
                    <div class="form__item">
                        <label for="email">メールアドレス<span　class="is-required">※必須</span></label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @if ($errors->has('email'))
                            <div class="form__error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form__item">
                        <label for="password">パスワード<span　class="is-required">※必須</span></label>
                        <div class="form__item__description">8文字以上の半角英数記号</div>
                        <div class="form__item__password">
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span class="js-password-toggle material-icons">visibility</span>
                        </div>
                        @if ($errors->has('password'))
                            <div class="form__error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form__item">
                        <label for="password-confirm">パスワード（確認用）<span　class="is-required">※必須</span></label>
                        <div class="form__item__password">
                            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            <span class="js-password-toggle material-icons">visibility</span>
                        </div>
                    </div>
                    <button type="submit" class="form__button">新規登録</button>
                    <div class="form__button-subtext">アカウントをお持ちですか？<a href="{{ route('login') }}">ログインはこちら</a></div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
