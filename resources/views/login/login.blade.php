@extends('base')
@section('title', 'Login')
@section('styles')
  @parent
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {{ HTML::style('public/bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('public/css/login.css') }}
@endsection

@section('body')
  <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Data</b>Rhino</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
    <h3 class="login-box-msg">Login</h3>
      <form class="mui-form" method="post" action="/login" id="login">
      {{ csrf_field() }}
  <div class="mui-textfield">
    <input type="email" placeholder="Email" name="email" id="email">
  </div>
  <div class="mui-textfield">
    <input type="password" placeholder="Password" name="pass" id="pass">
  </div>
  <div class="row">
    <button type="submit" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary">Submit</button>
  </div>
</form>
</hr>
<div class="row text-center">
      <a href="/reset">I forgot my password</a><br>
</div>
<hr></hr>
    Don't have an account? <a href="/register" class="text-center">Register</a>
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
{{ HTML::script('public/js/login.js') }}
@endsection
