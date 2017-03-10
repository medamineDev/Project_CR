<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminCreche  | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href=" {{ URL::asset('template/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('template/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('template/dist/css/AdminLTE.min.css') }} ">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::asset('template/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield("css")
</head>
<body id="app-layout" class="hold-transition skin-blue sidebar-mini">




    @yield('content')










    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}


            <!-- jQuery 2.2.3 -->
<script src="{{ URL::asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}  "></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('template/bootstrap/js/bootstrap.min.js') }} "></script>
<!-- FastClick -->
<script src="{{ URL::asset('template/plugins/fastclick/fastclick.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('template/dist/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('template/plugins/sparkline/jquery.sparkline.min.js') }}  "></script>
<!-- jvectormap -->
<script src="{{ URL::asset('template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }} "></script>
<script src="{{ URL::asset('template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }} "></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ URL::asset('template/plugins/slimScroll/jquery.slimscroll.min.js') }} "></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ URL::asset('template/plugins/chartjs/Chart.min.js') }} "></script>

<!-- AdminLTE for demo purposes -->
<script src=" {{ URL::asset('template/dist/js/demo.js') }} "></script>
<!-- page script -->


@yield("javascript")


</body>
</html>
