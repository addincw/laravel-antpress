<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Fixed Navigation - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin
    Dashboard
  </title>
  <link rel="apple-touch-icon" href="{{ asset('theme/modern-admin-1.0/app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/modern-admin-1.0/app-assets/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/vendors.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/vendors/css/ui/prism.min.css') }}">
  @yield('css')
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/app.css') }}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/app-assets/css/core/colors/palette-gradient.css') }}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/modern-admin-1.0/assets/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-theme.css') }}">
  <!-- END Custom CSS-->
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover"
data-menu="horizontal-menu" data-col="2-columns">
  <!-- fixed-top-->
  @include('layouts.visitor.navbar')

  <div class="visitor app-content content">
    <div class="content-wrapper">

      @if(session()->exists('status'))
      <div id="alert-notification" class="alert bg-{{ session('status')['code'] }} alert-icon-left alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="ft-bell"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <strong>{{ strtoupper(session('status')['code']) }}!</strong> {{ session('status')['message'] }}
      </div>
      @php session()->forget('status'); @endphp
      @elseif($errors->any())
      <div class="alert bg-warning alert-icon-left alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="ft-bell"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <strong>warning!</strong> Gagal menyimpan testimoni :
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="content-body">
        @yield('content')
      </div>
    </div>
  </div>
  <!-- footer-->
  @section('footer')
    @include('layouts.footer')
  @show
  <!-- BEGIN VENDOR JS-->
  <script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  @yield('js')

  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
  <script type="text/javascript" src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('theme/modern-admin-1.0/app-assets/vendors/js/ui/prism.min.js') }}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('theme/modern-admin-1.0/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('theme/modern-admin-1.0/app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('theme/modern-admin-1.0/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="{{ asset('theme/modern-admin-1.0/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
