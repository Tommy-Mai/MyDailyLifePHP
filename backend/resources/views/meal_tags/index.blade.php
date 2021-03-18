@extends('common.application')

@section('title', 'MealTags')

@section('content')
<div class="row">
  <div class="col col-sm-10 main-container">
    <nav class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav container-tabs">
          <li class="nav-item active">
            <a href="#" class="container-tabs col-md-3 col-xs-4">食事関連</a>
          </li>
          <li class="nav-item">
            <a href="#" class="container-tabs col-md-3 col-xs-4">その他</a>
          </li>
        </ul>
      </div>
      <div class="list-group">
        @foreach($meal_tags as $meal_tag)
          <div class="tags-index-item row">
            <div class="tag-name col-md-6 col-xs-8">
              <p><?php echo $meal_tag->name ?></p>
            </div>
            <div class="tag-count col-md-3 col-xs-4">
              <a href="{{ route('mealTags.show', ['id' => $meal_tag->id]) }}">
                タスク一覧
              </a>
              <p>0件</P>
            </div>
            <div class="to-create-tag-index col-xs-12">
              <a href="#">タスク作成</a>
            </div>
          </div>
        @endforeach
      </div>
    </nav>
  </div>
</div>
@endsection
