@extends('common.application')

@section('title', 'タスク詳細')

@section('content')
  <div class="row">
    <div class="col col-xs-12 main-container">
      <div class="row">
        <nav class="panel panel-default">
          <!-- タスク詳細欄 -->
          <div class="list-group">
              <div class="task-index-item row task-show-item">
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
                  <a href="#" class="col-xs-3 task-show-date">{{$task->getFormatDate()}}</a>
                  <p class="col-xs-3"><i class="far fa-clock"></i>{{$task->getFormatTime()}}</P>
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

          <!-- コメント欄 -->
          <div class="comment-container">
            @foreach($comments as $comment)
              <div class="right_block_parent">
                <div class="right_block" id="comment{{$comment->id}}">
                  @if(!empty($comment->comment))
                    <div class="right_comment_block">
                      <div class="right_balloon balloon_comment">{!! nl2br(e($comment->comment)) !!}</div>
                    </div>
                  @else(!empty($comment->image))
                    <div class="right_balloon" id="image_ballon">
                      <a rel="lightbox" href="{{ asset('storage/comments/'.$comment->image) }}">
                      <img src="{{ asset('storage/comments/'.$comment->image) }}" alt="コメント画像"></a>
                    </div>
                  @endif
                  <div class="right_item_block">
                    <div class="comment_time_right col-xs-4 col-xs-offset-8">{{$comment->getFormatDateTime()}}</div>
                    <div class="comment_destroy_right col-xs-1 col-xs-offset-11">
                      @if(preg_match("#meal_tasks/[0-9]{1,}#", $path))
                        <form action="{{ route('meal_comments.delete', ['task_id' => $task->id, 'id' => $comment->id]) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="delete-btn" onclick="return confirm('タスクを削除してよろしいですか？')">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                      @elseif(preg_match("#tasks/[0-9]{1,}#", $path))
                        <form action="{{ route('task_comments.delete', ['task_id' => $task->id, 'id' => $comment->id]) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="delete-btn" onclick="return confirm('タスクを削除してよろしいですか？')">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                      @endif
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          </div>

          <!-- コメント作成・送信欄 -->
          <div class="list-group">
            <div class="comment_new-container row">
              @if(preg_match("#meal_tasks/[0-9]{1,}#", $path))
                <form method="POST" action="{{ route('meal_comments.create', $task->id) }}" class="col-xs-12" enctype="multipart/form-data">
              @elseif(preg_match("#tasks/[0-9]{1,}#", $path))
                <form method="POST" action="{{ route('task_comments.create', $task->id) }}" class="col-xs-12" enctype="multipart/form-data">
              @endif
                  @csrf
                  <label class="comment_image_form col-xs-1">
                    <i class="fas fa-image"></i>
                    <input id="comment_image" type="file" name="image">
                  </label>
                  <textarea id="comment_text" placeholder="Aa" maxlength="140" name="comment" class="col-xs-10"></textarea>
                  <div class="comment_form_btn col-xs-1">
                    <button name="button" type="submit">
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </form>
            </div>
          </div>

        </nav>
      </div>
    </div>
  </div>
@endsection
