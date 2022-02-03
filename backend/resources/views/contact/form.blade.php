@extends('layouts.app')

@section('title', 'お問い合わせフォーム｜SOKOMIRU')
@section('description', 'こちらはSOKOMIRUのお問い合わせページです。本アプリケーションに関するご質問やご相談は、こちらのページに設置されたお問い合わせフォームを通じてどうぞお気軽にご連絡ください。')

@section('content')

<div class="section ContactForm">
    <div class="section__inner">
        <h2 class="section-title">お問い合わせフォーム</h2>
        <div class="contact-form">
            <form class="form" action="{{ route('contact.confirm') }}" method="post">
                @csrf
                <div class="form__item">
                    <label for="username">お名前<span　class="is-required">※必須</span></label>
                    <input type="text" name="username" id="username" class="{{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                    <div class="form__error">{{ $errors->first('username') }}</div>
                    @endif
                </div>
                <div class="form__item">
                    <label for="email">メールアドレス<span　class="is-required">※必須</span></label>
                    <input type="email" name="email" id="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <div class="form__error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
   
                <div class="form__item">
                    <label for="body">お問い合わせ内容<span　class="is-required">※必須</span></label>
                    <textarea type="text" name="body" id="body" class="{{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body') }}</textarea>
                    @if ($errors->has('body'))
                    <div class="form__error">{{ $errors->first('body') }}</div>
                    @endif
                </div>
                <button type="submit" class="form__button">入力内容を確認</button>
            </form>
        </div>

    </div>
</div>
@endsection
