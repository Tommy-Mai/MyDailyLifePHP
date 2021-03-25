@extends('common.application')

@section('title', 'FAQ')

@section('home-content')
<div class="row">
<div class="faqs-container col-md-10 col-md-offset-1">
  <h1>よくある質問</h1>
  <div class="tasks-index-item">
    <div class="faq-content">
      <div class="question">
        <h3>Q.このサイトは安全ですか？</h3>
      </div>
      <div class="answer">
        <p>A.安心してご利用いただけるようセキュリティ対策を行っておりますが、本サイトの製作者は独学でプログラミングを学んでいる途中であり、万全とは言い切れません。</p>
        <p>そのため本サイトのご利用におきまして、個人を特定できるような情報は必要としない設計にしております。</p>
        <p>会員登録する際のメールアドレスは架空のものでも登録できるようになっておりますので、実際にお使いのメールアドレスをご登録いただく必要はありません。</p>
        <p>ただし、メールアドレスやパスワードが他人に推測されやすいものに設定された場合には、ローラー作戦のような手法で不正にログインされる可能性を考慮した上で本サイトをご利用ください。</p>
        <p>つきましては本サイトの利用において登録・投稿される内容につきましてはユーザーご本人の自己責任でご判断ください。</p>
      </div>
    </div>
  </div>
  <div class="tasks-index-item">
    <div class="faq-content">
      <div class="question">
        <h3>Q.会員登録は必須ですか？</h3>
      </div>
      <div class="answer">
        <p>A.新規会員登録不要のテストユーザーとしてログインが可能です。</p><p>ただし、テストユーザーでログイン中に作成したタスクなどはログアウト時に削除されます。</p>
        <p>またテストユーザーの編集・削除はできません。</p>
      </div>
    </div>
  </div>
  <div class="tasks-index-item">
    <div class="faq-content">
      <div class="question">
        <h3>Q.パスワードを忘れた</h3>
      </div>
      <div class="answer">
        <p>A.<span><a href="/password/reset" class="faq-link">こちら</a></span>からパスワード再設定用のリンクをアカウント登録したメールアドレス宛に送信できますので、こちらをご利用ください。</p>
      </div>
    </div>
  </div>
  <div class="tasks-index-item">
    <div class="faq-content">
      <div class="question">
        <h3>Q.利用にお金はかかりますか？</h3>
      </div>
      <div class="answer">
        <p>A.全てのサービスが無料となっております。</p>
      </div>
    </div>
  </div>
  <div class="tasks-index-item">
    <div class="faq-content">
      <div class="question">
        <h3>Q.使い勝手が悪いところがある。</h3>
      </div><div class="answer">
        <p>A.本サイトの製作者は現在プログラミングの独学中でより良いサイトにするべく奮闘中です。</p>
        <p>具体的な内容を右下の「ご意見・ご感想」からお問い合わせいただければ今後の改善の参考にさせていただきます。</p>
        <p>返信が必要な場合はメールアドレスをご記入の上、お問い合わせください。（※返信に時間を要する場合がございます。）</p>
        <p>ご協力よろしくお願いいたします。</p>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
