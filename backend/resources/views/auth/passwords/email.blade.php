@extends('layouts.app')

@section('content')
<div class="section PasswordReset">
    <div class="section__inner">
        <div class="auth-form">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form class="form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form__head">パスワード再設定</div>

                <div class="form__item">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="form__error">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <button type="submit" class="form__button">再設定用リンクを送信する</button>
                
            </form>
        </div>
    </div>
</div>

@endsection
