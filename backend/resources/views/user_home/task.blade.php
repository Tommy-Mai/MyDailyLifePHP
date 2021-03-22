@extends('user_home.common')

@section('active-tab')
<ul class="nav container-tabs">
  <li class="nav-item col-xs-3">
    <a href="/users" class="container-tabs">食事関連</a>
  </li>
  <li class="nav-item col-xs-3 active">
    <a href="/users/other" class="container-tabs">その他</a>
  </li>
  <li class="nav-item col-xs-3 col-xs-offset-3">
    <i class="fas fa-search-plus" id="search-toggle-btn"></i>
  </li>
</ul>
@endsection

@section('home-create-tab')
@if(empty($tags))
  <div class="panel-heading home-create-tab">
    <a href="{{ route('task_tags') }}" class="container-tabs ">その他タグ一覧(新規タグ作成)へ</a>
  </div>
@else
  <div class="panel-heading home-create-tab">
    <a href="{{ route('tasks.create') }}" class="container-tabs ">新規その他タスク作成＋</a>
  </div>
@endif
@endsection
