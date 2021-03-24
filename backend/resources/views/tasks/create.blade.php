@extends('common.task_form')

@section('title', 'タスク作成')

@section('form-items')

<!-- フォームの送信先 条件分岐 -->
@if($path == "meal_tasks/create")
  @section('form-title', '食事タスク新規作成')
  <form method="POST" action="{{ route('meal_tasks.create') }}" class="form-items">
@elseif($path == 'tasks/create')
  @section('form-title', '食事タスク編集')
  <form method="POST" action="{{ route('tasks.create') }}" class="form-items">
@endif

  @csrf
  <label class="control-label form-label col-xs-12">日付</label>
  <input type="text" id="datepicker" class="col-xs-5" readonly placeholder="日付を選択" name="date" value="{{ old('date') }}"/>
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
  <label class="control-label form-label col-xs-12">誰と</label>
  <input type="text" class="col-xs-12" name="with_whom" value="{{ old('with_whom') }}"/>
  <label class="control-label form-label col-xs-12">どこで</label>
  <input type="text" class="col-xs-12" name="where" value="{{ old('where') }}"/>
  <label class="control-label form-label col-xs-12" name="when">いつ</label>
  <input type="time" class="col-xs-5" name="time" value="{{ old('time') }}"/>
  <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">登録</button>
</form>
@endsection
