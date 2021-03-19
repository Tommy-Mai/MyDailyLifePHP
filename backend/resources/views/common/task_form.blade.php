@extends('common.application')

@section('content')
<div class="row">
  <div class="col col-sm-10 main-container">
    <div class="panel panel-default">
      <div class="panel-heading form-title">@yield('form-title')</div>
      <div class="panel-body">
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
              <p>{{ $message }}</p>
            @endforeach
          </div>
        @endif
        @yield('form-items')
      </div>
    </div>
  </div>
</div>
@endsection
