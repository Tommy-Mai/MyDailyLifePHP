@extends('common.application')

@section('title', 'タスク詳細')

@section('content')
<div class="row">
  <div class="col col-xs-12 main-container">
    <div class="row">
      <nav class="panel panel-default">
        <div class="list-group">
            <div class="task-index-item row">
              <div class="col-sm-4 task-index-tag">
                @if(preg_match("#meal_tasks/[0-9]{1,}#", $path))
                  <a href="#">{{$task->getMealTagName()}}</a>
                @elseif(preg_match("#tasks/[0-9]{1,}#", $path))
                  <a href="#">{{$task->getTaskTagName()}}</a>
                @endif
              </div>
              <div class="task-show-container">
                <div class="task-show-name col-xs-12">
                  <p>{{$task->name}}</p>
                </div>
                <div class="task-description col-xs-12">
                  <p>{!! nl2br(e($task->description)) !!}</p>
                </div>
              </div>
              <div class="task-show-bottom">
                <a href="#" class="col-xs-3 task-show-date">{{$task->getFormateDate()}}</a>
                <p class="col-xs-3"><i class="far fa-clock"></i>{{$task->getFormateTime()}}</P>
                <p class="col-xs-3"><i class="fa fa-user"></i>{{$task->with_whom}}</P>
                <p class="col-xs-3"><i class="fa fa-map-pin"></i>{{$task->where}}</P>
              </div>
              <div class="task-show-btn">
                @if(preg_match("#meal_tasks/[0-9]{1,}#", $path))
                  <a href="{{ route('meal_tasks.edit', ['id' => $task->id]) }}"><i class="fas fa-edit col-xs-1 col-xs-offset-9"></i></a>
                  <form action="{{ route('meal_tasks.delete', $task->id) }}" method="POST" class="col-xs-1">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="delete-btn" onclick="return confirm('タスクを削除してよろしいですか？')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                @elseif(preg_match("#tasks/[0-9]{1,}#", $path))
                  <a href="{{ route('tasks.edit', ['id' => $task->id]) }}"><i class="fas fa-edit col-xs-1 col-xs-offset-9"></i></a>
                  <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="col-xs-1">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="delete-btn" onclick="return confirm('タスクを削除してよろしいですか？')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                @endif
              </div>
            </div>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection

@section('comment-container')
<div class="row">
  <div class="col col-xs-12 comment-container">
    <div class="row">
    </div>
  </div>
</div>
@endsection