<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyDailyLifePHP - @yield('title')</title>
  @extends('common.scripts')
  <link rel="stylesheet" href="/css/styles.css">
</head>
@yield('create-modal')
@yield('edit-modal')
<body>
  <header>
    <nav class="my-navbar navbar navbar-expand-md navbar-dark sticky-top">
      @if(Auth::check())
        <a class="my-navbar-brand navbar-brand mr-auto">MyDailyLifePHP</a>
      @else
        <a class="my-navbar-brand navbar-brand mr-auto" href="/">MyDailyLifePHP</a>
      @endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7" id="my-navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbar7">
        <ul class="navbar-nav ml-auto" id="my-navbar-nav">
          @if(Auth::check() && Auth::user()->admin && Auth::user()->protected)
            <li class="nav-item my-navbar-item">
                <a class="nav-link d-none d-md-block" href="/users">
                  <i class="fas fa-user-circle user-page-icon"></i>
                </a>
                <a class="nav-link d-block d-md-none" href="/users">
                  {{ Auth::user()->name }}
                </a>
            </li>
            <li class="nav-item my-navbar-item">
                <a class="nav-link" href="/admin/users_index">ユーザー管理</a>
            </li>
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="" id="logout">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          @elseif(Auth::check())
          <li class="nav-item my-navbar-item">
                <a class="nav-link d-none d-md-block" href="/users">
                  <i class="fas fa-user-circle user-page-icon"></i>
                </a>
                <a class="nav-link d-block d-md-none" href="/users">
                  {{ Auth::user()->name }}
                </a>
            </li>
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="" id="logout">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          @else
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="{{ route('home.about') }}">MyDailyLifeとは</a>
            </li>
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="{{ route('register') }}">新規登録</a>
            </li>
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="{{ route('login') }}">ログイン</a>
            </li>
          @endif
          @if(Auth::check())
            <li class="nav-item my-navbar-item d-block d-md-none sub-header-items">
              <a href="/calendar/day/meal" class="nav-link col-xs-3">今日のタスク</a>
              <a href="/calendar/month" class="nav-link col-xs-3 col-xs-offset-1">カレンダー</a>
              <a href="/meal_tags" class="nav-link col-xs-3 col-xs-offset-1">タグ一覧</a>
            </li>
          @endif
        </ul>
      </div>
    </nav>
  </header>

  @if(Auth::check())
  <div id="sub-header" class="col-sm-12 d-none d-md-block">
    <div class="sub-header_container">
      <ul>
        <li><a href="/calendar/day/meal" class="col-sm-2 col-xs-offset-3">今日のタスク</a></li>
        <li><a href="/calendar/month" class="col-sm-2">カレンダー</a></li>
        <li><a href="/meal_tags" class="col-sm-2">タグ一覧</a></li>
      </ul>
    </div>
  </div>
  @endif

  <main>

    <!-- ページトップボタン -->
    <div class="fas fa-arrow-circle-up" id="page-top_btn"></div>

    @yield('home-content')
    <div class="container">
      <div class="mt-2">
        @if (Session::has('message'))
          <li class="alert alert-danger">{{ session('message') }}</li>
        @endif
      </div>
      @yield('content')
      @yield('comment-container')
    </div>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xs-2"></div>
          <div class="col-xs-4">
            <h3>ご利用ガイド</h3>
            <a href="/about">MyDailyLifeとは</a>
            <a href="/faqs">よくある質問</a>
          </div>
          <div class="col-xs-4">
            <h3>サイト情報</h3>
            <a href="/policy">利用規約</a>
            <a href="/privacy_policy">プライバシーポリシー</a>
          </div>
          <div class="col-xs-2"></div>
        </div>
      </div>
    </footer>
  </main>
  @if(Auth::check())
    <script>
      document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
      });
    </script>
  @endif

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>
