<html class="loaded" lang="en" data-textdirection="ltr"><!-- BEGIN: Head--><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="Custom CMS, Hospitality Website, Website Rumah Sakit, Company Profile">
    <meta name="author" content="inidokterku">
    <title>Ini Dokterku</title>
    <link rel="apple-touch-icon" href="{{ url('img/logo-sm-blue.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/logo-sm-blue.jpeg') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/components.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/app-assets/css/pages/login-register.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('theme/modern-admin-1.0/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

  <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="horizontal-layout horizontal-menu 1-column blank-page pace-done menu-collapsed" data-open="hover" data-menu="horizontal-menu" data-col="1-column"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                @if(session()->exists('status'))
                <div id="alert-notification" 
                    class="alert bg-{{ session('status')['code'] }} alert-icon-left alert-dismissible mb-2" 
                    role="alert"
                    style="width: 100%; border-radius: 0px;">
                    <span class="alert-icon"><i class="ft-bell"></i></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{ strtoupper(session('status')['code']) }}!</strong> {!! html_entity_decode(session('status')['message']) !!}
                </div>
                @php session()->forget('status'); @endphp
                @endif
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <div class="p-1"><img src="{{ url('img/logo-full.jpeg') }}" width="60%" alt="inidokterku logo"></div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with Inidokterku</span></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple" method="post" action="{{ url('/admin/login') }}" novalidate="">
                            {{ csrf_field() }}
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <input type="text" class="form-control" id="user-name" name="username" placeholder="Your Username" required="">
                                <div class="form-control-position">
                                    <i class="la la-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control" id="user-password" name="password" placeholder="Enter Password" required="">
                                <div class="form-control-position">
                                    <i class="la la-key"></i>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                    <fieldset>
                                        <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="remember-me" class="chk-remember" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                        <label for="remember-me" class=""> Remember Me</label>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6 col-12 text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                            </div>
                            <button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ url('theme/modern-admin-1.0/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ url('theme/modern-admin-1.0/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ url('theme/modern-admin-1.0/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ url('theme/modern-admin-1.0/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ url('theme/modern-admin-1.0/app-assets/js/core/app.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ url('theme/modern-admin-1.0/app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
    <!-- END: Page JS-->

  
  <!-- END: Body-->
</body></html>