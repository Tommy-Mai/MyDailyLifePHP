@extends('common.task_form')

@section('title', 'タスク編集')

@section('form-title', '食事タスク編集')

@section('form-items')
<form method="POST" action="{{ route('meal_tasks.edit', ['id' => $task->id]) }}" class="form-items">
  @csrf
  <label class="control-label form-label col-xs-12">日付</label>
  <input type="text" id="datepicker" class="col-xs-4" readonly placeholder="日付を選択" name="date" value="{{ old('date', $task_date) }}"/>
  <label class="control-label form-label col-xs-12">タグ</label>
  <select class="col-xs-4 form-tag-select" name="tag_id">
    <option value="" hidden>タグを選択</option>
    @foreach($meal_tags as $meal_tag)
      @if(old('tag_id') == $meal_tag->id)
        <option value="{{$meal_tag->id}}" selected="selected">{{$meal_tag->name}}</option>
      @elseif($task->tag_id == $meal_tag->id)
        <option value="{{$meal_tag->id}}" selected="selected">{{$meal_tag->name}}</option>
      @else
        <option value="{{$meal_tag->id}}">{{$meal_tag->name}} </option>
      @endif
    @endforeach
  </select>
  <label class="control-label form-label col-xs-12">タイトル</label>
  <input type="text" class="col-xs-12" name="name" value="{{ old('name', $task->name) }}"/>
  <label class="control-label form-label col-xs-12">詳細</label>
  <textarea class="col-xs-12" name="description" value="{{ old('description', $task->description) }}"></textarea>
  <label class="control-label form-label col-xs-12">誰と</label>
  <input type="text" class="col-xs-12" name="with_whom" value="{{ old('with_whom', $task->with_whom) }}"/>
  <label class="control-label form-label col-xs-12">どこで</label>
  <input type="text" class="col-xs-12" name="where" value="{{ old('where', $task->where) }}"/>
  <label class="control-label form-label col-xs-12" name="when">いつ</label>
  <input type="time" class="col-xs-4" name="time" value="{{ old('time', $task_time) }}"/>
  <button type="submit" class="btn btn-lg form-btn col-xs-3 col-xs-offset-9">更新</button>
</form>
@endsection
