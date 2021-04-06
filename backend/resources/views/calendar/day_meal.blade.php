@extends('calendar.day')

@section('header-today')

<div class="icon">
  <a href="/calendar/day/meal?date={{$sub_date}}">&lt;</a>
</div>
<span class="calendar-title text-center" id="pop_trigger">
  <a href="/calendar/day/meal">
    {{$today_date}}
  </a>
</span>
<div class="icon">
  <a href="/calendar/day/meal?date={{$add_date}}">&gt;</a>
</div>

@endsection

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
