@extends('base')
@section('title', 'Register')
@section('styles')
  @parent
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {{ HTML::style('bower_components/adminlte/dist/css/AdminLTE.min.css') }}
  {{ HTML::style('css/register.css') }}
@endsection

@section('body')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>Data</b>Rhino</a>
  </div>

  <div class="register-box-body">
    <h3 class="login-box-msg">Create an account</h3>
    <ul id="messages" class="error-category"></ul>
    <form class="mui-form" method="post" action="/register" id="register">
        {{ csrf_field() }}
        <div class="mui-textfield">
          <input type="text" placeholder="Name" name="name" id="name">
        </div>
        <div class="mui-textfield">
          <input type="email" placeholder="Email" name="email" id="email">
        </div>
        <div class="mui-textfield">
          <input type="password" placeholder="Password" name="pass" id="pass">
        </div>
        <div class="mui-textfield">
            <input type="password" placeholder="Re-type Password" name="retype" id="retype" >
        </div>
        <div class="row">
          <button type="submit" class="btn-block btn-full-width mui-btn mui-btn--raised mui-btn--primary">Register</button>
        </div>
    </form>
    <p>By creating an account you agree to Data Rhino's <a href="/terms">Conditions of Use</a> and <a href="/policy">Privacy Notice</a></p>
    </form>
    <hr></hr>
    Already have an account? <a href="/login" class="text-center">Sign in</a>
  </div>
  <!-- /.form-box -->
</div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- /.register-box -->
</body>
@endsection

@section('scripts')
    @parent
    {{ HTML::script('js/register.js') }}
@endsection
