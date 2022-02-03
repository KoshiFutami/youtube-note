@extends('layouts.app')

@section('title', 'お問い合わせフォーム｜SOKOMIRU')
@section('description', 'こちらはSOKOMIRUのお問い合わせページです。本アプリケーションに関するご質問やご相談は、こちらのページに設置されたお問い合わせフォームを通じてどうぞお気軽にご連絡ください。')

@section('content')

<div class="section ContactForm">
    <div class="section__inner">
        <div class="contact-form">
            <form action="{{ route('contact.send') }}" method="POST" class="form">
                @csrf
                <div class="form__item">
                    <label for="username">お名前<span　class="is-required">※必須</span></label>
                    <div class="form__item__input">
                        {!! $inputs['username'] !!}
                    </div>
                    <input name="username" value="{{ $inputs['username'] }}" type="hidden">
                </div>
                <div class="form__item">
                    <label for="email">メールアドレス<span　class="is-required">※必須</span></label>
                    <div class="form__item__input">
                        {!! $inputs['email'] !!}
                    </div>
                    <input name="email" value="{{ $inputs['email'] }}" type="hidden">
                </div>
                <div class="form__item">
                    <label for="body">お問い合わせ内容<span　class="is-required">※必須</span></label>
                    <div class="form__item__input">
                        {!! nl2br($inputs['body']) !!}
                    </div>
                    <input name="body" value="{{ $inputs['body'] }}" type="hidden">
                </div>

                <button type="submit" class="form__button">送信</button>

                <button type="button" onClick="history.back()">入力内容を修正する</button>
            </form>
        </div>

    </div>
</div>
@endsection
