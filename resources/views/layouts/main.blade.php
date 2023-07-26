@php
    use App\Models\User;
    $users = User::all();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- PAGE TITLE HERE -->
    <title>{{ $title }}</title>
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/avatar/1.jpg">

    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/select2/css/select2-bootstrap4.css">
    <link href="{{ asset('') }}/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    <link href="{{ asset('') }}/assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/vendor/jvmap/jquery-jvectormap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Material color picker -->
    <link
        href="{{ asset('') }}/assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet">
    <!-- Clockpicker -->
    <link href="{{ asset('') }}/assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{ asset('') }}/assets/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <link href="{{ asset('') }}/assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/pickadate/themes/default.date.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- tagify-css -->
    <link href="{{ asset('') }}/assets/vendor/tagify/dist/tagify.css" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('') }}/assets/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black"
    data-headerbg="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Nav header start
        ***********************************-->
        @include('layouts.nav-header')
        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
            Chat box start
        ***********************************-->
        {{-- @include('layouts.chatbox') --}}
        <!--**********************************
            Chat box End
        ***********************************-->



        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->



        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




        <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample1">
            <div class="offcanvas-header">
                <h5 class="modal-title" id="#gridSystemModal1">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div class="container-fluid">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-2">
                                <label class="mb-0" for="start">Start Task</label>
                                <input type="text" class="form-control " name="start" id="date-format6">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="task_name">Nama Tugas</label>
                                <input type="text" class="form-control" id="task_name" name="task_name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-0" for="users_task">Pilih Petugas</label>
                                <select id="users_task" name="users_task[]" class="multiple-select" multiple required
                                    style="z-index: 9999;">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="status_task">Status</label>
                                <select class="default-select  form-control wide" name="status_task">
                                    <option value="">--Pilih Status--</option>
                                    <option value="Started">Started</option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Progress">In Progress</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="priority">Priority</label>
                                <select class="default-select  form-control wide" name="priority" id="priority">
                                    <option value="">--Pilih Priority--</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="task_type">Task Type</label>
                                <select class="default-select  form-control wide" name="task_type" id="task_type">
                                    <option value="">--Pilih Type Task--</option>
                                    <option value="Project">Project</option>
                                    <option value="Not Project">Not Project</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="end">End Task</label>
                                <input type="text" class="form-control " name="end" id="date-format3">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" class="keterangan">Keterangan <small>(optional)</small></label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="4" cols="4"
                                    value="{{ old('keterangan') }}" placeholder="Masukan keterangan jika ada!"></textarea>
                            </div>
                        </div>
                        <!-- tambahkan input untuk atribut lainnya -->
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>



        {{-- FORM ADD MEMBER --}}

        <div class="offcanvas offcanvas-end customeoff" tabindex="-1" id="offcanvasExample">
            <div class="offcanvas-header">
                <h5 class="modal-title" id="#gridSystemModal">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div class="container-fluid">
                    <div>
                        <label>Profile Picture</label>
                        <div class="dz-default dlab-message upload-img mb-3">
                            <form action="{{ route('members.add') }}" method="post" class="dropzone"
                                enctype="multipart/form-data">
                                @csrf
                                <img class="img-preview img-fluid mb-3 col-sm-5" style="margin-left:10px">
                                <svg width="41" height="40" viewBox="0 0 41 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20.5 20V35" stroke="#DADADA" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M34.4833 30.6501C36.1088 29.7638 37.393 28.3615 38.1331 26.6644C38.8731 24.9673 39.027 23.0721 38.5703 21.2779C38.1136 19.4836 37.0724 17.8926 35.6111 16.7558C34.1497 15.619 32.3514 15.0013 30.4999 15.0001H28.3999C27.8955 13.0488 26.9552 11.2373 25.6498 9.70171C24.3445 8.16614 22.708 6.94647 20.8634 6.1344C19.0189 5.32233 17.0142 4.93899 15.0001 5.01319C12.9861 5.0874 11.015 5.61722 9.23523 6.56283C7.45541 7.50844 5.91312 8.84523 4.7243 10.4727C3.53549 12.1002 2.73108 13.9759 2.37157 15.959C2.01205 17.9421 2.10678 19.9809 2.64862 21.9222C3.19047 23.8634 4.16534 25.6565 5.49994 27.1667"
                                        stroke="#DADADA" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M27.1666 26.6667L20.4999 20L13.8333 26.6667" stroke="#DADADA"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="fallback">
                                    <input id="img" name="image" type="file" onchange="previewImage()">

                                </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('nama') is-invalid
                            @enderror"
                                id="nama" name="nama" placeholder="">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="nik" class="form-label">NIK<span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('nik') is-invalid
                            @enderror"
                                name="nik" id="nik" placeholder=""
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text"
                                class="form-control @error('email') is-invalid
                            @enderror"
                                name="email" id="email" placeholder="">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                            <select
                                class="default-select wide form-control @error('role') is-invalid
                            @enderror"
                                id="role" name="role" tabindex="null">
                                <option data-display="Select">Please select</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select
                                class="default-select wide form-control @error('status') is-invalid
                            @enderror"
                                id="status" name="status" tabindex="null">
                                <option data-display="Select">Please select</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonactive</option>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="no_wa" class="form-label">Kontak</span></label>
                            <input type="text"
                                class="form-control @error('no_wa') is-invalid
                            @enderror"
                                id="no_wa" placeholder="(+62)" name="no_wa"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text"
                                class="form-control @error('tempat_lahir') is-invalid
                            @enderror"
                                name="tempat_lahir" id="tempat_lahir" placeholder="">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input name="tanggal_lahir"
                                class="datepicker-default form-control picker__input @error('tanggal_lahir') is-invalid
                            @enderror"
                                id="datepicker" readonly="" aria-haspopup="true" aria-expanded="false"
                                aria-readonly="false" aria-owns="datepicker_root">
                        </div>
                        <div class="col-xl-12 mb-3">
                            <label for="password" class="form-label">Password<span
                                    class="text-danger">*</span></label>
                            <input type="password"
                                class="form-control @error('password') is-invalid
                            @enderror"
                                name="password" id="password" placeholder="">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END FORM ADD MEMBER --}}




    <!--**********************************
            Footer start
        ***********************************-->
    @include('layouts.footer')
    <!--**********************************
            Footer end
        ***********************************-->



    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('') }}/assets/vendor/global/global.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/select2/js/select2.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('') }}/assets/js/dashboard/dashboard-1.js"></script>
    <script src="{{ asset('') }}/assets/vendor/draggable/draggable.js"></script>



    <!-- tagify -->
    <script src="{{ asset('') }}/assets/vendor/tagify/dist/tagify.js"></script>


    <script src="{{ asset('') }}/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/datatables/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/datatables/js/jszip.min.js"></script>
    <script src="{{ asset('') }}/assets/js/plugins-init/datatables.init.js"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('') }}/assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
    <script src="{{ asset('') }}/assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>



    <!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="{{ asset('') }}/assets/vendor/moment/moment.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- clockpicker -->
    <script src="{{ asset('') }}/assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <!-- asColorPicker -->
    <script src="{{ asset('') }}/assets/vendor/jquery-asColor/jquery-asColor.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
    <!-- Material color picker -->
    <script
        src="{{ asset('') }}/assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <!-- pickdate -->
    <script src="{{ asset('') }}/assets/vendor/pickadate/picker.js"></script>
    <script src="{{ asset('') }}/assets/vendor/pickadate/picker.time.js"></script>
    <script src="{{ asset('') }}/assets/vendor/pickadate/picker.date.js"></script>

    {{-- JAM FORMAT INDO --}}
    <script src="{{ asset('') }}/assets/js/locale/id.js"></script>

    <!-- Daterangepicker -->
    <script src="{{ asset('') }}/assets/js/plugins-init/bs-daterange-picker-init.js"></script>
    <!-- Clockpicker init -->
    <script src="{{ asset('') }}/assets/js/plugins-init/clock-picker-init.js"></script>
    <!-- asColorPicker init -->
    <script src="{{ asset('') }}/assets/js/plugins-init/jquery-asColorPicker.init.js"></script>
    <!-- Material color picker init -->
    <script src="{{ asset('') }}/assets/js/plugins-init/material-date-picker-init.js"></script>
    <!-- Pickdate -->
    <script src="{{ asset('') }}/assets/js/plugins-init/pickadate-init.js"></script>

    <script src="{{ asset('') }}/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Vectormap -->
    <script src="{{ asset('') }}/assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/jqvmap/js/jquery.vmap.world.js"></script>
    <script src="{{ asset('') }}/assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="{{ asset('') }}/assets/js/custom.js"></script>
    <script src="{{ asset('') }}/assets/js/deznav-init.js"></script>
    <script src="{{ asset('') }}/assets/js/demo.js"></script>
    <script src="{{ asset('') }}/assets/js/styleSwitcher.js"></script>


    <script>
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>

</body>

</html>
