@extends('common.application')

@section('title', 'UserHome')

@section('content')
  <div class="row">
    <div class="col col-xs-12 col-xl-12">
      <nav class="panel panel-default">
        <div class="panel-heading">
          <img src="{{ asset('storage/profiles/'.$user->image) }}" alt="プロフィール画像">
          ようこそ{{ $user->name }}ページへ
        </div>
      </nav>
    </div>
  </div>
@endsection
