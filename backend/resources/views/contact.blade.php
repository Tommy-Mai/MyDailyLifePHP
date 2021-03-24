@extends('common.application')

@section('title', 'お問い合わせ')

@section('content')
<div class="row">
  <div class="col col-xs-12 main-container">
    <div class="panel panel-default">
      <div class="panel-heading form-title">お問い合わせ</div>
      <div class="panel-body">
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
              <p>{{ $message }}</p>
            @endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('contact') }}" class="form-items">

          @csrf
          <input type="text" class="col-xs-12 contact-form-item" placeholder="名前（必須）" name="contact_name" value="{{ old('contact_name') }}"/>
          <input type="email" class="col-xs-12 contact-form-item" placeholder="メールアドレス（必須）" name="contact_email" value="{{ old('contact_email') }}"/>
          <textarea class="col-xs-12 contact-form-item" name="contact_description" value="{{ old('contact_description') }}" placeholder="メッセージ（必須）"></textarea>

          <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">送信</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
