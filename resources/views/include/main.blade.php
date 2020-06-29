<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>بنك البركة سوريا </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Defualt Bank Font -->
  <link rel="stylesheet" href="{{ asset('dist/css/fonts.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-red.min.css') }}">

<!--   <link rel="stylesheet" href="{{ asset('ui/jquery-ui.css') }}"> -->

  <style>
    preventcopy {
    -webkit-touch-callout: none; iOS Safari
    -webkit-user-select: none; Chrome/Safari/Opera
    -khtml-user-select: none; Konqueror
    -moz-user-select: none; Firefox
    -ms-user-select: none; Internet Explorer/Edge
    user-select: none; Non-prefixed version, currently
    not supported by any browser
    }
  </style>
  
  @isset($styles)
    @foreach ($styles as $style)
          <link rel="stylesheet" href="{{ asset($style) }}">
    @endforeach  
  @endisset  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 3 -->
  <!-- <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script> -->
  <script src="{{ asset('ui/external/jquery/jquery.js') }}"></script>
  <script src="{{ asset('ui/jquery-ui.js') }}"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<style type="text/css">
  .select2-results__option{
    text-align: right;
  }
</style>
<body class="hold-transition skin-blue sidebar-mini " style="font-family: 'Janna LT'">
<div class="wrapper">

  <!-- Main Header -->

 @include('include.header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('include.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!--     <section class="content-header" style="float: right;=">
      <h1>
         نظام أتمتة الوثائق  
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      @include($_view)
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('include.footer')
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

  @isset($scripts)
    @foreach ($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach
  @endisset 
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
    @isset($table_script)
      <script>
        $(document).ready(function() { 
          $('#example1').DataTable({
            "oLanguage": {
              "sSearch": "_INPUT_ البحث",
              "sLengthMenu": "إظهار _MENU_ عنصر",
              "sZeroRecords": "لا يوجد عناصر",
              "oPaginate":{
                "sNext":"التالي",
                "sPrevious":"السابق"
              },
              "sInfo":"إظهار من _START_ حتى _END_ من بين _TOTAL_ عنصر",
              "sInfoFiltered": " (يوجد _TOTAL_ نتيجة بحث مطابقة من أصل _MAX_)",
              "sInfoEmpty":"",
              "sLoadingRecords": "جاري التحميل ...",
              "sProcessing":     "جاري المعالجة ...",
            }
          })
        })
      </script>
    @endisset 
    @isset($table_script_2)
      <script>
        $(function () {
          $('#example2').DataTable({
            "oLanguage": {
              "sSearch": "_INPUT_ البحث",
              "sLengthMenu": "إظهار _MENU_ عنصر",
              "sZeroRecords": "لا يوجد عناصر",
              "oPaginate":{
                "sNext":"التالي",
                "sPrevious":"السابق"
              },
              "sInfo":"إظهار من _START_ حتى _END_ من بين _TOTAL_ عنصر",
              "sInfoFiltered": " (يوجد _TOTAL_ نتيجة بحث مطابقة من أصل _MAX_)",
              "sInfoEmpty":"",
              "sLoadingRecords": "جاري التحميل ...",
              "sProcessing":     "جاري المعالجة ...",
            }
          })
        })
      </script>
    @endisset
    @isset($daterange)
      <script type="text/javascript">
        $(document).ready(function() {
          $('{{$daterange}}').daterangepicker({
            singleDatePicker : true,
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
              format: 'MM/DD/YYYY hh:mm A'
            }
          })
        });
      </script>
    @endisset
  @include('global_modal.error_modal')
  @include('global_modal.success_modal')
  @include('global_modal.confirm_modal')
</body>
</html>