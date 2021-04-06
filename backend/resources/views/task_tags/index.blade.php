@extends('common.application')

@section('title', 'TaskTags')

@section('create-modal')
<div class="modal" id="tag-create-modal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div id="create-modal" class="modal-hide">
        <div class="modal-header panel-heading form-title">
          <div id="createModalLabel">タグ新規作成</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('task_tags.create') }}" class="form-items">
          <div class="modal-body">
            @csrf
            <label class="form-label">タグ名</label>
            <input type="text" name="name" class="col-xs-12" value="{{ old('name') }}"/>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">作成</button>
          </div>
        </form>
      </div>

      <!-- ここから編集フォーム -->
      <div id="edit-modal" class="modal-hide">
        <div class="modal-header panel-heading form-title">
          <div id="editModalLabel">タグ編集</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- 以下のformのアクションはjQueryで配置 -->
        <form method="POST" class="form-items" id="edit-modal-form">
          <div class="modal-body">
            @csrf
            <label class="form-label">タグ名</label>
            <input type="text" name="name" class="col-xs-12" value="" id="edit-modal-name"/>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">更新</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<!-- タグ作成モーダル 表示ボタン -->
<div class="modal-btn-container col-xs-12">
  <div class="col-xs-6 col-xs-offset-3">
    <i class="fas fa-plus modal-open-btn" data-toggle="modal" data-target="#tag-create-modal" data-type="@create"></i>
  </div>
</div>

<div class="row col-xs-12">
  <div class="col col-xs-12 main-container">
    <nav class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav container-tabs">
          <li class="nav-item col-xs-3">
            <a href="/meal_tags" class="container-tabs">食事関連</a>
          </li>
          <li class="nav-item col-xs-3 active">
            <a href="/task_tags" class="container-tabs">その他</a>
          </li>
        </ul>
      </div>
      <div class="list-group">
        @foreach($tags as $tag)
          <div class="tags-index-item row" data-id="{{$tag->id}}" data-name="{{$tag->name}}">
            <div class="tag-name col-xs-8">
              <p>{{$tag->name}}</p>
            </div>
            <div class="tag-count col-xs-4">
              <a href="/users/other?tag_id={{ $tag->id }}">
                タスク一覧
              </a>
              <p>{{ $tasks->where('tag_id', $tag->id)->count() }}件</P>
            </div>
            <div class="to-create-tag-index col-xs-12">
              <a href="{{ route('tasks.create') }}">タスク作成</a>
	    </div>

            <div class="col-xs-12 to-create-tag-index-bottom"> 
	    <div class="to-create-tag-index">
              <p class="modal-open-btn" data-toggle="modal" data-target="#tag-create-modal" data-type="@edit" data-id="{{$tag->id}}" data-name="{{$tag->name}}">タグ編集</p>
            </div>
            <div class="to-create-tag-index">
              <form action="{{ route('task_tags.delete', $tag->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="delete-btn" onclick="return confirm('タグ{{$tag->name}}を削除します。\nタグを削除すると関連するタスクも削除されます。\nタグを削除してよろしいですか？')">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
	    </div>
            </div>

          </div>
        @endforeach
      </div>
    </nav>
  </div>
</div>
@endsection
