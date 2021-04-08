@extends('common.application')

@section('title', 'Home')

@section('home-content')
<div class="home-container">
    <!-- Slider全体のコンテナ -->
    <div class="swiper-container">
        <!-- Sliderの内包コンテナ -->
        <div class="swiper-wrapper">
            <!-- Slideさせたいコンテンツ -->
            @for($i = 1; $i <= 5; $i++)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/top/top0'.$i.'c.jpg') }}" alt="MyDailyLifePHP_top_image">
                </div>
            @endfor
        </div>
    </div>

    <div class="top-about_MDL">
        <h3>MyDailyLifeとは?</h3>
        <p>毎日の食事や達成した出来事などを</p>
        <p>タスクとして記録できるアプリです。</p>
        <p>タグや日付別にタスクを一覧で見る事ができる他、</p>
        <p>キーワードでの検索も可能なので、タスクを探すのも簡単！</p>
        <div class="top-about_btn">
            <a href="/about_MyDailyLife">もっと詳しく見る</a>
        </div>
    </div>

    <div class="test-user_login">
        <p class="test-login_guide">アカウント作成不要、ワンクリックでお試し可能！</p>
        <div id="test-login_btn">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form test-user_form">
                    <input value="sample@example.com" type="hidden" name="email" id="email">
                    <input value="test" type="hidden" name="password" id="password">
                    <button type="submit" class="btn login-btn test-login-btn">
                        テストユーザーとしてログイン
                    </button>
                </div>
            </form>
        </div>
        <div class="test-login_notice">
            <p>＊テストユーザーでログイン中に作成したタスクなどは次のログイン時に自動的に削除されます。</p>
            <p>＊ログイン中に新しくテストユーザーログインがあった場合、先にログインしていたユーザーはログアウトされますので、ご了承ください。</p>
            <p>＊テストユーザーの編集・削除はできません。</p>
        </div>
    </div>
</div>
@endsection
