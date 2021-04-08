@extends('common.application')

@section('title', '日別タスク')

@section('content')
  <div class="row">
  <div class="col-xs-12">
    <div class="col-xs-12 header-today">
      @yield('header-today')
    </div>  
  </div>

    <div class="col col-xs-12 main-container">

        <nav class="panel panel-default">
          <div class="panel-heading">
            @yield('active-tab')
          </div>

          @yield('home-create-tab')

          <div class="list-group">
            @foreach($tasks as $task)
              <div class="task-index-item row">
                <div class="task-name col-xs-8">
                  @if($path == "calendar/day/other")
                    <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{$task->name}}</a>
                    </div>
                  <div class="col-xs-4 task-index-tag">
                    <a href="/users/other?tag_id={{$task->tag_id}}">{{$task->getTaskTagName()}}</a>
                  </div>
                  @else($path == "calendar/day/meal")
                    <a href="{{ route('meal_tasks.show', ['id' => $task->id]) }}">{{$task->name}}</a>
                    </div>
                  <div class="col-xs-4 task-index-tag">
                    <a href="/users?tag_id={{$task->tag_id}}">{{$task->getMealTagName()}}</a>
                  </div>
                  @endif
                <div class="col-xs-4 col-xs-offset-8 task-index-datetime">
                  @if($path == "calendar/day/other")
                    <a href="/calendar/day/other?date={{$task->getFormatDateHyphen()}}">{{$task->getFormatDate()}}</a>
                  @else($path == "calendar/day/meal")
                    <a href="/calendar/day/meal?date={{$task->getFormatDateHyphen()}}">{{$task->getFormatDate()}}</a>
                  @endif
                  <a>  {{$task->getFormatTime()}}</a>
                </div>
              </div>
            @endforeach
          </div>
        </nav>

    </div>
  </div>
@endsection
