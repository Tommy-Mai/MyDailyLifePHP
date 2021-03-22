@extends('common.application')

@section('title', 'アカウント編集')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">アカウント編集</div>

            <div class="card-body">
                <form method="POST" action="{{ route('user_home.edit') }}" enctype="multipart/form-data">
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
                        <label for="name" class="col-md-4 col-form-label text-md-right">ユーザー名</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">画像</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" onchange="previewImage(this);">
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
        <a href="{{ route('user_home.edit_password') }}">パスワードの変更はこちらから</a>
    </div>
</div>
@endsection
