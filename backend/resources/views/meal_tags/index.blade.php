@extends('common.application')

@section('title', 'MealTags')

@section('content')
<div class="row">
  <div class="col col-xs-12 main-container">
    <nav class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav container-tabs">
          <li class="nav-item col-xs-3 active">
            <a href="/meal_tags" class="container-tabs">食事関連</a>
          </li>
          <li class="nav-item col-xs-3">
            <a href="/task_tags" class="container-tabs">その他</a>
          </li>
        </ul>
      </div>
      <div class="list-group">
        @foreach($tags as $tag)
          <div class="tags-index-item row">
            <div class="tag-name col-xs-8">
              <p>{{$tag->name}}</p>
            </div>
            <div class="tag-count col-xs-4">
              <a href="/users?tag_id={{ $tag->id }}">
                タスク一覧
              </a>
              <p>{{ $tasks->where('tag_id', $tag->id)->count() }}件</P>
            </div>
            <div class="to-create-tag-index col-xs-12">
              <a href="/meal_tasks/create?tag_id={{$tag->id}}">タスク作成</a>
            </div>
          </div>
        @endforeach
      </div>
    </nav>
  </div>
</div>
@endsection
