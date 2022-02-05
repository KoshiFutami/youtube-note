@extends('layouts.app')

@section('content')
<div class="section PasswordReset">
    <div class="section__inner">
        <div class="auth-form">
            <form class="form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="form__head">パスワード再設定</div>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form__item">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="form__error">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form__item">
                    <label for="password">新しいパスワード<span　class="is-required">※必須</span></label>
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
                    <label for="password-confirm">新しいパスワード（確認用）<span　class="is-required">※必須</span></label>
                    <div class="form__item__password">
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                        <span class="js-password-toggle material-icons">visibility</span>
                    </div>
                </div>

                <button type="submit" class="form__button">パスワードを更新する</button>
                
            </form>
        </div>
    </div>
</div>

@endsection
