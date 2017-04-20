@extends('base')
@section('title', 'Verify')
@section('styles')
  @parent
  <!-- Theme style -->
  {{ HTML::style('public/bower_components/adminlte/dist/css/AdminLTE.min.css') }}
@endsection

@section('body')

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>Data</b>Rhino</a>
  </div>

  <div class="register-box-body">
    <h3 class="login-box-msg">Thank you for verifying your account</h3>
    Go <a href="/login">home</a>
  </div>
  <!-- /.form-box -->
</div>

@endsection
