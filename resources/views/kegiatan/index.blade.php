@extends('layouts.main')
@section('content')
    @php
        use Illuminate\Support\Carbon;
    @endphp
    <link rel="stylesheet" href="{{ asset('') }}/assets/vendor/toastr/css/toastr.min.css">
    <div class="flash-error" data-error="{{ session('error') }}"></div>
    <div class="flash-success" data-success="{{ session('success') }}"></div>

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Database Kegiatan</a></li>
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
                                <h4 class="card-title">List Data Kegiatan</h4>
                            </div>

                            <ul class="nav nav-tabs dzm-tabs">
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <button type="button" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-toggle="modal" data-bs-target="#modalAddKegiatan"><i
                                            class='bx bx-plus-medical'></i></button>
                                </li>
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ route('kegiatan.export') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                                        data-bs-original-title="Export To Excel" data-bs-trigger="hover"><i
                                            class='bx bxs-spreadsheet'></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="row" style="margin-left:10px">
                            <div class="col-xl-3 ml-5">
                                <div class="input-group mb-2 mt-3">
                                    <button class="btn btn-primary" type="button" id="btnRangeKegiatan">Search</button>
                                    <input type="text" class="form-control input-range-kegiatan"
                                        placeholder="Cari data kegiatan" name="rangeQueryKegiatan">
                                </div>
                            </div>
                        </div>
                        <!-- /tab-content -->
                        <div class="tab-content" id="myTabContent-3">
                            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                aria-labelledby="home-tab-3">
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table id="example4" class="display table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Penyelanggara</th>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Lokasi</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Selesai</th>
                                                    <th>Durasi</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kegiatan as $keg)
                                                    @php
                                                        $mulai = Carbon::parse($keg->tanggal_mulai);
                                                        $selesai = Carbon::parse($keg->tanggal_selesai);
                                                        $selisih = $mulai->diff($selesai);
                                                        $durasi = $selisih->format('%d Hari %H jam');
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $keg->penyelenggara }}</td>
                                                        <td>{{ $keg->nama_kegiatan }}</td>
                                                        <td>{{ $keg->lokasi }}</td>
                                                        <td>{{ date('Y-m-d H:i', strtotime($keg->tanggal_mulai)) }}</td>
                                                        <td>{{ date('Y-m-d H:i', strtotime($keg->tanggal_selesai)) }}</td>
                                                        <td>{{ $durasi }}
                                                        </td>

                                                        <td>
                                                            <div class="d-flex">

                                                                <button id="btnEditKeg" type="button"
                                                                    class="btn btn-primary btn-icon-xxs"
                                                                    data-url="{{ url('kegiatan/{kegiatan}') }}"
                                                                    data-id="{{ $keg->id }}"
                                                                    data-penyelenggara="{{ $keg->penyelenggara }}"
                                                                    data-namakegiatan="{{ $keg->nama_kegiatan }}"
                                                                    data-lokasi="{{ $keg->lokasi }}"
                                                                    data-tglmulai="{{ $keg->tanggal_mulai }}"
                                                                    data-tglselesai="{{ $keg->tanggal_selesai }}"
                                                                    data-keterangan="{{ $keg->keterangan }}"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEditKegiatan"
                                                                    style="margin-right:10px"><i
                                                                        class="fas fa-pencil-alt"></i></button>

                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-info btn-icon-xxs"
                                                                    data-bs-container="body" data-bs-toggle="popover"
                                                                    data-bs-placement="top"
                                                                    data-bs-original-title="{{ $keg->keterangan }}"
                                                                    data-bs-trigger="hover" style="margin-right:10px"><i
                                                                        class="fa-solid fa-eye"></i></a>


                                                                <form action="{{ url('kegiatan/' . $keg->id) }}"
                                                                    method="POST" id="formDeleteKeg">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" id="btnDeleteKeg"
                                                                        class="btn btn-danger btn-icon-xxs"><i
                                                                            class="fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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

        {{-- MODAL MODAL ADD KEGIATAN --}}
        <div class="modal fade" id="modalAddKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userEditModalTitle">Form Add</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row g-3 needs-validation" action="{{ url('kegiatan') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                    name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror"
                                    name="penyelenggara" value="{{ old('penyelenggara') }}">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Lokasi <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" value="{{ old('lokasi') }}">
                                @error('lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    name="tanggal_mulai" id="date-format4">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="text" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                    name="tanggal_selesai" id="date-format5">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid
                                @enderror"
                                    name="keterangan" rows="4" cols="4" value="{{ old('keterangan') }}"
                                    placeholder="Masukan keterangan jika ada!"></textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>


                </div>
            </div>
        </div>
        {{-- END MODAL ADD KEGIATAN --}}

        {{-- MODAL MODAL EDIT KEGIATAN --}}
        <div class="modal fade" id="modalEditKegiatan" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userEditModalTitle">Form Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row g-3 needs-validation" id="formEditKeg" method="post">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <input type="hidden" id="editID" name="edit_id">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                    name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" id="editKegiatan">
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror"
                                    name="penyelenggara" value="{{ old('penyelenggara') }}" id="editPenyelenggara">
                                @error('penyelenggara')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Lokasi <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" value="{{ old('lokasi') }}" id="editLokasi">
                                @error('lokasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="edit-mulai form-control @error('tanggal_mulai') is-invalid @enderror"
                                    name="tanggal_mulai" id="date-format7">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="text"
                                    class="edit-selesai form-control @error('tanggal_selesai') is-invalid @enderror"
                                    name="tanggal_selesai" id="date-format8">
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid
                                @enderror"
                                    name="keterangan" rows="4" cols="4" value="{{ old('keterangan') }}"
                                    placeholder="Masukan keterangan jika ada!" id="editKeterangan"></textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END MODAL EDIT KEGIATAN --}}

        {{-- modal range kegiatan --}}
        <div class="modal fade" id="modalRangeDataKeg" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rangeTitleKeg">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Kegiatan</th>
                                        <th scope="col">Penyelenggara</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Tanggal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Durasi</th>
                                    </tr>
                                </thead>
                                <tbody id="rangeDataKeg">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal range kegiatan --}}



    <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}/assets/js/excel/xlsx.full.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="{{ asset('') }}/assets/js/myNotif.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on("click", "#btnEditKeg", function() {
                $id = $(this).data('id');
                var url = "{{ url('kegiatan/{kegiatan}') }}";
                var actionUrl = url.replace('{kegiatan}', $id);
                $("#formEditKeg").attr('action', actionUrl);

                $penyelenggara = $(this).data('penyelenggara');
                $namakegiatan = $(this).data('namakegiatan');
                $lokasi = $(this).data('lokasi');
                $tglmulai = $(this).data('tglmulai');
                $tglselesai = $(this).data('tglselesai');
                $keterangan = $(this).data('keterangan');


                $(".modal-body #editID").val($id);
                $(".modal-body #editKegiatan").val($namakegiatan);
                $(".modal-body #editPenyelenggara").val($penyelenggara);
                $(".modal-body #editLokasi").val($lokasi);
                $(".modal-body .edit-mulai").val($tglmulai);
                $(".modal-body .edit-selesai").val($tglselesai);
                $(".modal-body #editKeterangan").val($keterangan);

            });
        });
    </script>

    {{-- SCRIPT DELETE DATA KEGIATAN --}}
    <script>
        $(document).on('click', '#btnDeleteKeg', function(e) {
            e.preventDefault();
            const form = $(this).closest('form'); // Ambil form terdekat
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
                    form.submit(); // Submit form saat tombol "Yes, delete it!" diklik
                }
            })
        });
    </script>
    {{-- END SCRIPT DELETE DATA KEGIATAN --}}

    {{-- CARI DATA KEGIATAN --}}
    <script type="text/javascript">
        $(function() {

            $('input[name="rangeQueryKegiatan"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="rangeQueryKegiatan"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="rangeQueryKegiatan"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>

    <script>
        $(document).on('click', '#btnRangeKegiatan', function() {
            const nilai = $('.input-range-kegiatan').val();
            const start = nilai.slice(0, 11).split('-').join('/');
            const end = nilai.slice(13, 23).split('-').join('/');

            $.ajax({
                url: "{{ url('/kegiatan/range-kegiatan') }}" + "/" + nilai,
                type: "GET",
                success: result => {
                    let card = '';
                    const count = result.count;
                    const data = result.data;
                    data.forEach(e => {
                        $('#modalRangeDataKeg').modal('show');
                        $("#rangeTitleKeg").text(
                            `Data : ${start} - ${end} | Terdapat : ${count} kegiatan`
                        );
                        card += updateCardKeg(e);
                    });
                    $("#rangeDataKeg").html(card);
                },
                error: (xhr, textStatus, errorThrown) => {
                    if (xhr.status === 404) {
                        // Data tidak ditemukan, tampilkan alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Kegiatan tanggal ${start} - ${end} tidak ditemukan!`
                        })
                    }
                }
            });
        });


        function updateCardKeg(e) {

            const dataID = e.id;
            const start = new Date(e.tanggal_mulai);
            const end = new Date(e.tanggal_selesai);

            // Menghitung selisih waktu dalam milidetik
            const timeDiff = end - start;

            // Menghitung selisih hari
            const dayDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

            // Mengonversi selisih waktu ke dalam format yang diinginkan
            const hoursDiff = Math.floor(timeDiff / (1000 * 60 * 60) % 24);
            const minutesDiff = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

            return `<tr>
                        <td>${e.nama_kegiatan}</td>
                        <td>${e.penyelenggara}</td>
                        <td>${e.lokasi}</td>
                        <td>${e.tanggal_mulai}</td>
                        <td>${e.tanggal_selesai}</td>
                        <td>${dayDiff} hari ${hoursDiff} jam ${minutesDiff} menit</td>
                    </tr>`;
        }
    </script>
    {{-- END CARI DATA KEGIATAN --}}
@endsection
