@extends('user_home.common')

@section('active-tab')
<ul class="nav container-tabs">
  <li class="nav-item col-xs-3 active">
    <a href="/users" class="container-tabs">食事関連</a>
  </li>
  <li class="nav-item col-xs-3">
    <a href="/users/other" class="container-tabs">その他</a>
  </li>
  <li class="nav-item col-xs-3">
    <a href="/users/memo" class="container-tabs">メモ</a>
  </li>
  <li class="nav-item col-xs-3">
    <i class="fas fa-search-plus" id="search-toggle-btn"></i>
  </li>
</ul>
@endsection

@section('home-create-tab')
<div class="panel-heading home-create-tab">
  <a href="{{ route('meal_tasks.create') }}" class="container-tabs ">新規食事タスク作成＋</a>
</div>
@endsection
