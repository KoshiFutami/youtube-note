<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" itemprop="description" content="@yield('description')">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
</head>
<body class="@if(Auth()->check()) {{ "user-logged-in" }} @endif">
    <div id="app" class="app-wrapper">
        <header class="header">
            <div class="header__inner">
                
                <a class="header__logo" href="{{ url('/') }}">SOKOMIRU</a>
            @if (Auth()->check())
                <nav class="header__gnav">
                    <ul>
                        <li><a href="{{ route('notes.search') }}"><i class="material-icons">search</i></a></li>
                        <li><a href="{{ route('notes.create') }}">新規追加</a></li>
                        <li><a href="{{ route('users.notes', auth()->user()->username) }}">自分のメモ</a></li>
                        <li><a href="{{ route('users.bookmarks', auth()->user()->username) }}">保存したメモ</a></li>
                    </ul>
                </nav>
            @endif
            @if (Auth()->check())
                <div class="header__usernav">
                    <div class="header__usernav__thumb" id="js-user-thumbnail">
                    @if (Auth::user()->thumbnail)
                        <img src="{{ Auth::user()->thumbnail }}">
                    @else
                        <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                    @endif
                    </div>
                    <div class="header__usernav__dropdown" id="js-usernav-dropdown">
                        <div class="head">
                            <div class="thumb">
                            @if (Auth::user()->thumbnail)
                                <img src="{{ Auth::user()->thumbnail }}">
                            @else
                                <img src="{{ asset('image/user_thumbnail_default.jpg') }}">
                            @endif
                            </div>
                            <div class="username"><span>{{ Auth::user()->name }}</span>さん</div>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('users.show', Auth::user()->username) }}"><i class="material-icons">account_box</i>マイページ</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="material-icons">logout</i>ログアウト</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="header__usernav__dropdown-bg" id="js-usernav-dropdown-bg"></div>
                </div>
            @else
                <nav class="header__authnav">
                    <ul>
                        <li><a href="{{ route('notes.search') }}"><i class="material-icons">search</i></a></li>
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                        <li class="cta"><a href="{{ route('register') }}">ユーザー登録</a></li>
                    </ul>
                </nav>
            @endif
            </div>
        </header>

        <main class="main">
            @yield('content')
        </main>

    @if (Auth()->check())
        <a href="{{ route('notes.create') }}" class="float-btn"><i class="material-icons">add</i></a>
    @endif

        <footer class="footer">
            <div class="footer__inner">
                <nav class="footer__nav">
                    <a href="{{ route('users.show', 'koshifutami') }}" class="footer__nav__item">運営者情報</a>
                    <a href="{{ route('contact.form') }}" class="footer__nav__item">お問い合わせ</a>
                </nav>
                <div class="footer__copyright">Copyright © {{ date('Y') }} SOKOMIRU</div>
            </div>
        </footer>
        @include('components.toastr')
    </div>
</body>
</html>
