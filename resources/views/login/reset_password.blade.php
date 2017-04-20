@extends('base')
@section('title', 'Reset')
@section('styles')
  @parent
  <!-- Theme style -->
  {{ HTML::style('public/bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('public/css/register.css') }}
@endsection

@section('body')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>Data</b>Rhino</a>
  </div>

  <div class="register-box-body">
  <div class="login-box-body">
    <h3 class="login-box-msg">Enter a new password</h3>
      <form class="mui-form" method="post" action="/reset/verify" id="login">
      {{ csrf_field() }}
        <div class="mui-textfield">
            <input type="password" placeholder="Pass" name="pass" id="pass">
        </div>
        <div class="mui-textfield">
            <input type="password" placeholder="Re-type password" name="retype" id="retype">
        </div>
        <div class="row">
        <input type="hidden" name="user" id="user" value="{{ $user->id }}">
        <button type="submit" id="reset-btn" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary ">Submit</button>
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>

@endsection

@section('scripts')
    @parent
@endsection
