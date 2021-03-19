<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyDailyLifePHP - @yield('title')</title>
  <link rel="stylesheet" href="/css/styles.css">
  @extends('common.js')
</head>
<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">MyDailyLife</a>
    </nav>
  </header>
  <main>
    <div class="container">
      @yield('content')
    </div>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-xs-2"></div>
          <div class="col-md-3 col-xs-4">
            <h3>ご利用ガイド</h3>
            <a href="#"">MyDailyLifeとは</a>
            <a href="#"">よくある質問</a>
          </div>
          <div class="col-md-3 col-xs-4">
            <h3>サイト情報</h3>
            <a href="#"">利用規約</a>
            <a href="#"">プライバシーポリシー</a>
          </div>
          <div class="col-md-3 col-xs-2"></div>
        </div>
      </div>
    </footer>
  </main>
  @yield('datepicker_js')
</body>
</html>
