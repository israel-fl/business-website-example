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
    <h3 class="login-box-msg">Please check your email for a link to reset your password.</h3>
  </div>
  <!-- /.form-box -->
</div>

@endsection
