@extends('calendar.day')

@section('active-tab')
<ul class="nav container-tabs">
  <li class="nav-item col-xs-3 active">
    <a href="/calendar/day/meal?date={{$date}}" class="container-tabs">食事関連</a>
  </li>
  <li class="nav-item col-xs-3">
    <a href="/calendar/day/other?date={{$date}}" class="container-tabs">その他</a>
  </li>
</ul>
@endsection

@section('home-create-tab')
<div class="panel-heading home-create-tab">
  <a href="{{ route('meal_tasks.create') }}" class="container-tabs ">新規食事タスク作成＋</a>
</div>
@endsection
