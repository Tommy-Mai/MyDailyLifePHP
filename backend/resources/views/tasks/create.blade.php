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
  <label class="control-label form-label col-xs-12 required">日付</label>
  @if(!empty(old('date')))
    <input type="text" id="datepicker" class="col-xs-5" readonly placeholder="日付を選択" name="date" value="{{ old('date') }}"/>
  @else
    <input type="text" id="datepicker" class="col-xs-5" readonly placeholder="日付を選択" name="date" value="{{ $date }}"/>
  @endif
  <label class="control-label form-label col-xs-12 required">タグ</label>
  <select class="col-xs-5 form-tag-select" name="tag_id">
    <option value="" hidden>タグを選択</option>
    @foreach($tags as $tag)
      @if(old('tag_id') == $tag->id)
        <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
      @elseif($selected_tag == $tag->id)
        <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
      @else
        <option value="{{$tag->id}}">{{$tag->name}}</option>
      @endif
    @endforeach
  </select>
  <label class="control-label form-label col-xs-12 required">タイトル</label>
  <input type="text" class="col-xs-12" name="name" value="{{ old('name') }}" autocomplete="off" list="title" autofocus/>
  <datalist id="title">

    @if(!empty($tasks))
      @foreach($tasks as $task)
        <option value="{{$task->name}}">
      @endforeach
    @elseif($path == "meal_tasks/create")
      <option value="パン">
      <option value="白ご飯">
      <option value="パスタ">
      <option value="うどん">
      <option value="焼肉">
    @elseif($path == 'tasks/create')
      <option value="買い物">
      <option value="旅行">
      <option value="勉強">
      <option value="映画">
      <option value="写真">
    @endif
  </datalist>

  <label class="control-label form-label col-xs-12">詳細</label>
  <textarea class="col-xs-12" name="description" value="{{ old('description') }}"></textarea>
  <label class="control-label form-label col-xs-12">誰と</label>
  <input type="text" class="col-xs-12" name="with_whom" value="{{ old('with_whom') }}" autocomplete="off" list="with_whom"/>
  <datalist id="with_whom">
    @if(!empty($suggest_with_whom_list))
      @foreach($suggest_with_whom_list as $task)
        <option value="{{$task->with_whom}}">
      @endforeach
    @else
      <option value="1人">
      <option value="家族">
      <option value="友人">
      <option value="恋人">
      <option value="同僚">
    @endif
  </datalist>

  <label class="control-label form-label col-xs-12">どこで</label>
  <input type="text" class="col-xs-12" name="where" value="{{ old('where') }}" autocomplete="off" list="where"/>
  <datalist id="where">
    @if(!empty($suggest_where_list))
      @foreach($suggest_where_list as $task)
        <option value="{{$task->where}}">
      @endforeach
    @else
      <option value="自宅">
      <option value="カフェ">
      <option value="レストラン">
      <option value="職場">
      <option value="公園">
    @endif
  </datalist>

  <label class="control-label form-label col-xs-12 required" name="when">いつ</label>
  @if(!empty(old('time')))
    <input type="time" class="col-xs-5" name="time" value="{{ old('time') }}"/>
  @else
    <input type="time" class="col-xs-5" name="time" value="{{ $time }}"/>
  @endif

  <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">登録</button>
</form>
@endsection
