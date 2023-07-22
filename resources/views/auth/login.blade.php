<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- PAGE TITLE HERE -->
    <title>Auth Page</title>

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
                                                    <div class="tab-pane fade show active" id="nav-personal"
                                                        role="tabpanel" aria-labelledby="nav-personal-tab">
                                                        <form method="POST" action="{{ url('/auth/login') }}"
                                                            class="dz-form pb-3">
                                                            @csrf
                                                            <h3 class="form-title m-t0">Sign In</h3>
                                                            <div class="dz-separator-outer m-b5">
                                                                <div class="dz-separator bg-primary style-liner"></div>
                                                            </div>
                                                            <p>Enter your NIK or e-mail address and your password. </p>
                                                            <input type="hidden" name="lat" id="lat">
                                                            <input type="hidden" name="long" id="long">
                                                            <div class="form-group mb-3">
                                                                <input type="text"
                                                                    class="form-control @error('login') is-invalid @enderror"
                                                                    id="login" placeholder="Enter NIK or Email"
                                                                    name="login" value="{{ old('login') }}">
                                                                @error('login')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <input type="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    id="password" placeholder="Enter Password"
                                                                    name="password">
                                                                @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group text-left mb-5 forget-main">
                                                                <button type="submit" class="btn btn-primary">Sign Me
                                                                    In</button>

                                                                <button
                                                                    class="nav-link m-auto btn tp-btn-light btn-primary forget-tab "
                                                                    id="nav-forget-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#nav-forget" type="button"
                                                                    role="tab" aria-controls="nav-forget"
                                                                    aria-selected="false">Forget Password ?</button>
                                                            </div>

                                                        </form>
                                                        <div class="text-center bottom">
                                                            <button class="btn btn-primary button-md btn-block"
                                                                id="nav-sign-tab" data-bs-toggle="tab"
                                                                data-bs-target="#nav-sign" type="button"
                                                                role="tab" aria-controls="nav-sign"
                                                                aria-selected="false">Create an
                                                                account</button>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-forget" role="tabpanel"
                                                        aria-labelledby="nav-forget-tab">
                                                        <form class="form-body" action="{{route('forget.password.post')}}" method="post">
                                                            @csrf
                                                            <h3 class="form-title m-t0">Forget Password ?</h3>
                                                            <div class="dz-separator-outer m-b5">
                                                                <div class="dz-separator bg-primary style-liner"></div>
                                                            </div>
                                                            <p>Enter your e-mail address below to reset your password.
                                                            </p>
                                                            <div class="form-group mb-4">
                                                                <input required="" class="form-control"
                                                                    placeholder="Email Address" type="text" id="email" name="email" value="{{old('email')}}">
                                                            </div>
                                                            <div class="form-group clearfix text-left">
                                                                <button class=" active btn btn-danger"
                                                                    id="nav-personal-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#nav-personal" type="button"
                                                                    role="tab" aria-controls="nav-personal"
                                                                    aria-selected="true">Back</button>
                                                                <button
                                                                    class="btn btn-primary float-end" type="submit">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-sign" role="tabpanel"
                                                        aria-labelledby="nav-sign-tab">
                                                        <form class="dz-form py-2"
                                                            action="{{ route('resgister.post') }}" method="post">
                                                            @csrf
                                                            <h3 class="form-title">Sign Up</h3>
                                                            <div class="dz-separator-outer m-b5">
                                                                <div class="dz-separator bg-primary style-liner"></div>
                                                            </div>
                                                            <p>Enter your personal details below: </p>
                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control @error('full_name') is-invalid @enderror"
                                                                    placeholder="Full Name" type="text"
                                                                    name="full_name" value="{{ old('full_name') }}">
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control @error('nik') is-invalid @enderror"
                                                                    placeholder="NIK" type="text" name="nik"
                                                                    value="{{ old('nik') }}">
                                                                @error('nik')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    placeholder="Email Address" type="text"
                                                                    name="email" value="{{ old('email') }}">
                                                                @error('email')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <input
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    placeholder="Password" type="password"
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
                                                                    placeholder="Re-type Your Password"
                                                                    type="password" name="password_confirmation">
                                                                @error('password_confirmation')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group clearfix text-left">
                                                                <button class="btn btn-danger outline gray"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#nav-personal" type="button"
                                                                    role="tab" aria-controls="nav-personal"
                                                                    aria-selected="true">Back</button>
                                                                <button class="btn btn-primary float-end"
                                                                    type="submit">Submit</button>
                                                            </div>
                                                        </form>

                                                    </div>
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
