@extends('common.application')

@section('title', 'ユーザーページ')

@section('create-modal')
<div class="modal" id="tag-create-modal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div id="create-modal" class="modal-hide">
        <div class="modal-header panel-heading form-title">
          <div id="createModalLabel">メモ新規作成</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('memo.create') }}" class="form-items">
          <div class="modal-body">
            @csrf
            <label class="form-label col-xs-12 required">タイトル</label>
            <input type="text" name="name" class="col-xs-12" value="{{ old('name') }}"/>
            <label class="form-label col-xs-12">詳細</label>
            <textarea class="col-xs-12" name="description" value="{{ old('description') }}"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn form-btn col-xs-3 col-xs-offset-9">作成</button>
          </div>
        </form>
      </div>

      <!-- ここから編集フォーム -->
      <div id="edit-modal" class="modal-hide">
        <div class="modal-header panel-heading form-title">
          <div id="editModalLabel">メモ編集</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- 以下のformのアクションはjQueryで配置 -->
        <form method="POST" class="form-items" id="edit-modal-form-memo">
          <div class="modal-body">
            @csrf
            <label class="form-label col-xs-12 required">タイトル</label>
            <input type="text" name="name" class="col-xs-12" value="{{ old('name') }}" id="edit-modal-name" />
            <label class="form-label col-xs-12">詳細</label>
            <textarea class="col-xs-12" name="description" value="{{ old('description') }}" id="edit-modal-description"></textarea>
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
  <div class="row">
    <div class="col col-xs-12 main-container">
        <!-- ユーザー情報表示 -->
        <div class="user-info-container row">
          <div class="col-xs-2 col-xs-offset-2">
            <img src="{{ asset('storage/profiles/'.$user->image) }}" alt="プロフィール画像" class="rounded-circle user-img">
          </div>
          <div class="row user-info-items col-xs-6">
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
            <ul class="nav container-tabs">
              <li class="nav-item col-xs-3">
                <a href="/users" class="container-tabs">食事関連</a>
              </li>
              <li class="nav-item col-xs-3">
                <a href="/users/other" class="container-tabs">その他</a>
              </li>
              <li class="nav-item col-xs-3 active">
                <a href="/users/memo" class="container-tabs">メモ</a>
              </li>
            </ul>
          </div>

          <div class="panel-heading home-create-tab">
            <p class="container-tabs modal-open-btn-memo memo-create" data-toggle="modal" data-target="#tag-create-modal" data-type="@create">新規食事メモ作成＋</p>
          </div>

          <div class="list-group">
            @foreach($memos as $memo)
              <div class="task-index-item row memo-container">
                <div class="col-xs-12 task-index-tag memo-name" id="{{$memo->id}}">
                  <p>{{$memo->name}}</p>
                </div>
                <div class="task-name col-xs-12 memo-description">
                  <p>{!! nl2br(e($memo->description)) !!}</p>
                  </div>
                <div class="to-create-tag-index col-xs-11 memo-btn">
                  <p class="modal-open-btn-memo" data-toggle="modal" data-target="#tag-create-modal" data-type="@edit" data-id="{{$memo->id}}" data-name="{{$memo->name}}" data-description="{{$memo->description}}">メモ編集</p>
                </div>
                <div class="to-create-tag-index col-xs-1 memo-btn">
                  <form action="{{ route('memo.delete', $memo->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="delete-btn" onclick="return confirm('「{{$memo->name}}」を削除してよろしいですか？')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </nav>
        {{ $memos->links('vendor.pagination.bootstrap-4') }}
    </div>
  </div>
@endsection
