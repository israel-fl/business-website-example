@extends('base')
@section('title', 'Login')
@section('styles')
  @parent
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {{ HTML::style('bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('css/login.css') }}
@endsection

@section('body')
  <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Data</b>Rhino</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="mui-form" method="post" action="/login">
      {{ csrf_field() }}
  <legend>Login</legend>
  <div class="mui-textfield">
    <input type="username" placeholder="Username" name="username" id="username">
  </div>
  <div class="mui-textfield">
    <input type="password" placeholder="Password" name="pass" id="pass">
  </div>
    <div class="mui-checkbox">
    <label>
      <input type="checkbox" value="true" name="remember-email" id="remember-email" >
      <label for="remember-email">
        Remember email?
      </label>
  </div>
  <div class="row">
    <button type="submit" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary">Submit</button>
  </div>
</form>
</hr>
<div class="row text-center">
      <a href="#">I forgot my password</a><br>
</div>
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
  @section('scripts')
  @parent

  @endsection
  </body>
@endsection
