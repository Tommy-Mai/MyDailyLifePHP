@extends('common.application')

@section('title', 'ユーザーページ')

@section('content')
  <div class="row">
    <div class="col col-xs-12 main-container">
        <!-- ユーザー情報表示 -->
        <div class="user-info-container row">
          <div class="col-xs-2 col-xs-offset-2">
            <img src="{{ asset('storage/profiles/'.$user->image) }}" alt="プロフィール画像" class="rounded-circle user-img">
          </div>
          <div class="user-info-items col-xs-6">
            <div class="col-xs-12">{{ $user->name }}</div>
            <div class="col-xs-12">{{ $user->email }}</div>
            <div class="col-xs-1 col-xs-offset-9">
              <a href="{{ route('user_home.edit') }}"><i class="fas fa-cog"></i></a>
            </div>
          </div>
        </div>
        <!-- ここまでユーザー情報表示 -->

        <nav class="panel panel-default">
          <div class="panel-heading">
            @yield('active-tab')
          </div>

          <!-- 検索窓 -->
          <div class="search-container" id="search-toggle-menu">
            @if($path == "users/other")
              <form action="{{url('/users/other')}}" method="GET" name="search" class="form-items">
            @else($path == "users")
              <form action="{{url('/users')}}" method="GET" name="search" class="form-items">
            @endif
              @csrf
              <label class="control-label form-label col-xs-12">日付</label>
              <input type="text" id="datepicker" class="col-xs-5" readonly placeholder="日付を選択" name="from_date" value="{{ old('date') }}"/>
              <p class="col-xs-1 between_date">〜</p>
              <input type="text" id="datepicker2" class="col-xs-6" readonly placeholder="日付を選択" name="to_date" value="{{ old('date') }}"/>
              <label class="control-label form-label col-xs-12">タグ</label>
              <select class="col-xs-5 form-tag-select" name="tag_id">
                <option value="" hidden>タグを選択</option>
                @foreach($tags as $tag)
                  @if(old('tag_id') == $tag->id)
                    <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                  @else
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                  @endif
                @endforeach
              </select>
              <label class="control-label form-label col-xs-12">タイトル</label>
              <input type="text" class="col-xs-12" name="name" value="{{ old('name') }}"/>
              <label class="control-label form-label col-xs-12">詳細</label>
              <textarea class="col-xs-12" name="description" value="{{ old('description') }}"></textarea>
              <label class="control-label form-label col-xs-5">誰と</label>
              <input type="text" class="col-xs-12" name="with_whom" value="{{ old('with_whom') }}"/>
              <label class="control-label form-label col-xs-5">どこで</label>
              <input type="text" class="col-xs-12" name="where" value="{{ old('where') }}"/>
              <div class="search-btn row">
                <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">検索</button>
              </div>
            </form>
          </div>
          <!-- ここまで検索窓 -->

          @yield('home-create-tab')

          <div class="list-group">
            @foreach($tasks as $task)
              <div class="task-index-item row">
                <div class="task-name col-xs-8">
                  @if($path == "users/other")
                    <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{$task->name}}</a>
                    </div>
                  <div class="col-xs-4 task-index-tag">
                    <a href="/users/other?tag_id={{$task->tag_id}}">{{$task->getTaskTagName()}}</a>
                  </div>
                  @else($path == "users")
                    <a href="{{ route('meal_tasks.show', ['id' => $task->id]) }}">{{$task->name}}</a>
                    </div>
                  <div class="col-xs-4 task-index-tag">
                    <a href="/users?tag_id={{$task->tag_id}}">{{$task->getMealTagName()}}</a>
                  </div>
                  @endif
                <div class="col-xs-4 col-xs-offset-8 task-index-datetime">
                  @if($path == "users/other")
                    <a href="/calendar/day/other?date={{$task->getFormatDateHyphen()}}">{{$task->getFormatDate()}}</a>
                  @else($path == "users")
                    <a href="/calendar/day/meal?date={{$task->getFormatDateHyphen()}}">{{$task->getFormatDate()}}</a>
                  @endif
                  <a>  {{$task->getFormatTime()}}</a>
                </div>
              </div>
            @endforeach
            </ul>
          </div>
        </nav>
        {{ $tasks->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection
