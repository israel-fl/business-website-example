@extends('base')
@section('title', 'Verify')
@section('styles')
  @parent
  <!-- Theme style -->
  {{ HTML::style('bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('css/register.css') }}
@endsection

@section('body')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Data</b>Rhino</a>
  </div>

  <div class="register-box-body">
    <h3 class="login-box-msg">Thank you for creating an account. Please verify your email. If you have not received one, click to resend it.</h3>
    <ul id="messages" class="error-category"></ul>
    <form id="register">

      <input type="hidden" id="url" value="">
      <input type="hidden" id="url-verify" value="">
      <div class="row">
          <button type="submit" id="register-btn" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary ">Resend</button>
      </div>
    </form>
    <hr></hr>
    Already verified? Take me <a href="/console" class="text-center">home</a>
  </div>
  <!-- /.form-box -->
</div>

@endsection

@section('scripts')
    @parent
    {{ HTML::script('js/register.js') }}
@endsection
