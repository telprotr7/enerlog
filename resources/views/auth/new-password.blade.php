<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- PAGE TITLE HERE -->
    <title>Reset Password</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="{{ asset('') }}/assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">

</head>

<div class="flash-error-login" data-errorlogin="{{ session('errorLogin') }}"></div>
<div class="flash-error" data-error="{{ session('error') }}"></div>
<div class="flash-success" data-success="{{ session('success') }}"></div>

<body class="vh-100">
    <div class="page-wraper">

        <!-- Content -->
        <div class="browse-job login-style3">
            <!-- Coming Soon -->
            <div class="bg-img-fix overflow-hidden"
                style="background:#fff url(http://localhost/enerlog/public/assets/images/background/bg6.jpg); height: 100vh;">
                <div class="row gx-0">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 bg-white ">
                        <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside"
                            style="max-height: 653px;" tabindex="0">
                            <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                                dir="ltr">
                                <div class="login-form style-2">


                                    <div class="card-body">
                                        <div class="logo-header">
                                            <a href="{{ route('login') }}" class="logo"><img
                                                    src="{{ asset('') }}/assets/images/logo/logo-full.png"
                                                    alt="" class="light-logo"
                                                    style="width:150px !important"></a>
                                            <a href="{{ route('login') }}" class="logo"><img
                                                    src="{{ asset('') }}/assets/images/logo/logofull-white.png"
                                                    alt="" class="width-230 dark-logo"
                                                    style="width:150px !important"></a>
                                        </div>                                        
                                        <nav>
                                            <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">

                                                <div class="tab-content w-100" id="nav-tabContent">
                                                  
                                                    

                                                        <form class="form-body" action="{{route('reset.password.post')}}" method="POST">
                                                            @csrf
                                                            <h3 class="form-title">Genrate New Password</h3>
                                                            <div class="dz-separator-outer m-b5">
                                                                <div class="dz-separator bg-primary style-liner"></div>
                                                            </div>
                                                            <p>We received your reset password request. Please enter your new password!</p>
                                                            <div class="form-group mt-3">
                                                                <input type="text" hidden name="token" value="{{$token}}">
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control"
                                                                    placeholder="Email Address" type="text"
                                                                    name="email" value="{{$email}}" readonly>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    placeholder="New Password" type="password"
                                                                    name="password">
                                                                @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3 mb-3">
                                                                <input
                                                                    class="form-control @error('password_confimration') is-invalid @enderror"
                                                                    placeholder="Re-type New Password"
                                                                    type="password" name="password_confirmation">
                                                                @error('password_confirmation')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group clearfix text-left">
                                                                
                                                                <a href="{{route('login')}}" class="btn btn-danger outline gray">Back</a>
                                                            
                                                                <button class="btn btn-primary float-end"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </form>

                                                    
                                                </div>

                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card-footer">
                                        <div class=" bottom-footer clearfix m-t10 m-b20 row text-center">
                                            <div class="col-lg-12 text-center">
                                                <span> © Copyright by <span class="heart"></span>
                                                    <a href="javascript:void(0);">EnerLog</a> All rights
                                                    reserved.</span>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="mCSB_1_scrollbar_vertical"
                                class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical"
                                style="display: block;">
                                <div class="mCSB_draggerContainer">
                                    <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                        style="position: absolute; min-height: 0px; display: block; height: 652px; max-height: 643px; top: 0px;">
                                        <div class="mCSB_dragger_bar" style="line-height: 0px;"></div>
                                        <div class="mCSB_draggerRail"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Full Blog Page Contant -->
        </div>
        <!-- Content END-->
    </div>

    <!--**********************************
 Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('') }}/assets/vendor/global/global.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="{{ asset('') }}/assets/js/plugins-init/toastr-init.js"></script>
    <script src="{{ asset('') }}/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('') }}/assets/js/deznav-init.js"></script>
    <script src="{{ asset('') }}/assets/js/custom.js"></script>
    <script src="{{ asset('') }}/assets/js/demo.js"></script>
    <script src="{{ asset('') }}/assets/js/styleSwitcher.js"></script>
    <script src="{{ asset('') }}/assets/js/myNotif.js"></script>

</body>

</html>
