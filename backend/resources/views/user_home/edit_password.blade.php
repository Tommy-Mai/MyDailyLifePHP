@extends('common.application')

@section('title', 'パスワード変更')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">パスワードの変更</div>

            <div class="card-body">
                <form method="POST" action="{{ route('user_home.edit_password') }}">
                @csrf
                @if(count($errors) > 0)
                <div class="container mt-2">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
                @endif

                    <div class="form-group row">
                        <label for="current_password" class="col-md-4 col-form-label text-md-right required">現在のパスワード</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="current_password" autocomplete="current_password" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right required">新しいパスワード　　　　</br>(8文字以上)</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="new_password" autocomplete="new_password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password_confirm" class="col-md-4 col-form-label text-md-right required">新しいパスワード(確認)</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="new_password_confirmation" autocomplete="new_password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn form-btn">
                                登録
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('user_home.edit') }}">パスワード以外の変更はこちらから</a>
    </div>
</div>
@endsection
