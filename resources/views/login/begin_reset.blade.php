@extends('base')
@section('title', 'Reset')
@section('styles')
  @parent
  <!-- Theme style -->
  {{ HTML::style('bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('css/register.css') }}
@endsection

@section('body')

 <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Data</b>Rhino</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    <h3 class="login-box-msg">Please enter an email so that we may reset your password</h3>
      <form class="mui-form" method="post" action="/reset" id="login">
      {{ csrf_field() }}
  <div class="mui-textfield">
    <input type="email" placeholder="Email" name="email" id="email">
  </div>
  <div class="row">
    <button type="submit" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary">Submit</button>
  </div>
</form>
</div>
<ul id="messages" class="error-category"></ul>
<div class="row">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
</div>
    <!-- /.login-box-body -->


  </div>
  <!-- /.login-box -->
</body>

@endsection

@section('scripts')
    @parent
@endsection
