@extends('calendar.day')

@section('header-today')

<div class="icon col-xs-1">
  <a href="/calendar/day/other?date={{$sub_date}}">&lt;</a>
</div>
<span class="calendar-title col-xs-9 text-center" id="pop_trigger">
  <a href="/calendar/day/other">
    {{$today_date}}
  </a>
</span>
<div class="icon col-xs-1">
  <a href="/calendar/day/other?date={{$add_date}}">&gt;</a>
</div>

@endsection

@section('active-tab')
<ul class="nav container-tabs">
  <li class="nav-item col-xs-3">
    <a href="/calendar/day/meal?date={{$date}}" class="container-tabs">食事関連</a>
  </li>
  <li class="nav-item col-xs-3 active">
    <a href="/calendar/day/other?date={{$date}}" class="container-tabs">その他</a>
  </li>
</ul>
@endsection

@section('home-create-tab')
@if($tags->isEmpty())
  <div class="panel-heading home-create-tab">
    <a href="{{ route('task_tags.index') }}" class="container-tabs ">その他タグ一覧(新規タグ作成)へ</a>
  </div>
@else
  <div class="panel-heading home-create-tab">
    <a href="{{ route('tasks.create') }}" class="container-tabs ">新規その他タスク作成＋</a>
  </div>
@endif
@endsection
