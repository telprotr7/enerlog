@extends('layouts.main')
@section('content')
    @php
        
        use Illuminate\Support\Carbon;
        $nowYear = Carbon::now()->format('Y');
        $iniBulan = Carbon::now()->format('F');
        $nowMonth = Carbon::now()->month - 1;
        
    @endphp

    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/select2/css/select2-bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">
    <div class="flash-error" data-error="{{ session('error') }}"></div>
    <div class="flash-success" data-success="{{ session('success') }}"></div>

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Database AC</a></li>
        </ol>
    </div>
    <!-- container starts -->
    <div class="container-fluid">


        <div class="demo-view">
            <div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">

                <!-- Column starts -->
                <div class="col-xl-12">
                    <div class="card dz-card" id="accordion-four">
                        <div class="card-header flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Data Analytic AC</h4>
                            </div>
                        </div>
                        <!-- /tab-content -->
                        <div class="tab-content" id="myTabContent-3">

                            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                aria-labelledby="home-tab-3">
                                <div class="card-body pt-0">
                                    <div class="mb-3">

                                        <a href="{{ url('/ac') }}" class="btn btn-warning btn-icon-xxs"><i
                                                class='bx bx-arrow-back'></i> BACK</a>

                                        <button type="button" class="btn btn-primary btn-icon-xxs" data-bs-toggle="modal"
                                            data-bs-target="#modalCreateChart"><i class='bx bx-plus-medical'></i></button>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <form action="{{ url('/chart/search') }}">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-primary" type="submit">Search</button>
                                                    <select class="default-select  form-control wide" name="updateTahun"
                                                        id="updateTahun">
                                                        <option value="">Pilih Tahun</option>
                                                        @foreach ($listUpdateTahun as $list)
                                                            <option value="{{ $list->tahun }}"
                                                                {{ $list->tahun == $tahunTerpilih ? 'selected' : '' }}>
                                                                {{ $list->tahun }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3">
                                            <form action="{{ route('delete.all') }}" method="post"
                                                id="deleteAllChartForm">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-danger" type="button" id="btnDeleteAllChart">Delete</button>
                                                    <select class="default-select  form-control wide" name="deleteAllChart" id="deleteAllChart">
                                                        <option value="">Pilih Tahun</option>
                                                        @foreach ($listUpdateTahun as $list)
                                                            <option value="{{ $list->tahun }}">{{ $list->tahun }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="unlockBtn" name="unlockBtn"
                                                value="true">
                                        </div>
                                        <table id="example4" class="display table">
                                            <thead>
                                                <tr>

                                                    <th>Tahun</th>
                                                    <th>Bulan</th>
                                                    <th>Total</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $chart)
                                                    <tr id="idchart{{ $chart->id }}">
                                                        <td>{{ $chart->tahun }}</td>
                                                        <td>{{ $chart->bulan }}</td>
                                                        <td>{{ $chart->total }}</td>
                                                        <td>
                                                            @if ($iniBulan == $chart->bulan && $nowYear == $chart->tahun)
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-danger btn-icon-xxs"
                                                                    onclick="delDataChart({{ $chart->id }}, {{ $chart->tahun }})"><i
                                                                        class='bx bx-trash'></i></i></a>


                                                                <a id="btnUpdateChart" href="javascript:void(0)"
                                                                    class="btn btn-info btn-icon-xxs text-white"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalUpdateChart"
                                                                    data-idchart="{{ $chart->id }}"
                                                                    data-tahunchart="{{ $chart->tahun }}"
                                                                    data-bulanchart="{{ $chart->bulan }}"
                                                                    data-totalchart="{{ $chart->total }}"><i
                                                                        class="fas fa-pencil-alt"></i></a>
                                                            @else
                                                                <button disabled
                                                                    class="btn btn-secondary btn-icon-xxs unDel"
                                                                    onclick="delDataChart({{ $chart->id }}, {{ $chart->tahun }})"><i
                                                                        class='bx bx-trash'></i></button>


                                                                <button id="btnUpdateChart" disabled
                                                                    class="btn btn-secondary btn-icon-xxs text-white unEd"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalUpdateChart"
                                                                    data-idchart="{{ $chart->id }}"
                                                                    data-tahunchart="{{ $chart->tahun }}"
                                                                    data-bulanchart="{{ $chart->bulan }}"
                                                                    data-totalchart="{{ $chart->total }}"><i
                                                                        class="fas fa-pencil-alt"></i></button>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="totalData">Akumulasi : {{ $dataTotalUnit }} Unit</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /tab-content -->

                    </div>
                </div>
                <!-- Column ends -->

            </div>


        </div>

        <!-- Modal Cretae -->
        <div class="modal fade" id="modalCreateChart" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userTitle">New Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('chart/create') }}" class="row g-3 needs-validation" method="post">

                            @csrf
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Tahun </label>
                                <select class="form-select" id="tahun" name="tahun" required>
                                    <option value="">--Select--</option>
                                    <option value="{{ $nowYear }}">{{ $nowYear }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="bulan" class="form-label">Bulan </label>
                                <select class="form-select" id="bulan" name="bulan" required>
                                    <option value="">--Select--</option>
                                    @foreach (array_slice($month, $nowMonth) as $mon)
                                        @if ($iniBulan == $mon)
                                            <option value="{{ $mon }}">{{ $mon }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="total" class="form-label">Unit </label>
                                <input type="text" class="form-control" id="total" name="total"
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Cretae -->

        <!-- Modal Update -->
        <div class="modal fade" id="modalUpdateChart" tabindex="-1" aria-hidden="true" data-backdrop="false"
            style="z-index: 1060 !important;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <form action="{{ url('/chart/update') }}" class="row g-3 needs-validation" method="post">
                            @csrf
                            <div class="col-md-4">
                                <input type="hidden" id="idChartUpdate" name="idUpdateChart">
                                <label for="tahunUpdateChart" class="form-label">Tahun </label>
                                <select class="form-select" id="tahunUpdateChart" name="tahunUpdateChart" required>
                                    <option value="">--Select--</option>
                                    <option value="{{ $nowYear }}">{{ $nowYear }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="monthUpdateChart" class="form-label">Bulan </label>
                                <select class="form-select" id="monthUpdateChart" name="monthUpdateChart" required>
                                    <option value="">--Select--</option>
                                    @foreach (array_slice($month, $nowMonth) as $mon)
                                        <option value="{{ $mon }}">{{ $mon }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="totalUpdateChart" class="form-label">Unit </label>
                                <input type="text" class="form-control" id="totalUpdateChart" name="totalUpdateChart"
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnUpdateChart1" class="btn btn-primary" disabled>Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Update -->




        <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('') }}/assets/vendor/select2/js/select2.min.js"></script>

        <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
        <script src="{{ asset('') }}/assets/js/myNotif.js"></script>

        <script>
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#totalUpdateChart').on('keyup', function() {
                    $("#btnUpdateChart1").removeAttr("disabled");
                });
            });
        </script>
        <script type="text/javascript">
            function delDataChart(id, tahun) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/chart/delete') }}" + "/" + id + "/" + tahun,
                            type: "DELETE",
                            data: {
                                _token: $("input[name=_token]").val()
                            },
                            success: function(response) {
                                $("#idchart" + id).remove();
                                $("#totalData").html(`Akumulasi : ${response.total} Unit`)
                                // Memperbarui pesan jumlah entri pada DataTable
                                $('#example4_info').html('Showing 1 to ' +
                                    response.count + ' of ' + response.count +
                                    ' entries');
                            }
                        });
                    }
                })
            }
        </script>

        <script>
            $(document).on("click", "#btnUpdateChart", function(e) {
                e.preventDefault();
                const idChart = $(this).data('idchart');
                const tahunChart = $(this).data('tahunchart');
                const bulanChart = $(this).data('bulanchart');
                const totalChart = $(this).data('totalchart');
                $("#modal-body #idChartUpdate").val(idChart);
                $("#modal-body #tahunUpdateChart").val(tahunChart);
                $("#modal-body #monthUpdateChart").val(bulanChart);
                $("#modal-body #totalUpdateChart").val(totalChart);
            });

            $(document).ready(function() {
                $('#unlockBtn').change(function() {
                    if ($(this).prop("checked")) {
                        $('.unDel').removeAttr('disabled');
                        $('.unEd').removeAttr('disabled');
                        $('.unEd').addClass('btn-info');
                        $('.unDel').addClass('btn-danger');
                    } else {
                        $('.unDel').attr('disabled', 'disabled');
                        $('.unEd').attr('disabled', 'disabled');
                        $('.unEd').removeClass('btn-info');
                        $('.unDel').removeClass('btn-danger');
                    }
                })
            });
        </script>

        <script>
            // Menangkap event klik pada tombol "Delete All"
            document.getElementById('btnDeleteAllChart').addEventListener('click', function() {
                // Menampilkan konfirmasi sebelum menghapus data
              
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mengirimkan form saat pengguna mengkonfirmasi
                        document.getElementById('deleteAllChartForm').submit();
                    }
                })
                // if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {

                // }
            });
        </script>
    @endsection
