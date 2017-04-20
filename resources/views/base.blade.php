<!DOCTYPE html>
<html lang="en">
@section('head')
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Data Rhino | @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
  {{ HTML::style('public/bower_components/mui/packages/cdn/css/mui.css') }}

  @show
</head>
@show

@section('body')

@section('footer')
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Copyright © Israel Flores 2017</p>
</footer>
@stop

@show



@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  {{ HTML::script('public/bower_components/mui/packages/cdn/js/mui.js') }}
@show


</html>

