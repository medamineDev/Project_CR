<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

    <style>

        .notif_error , .notif_success {
            position: fixed;
            right: -430px;
            top: 64px;
            width: 420px;


        }
    </style>

    @yield("css")
</head>
<body id="app-layout" class="hold-transition skin-blue sidebar-mini">




    @yield('content')



    <div  id="notif_success" class="alert alert-success alert-dismissible notif_success">
        <button type="button" id="closeSuccessNotif" class="close" >×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <p id="body_notif_success">Opération Réussite ! </p>
    </div>


    <div id="notif_error" class="alert alert-danger alert-dismissible notif_error">
        <button type="button" id="closeErroNotif"  class="close">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <p class=body_notif_error">Opération Echouée !</p>
    </div>

   <!-- Todo remove if errors in js
   <script src="{{ URL::asset('template/bootstrap/js/bootstrap.min.js') }} "></script>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}


            <!-- jQuery 2.2.3 -->
<script src="{{ URL::asset('template/plugins/jQuery/jquery-2.2.3.min.js') }}  "></script>
<!-- Bootstrap 3.3.6 -->

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




<script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


        function showSuccessMessage(msg) {

            $('#body_notif_success').html(msg);
            var domObject = $('#notif_success');
            closeNotif(domObject);
            openNotif(domObject);
        }


        function showErrorMessage(msg) {

            $('#body_notif_error').html(msg);
            var domObject =$('#notif_error');
            closeNotif(domObject);
            openNotif(domObject);
        }

        function closeNotif(notif) {

            notif.animate({
                right: '-450px'
            });
        }

        function openNotif(notif) {

            notif.animate({
                right: '3px'
            });

            setTimeout(function () {

                closeNotif(notif);
            },5000);
        }


</script>




    @yield("javascript")

</body>
</html>
