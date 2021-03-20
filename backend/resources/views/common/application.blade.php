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
<body>
  <header>
    <nav class="my-navbar navbar navbar-expand-md navbar-dark sticky-top">
      <a class="my-navbar-brand navbar-brand mr-auto" href="/">MyDailyLife</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7" id="my-navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbar7">
        <ul class="navbar-nav ml-auto" id="my-navbar-nav">
          @if(Auth::check())
              <li class="nav-item my-navbar-item">
                  <a class="nav-link" href="users">ようこそ, {{ Auth::user()->name }}さん</a>
              </li>
              <li class="nav-item my-navbar-item">
                <a class="nav-link" href="#" id="logout">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
        @else
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="{{ route('login') }}">ログイン</a>
            </li>
            <li class="nav-item my-navbar-item">
              <a class="nav-link" href="{{ route('register') }}">新規登録</a>
            </li>
          @endif
        </ul>
      </div>
    </nav>
    </div>
  </header>
  <main>
    <div class="container">
      @yield('content')
    </div>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xs-2"></div>
          <div class="col-xs-4">
            <h3>ご利用ガイド</h3>
            <a href="#"">MyDailyLifeとは</a>
            <a href="#"">よくある質問</a>
          </div>
          <div class="col-xs-4">
            <h3>サイト情報</h3>
            <a href="#"">利用規約</a>
            <a href="#"">プライバシーポリシー</a>
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
