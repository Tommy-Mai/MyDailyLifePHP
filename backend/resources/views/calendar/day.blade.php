@extends('common.application')

@section('title', '日別タスク')

@section('content')
  <div class="row">

  <div class="col-xs-12 header-today">
    @yield('header-today')
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
                    <a href="#">{{$task->getTaskTagName()}}</a>
                  </div>
                  @else($path == "calendar/day/meal")
                    <a href="{{ route('calendar.day_meal', ['id' => $task->id]) }}">{{$task->name}}</a>
                    </div>
                  <div class="col-xs-4 task-index-tag">
                    <a href="#">{{$task->getMealTagName()}}</a>
                  </div>
                  @endif
                <div class="col-xs-4 col-xs-offset-8 task-index-datetime">
                  <a href="">{{$task->getFormatDate()}}　{{$task->getFormatTime()}}</a>
                </div>
              </div>
            @endforeach
          </div>
        </nav>

    </div>
  </div>
@endsection
