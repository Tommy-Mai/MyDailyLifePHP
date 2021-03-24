@extends('common.application')

@section('title', '管理者画面')

@section('content')
  <div class="row">
    <div class="col col-xs-12 main-container">

    <div class="container mt-2">
      @if (Session::has('message'))
        <li class="alert alert-danger">{{ session('message') }}</li>
      @endif
    </div>

        <nav class="panel panel-default">
          <div class="panel-heading form-title">
            <ul class="nav container-tabs">
              <li class="nav-item col-xs-12">
                <p class="container-tabs">ユーザー一覧</p>
              </li>
          </div>

          <div class="list-group">
            @foreach($users as $user)
              <div class="task-index-item row memo-container">
                <div class="col-xs-12 task-index-tag memo-name">
                  <p>{{$user->name}}</p>
                </div>
                <div class="task-name col-xs-12 memo-description">
                  <p>{{$user->email}}</p>
                </div>
                <div class="to-create-tag-index col-xs-11 memo-btn">
                  <form action="{{ route('admin.users_delete', $user->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="delete-btn" onclick="return confirm('「{{$user->name}}」を削除してよろしいですか？')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </nav>
    </div>
  </div>
@endsection