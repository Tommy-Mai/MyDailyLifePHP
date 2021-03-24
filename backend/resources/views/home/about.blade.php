@extends('common.application')

@section('title', 'About')

@section('home-content')
<div class="about-container">
  <div class="about-header">
    <h1>MyDailyLifeとは</h1>
    <h2>シンプルに食事内容を記録したい。</h2>
    <h2>後で観たい動画などを長々とメモに書いているのを見やすくしたい。</h2>
    <h2>忘れがちなことをメモしておいて必要な時に簡単に見つけたい。</h2>
    <h2>そんな思いから誕生したWebアプリケーションです。</h2>
    <h5>※ポートフォリオ用のWebアプリケーションのため、本サービスに事実上または法律上の瑕疵（安全性、信頼性、正確性、完全性、有効性、特定の目的への適合性、セキュリティなどに関する欠陥、エラーやバグ、権利侵害などを含みます）がないことを明示的にも黙示的にも保証しておりません。ご了承の上、ご利用ください。</h5>
  </div>
  <div class="about-content-block">
    <div class="about-content">
      <h4>タスク管理機能</h4>
      <p>タスクは「食事関係」と「その他」の2種類のカテゴリーに分けられています。</p>
      <p>「食事関係」は用意された7種のタグ、「その他」はユーザーが自由に作成したタグをつけて管理できます。</p>
      <p>また検索機能もありますので、任意の期間・言葉・タグなどでタスクを絞り込むことも可能です。</p>
      <div class="about-image_container">
        <img src="{{ asset('storage/top/about-tasks.jpg') }}">
      </div>
    </div>
    <div class="about-content">
      <h4>コメント機能</h4>
      <p>タスク毎に詳細ページにコメント欄が付いていて、コメント・画像を投稿できます。</p>
      <p>このコメント機能は本サービスの特徴的な機能で、コメントを投稿した日時がわかるようになっているため、時間経過で変化した事や後から補足した内容が何時のものなのかわかりやすく記録できるようになっています。</p>
      <p>使う機会は限られている機能かもしれませんが、役立つ場面がきっとあると思います。</p>
      <div class="about-image_container">
        <img src="{{ asset('storage/top/about-comments.jpg') }}">
      </div>
    </div>
    <div class="about-content">
      <h4>メモ機能</h4>
      <p>タスクと似た機能ですが、「タイトル」と「詳細」だけのシンプルな記録機能となっており、ユーザーページから利用できます。</p>
      <p>こちらは出来事を記録すると言うよりは、名前の通り「メモ」として覚えておきたい事柄を書き留めておくのに適しています。</p>
      <div class="{{ asset('storage/top/about-memos.jpg') }}">
      </div>
    </div>
  </div>
</div>
@endsection
