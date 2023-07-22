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
                                <h4 class="card-title">List Data AC</h4>
                            </div>

                            <ul class="nav nav-tabs dzm-tabs">
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ url('/ac/create') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                                        data-bs-original-title="Tambah Data" data-bs-trigger="hover"><i
                                            class='bx bx-plus-medical'></i></a>
                                </li>
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ url('/ac/export') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                                        data-bs-original-title="Export To Excel" data-bs-trigger="hover"><i
                                            class='bx bxs-spreadsheet'></i></a>
                                </li>
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ url('/chart') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                                        data-bs-original-title="Data Analytic AC" data-bs-trigger="hover"><i
                                            class='bx bxs-bar-chart-alt-2'></i></a>
                                </li>
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ url('/ac/listmainten') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
                                        data-bs-original-title="Jadwal Mainten AC" data-bs-trigger="hover"><i
                                            class='bx bx-list-ul'></i></a>
                                </li>
                                <li class="nav-item px-2 py-2" role="presentation">
                                    <a href="{{ url('ac/trash') }}" class="btn btn-outline-secondary btn-icon-xxs"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                                        data-bs-original-title="Recycle Bin" data-bs-trigger="hover"><i
                                            class='bx bx-trash'></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="row" style="margin-left:10px">
                            <div class="col-xl-3 ml-5">
                                <div class="input-group mb-2 mt-3">
                                    <button class="btn btn-primary" type="button" id="btnRangeAc">Search</button>
                                    <input type="text" class="form-control input-range-ac"
                                        placeholder="Cari data AC terbaru" name="rangeQueryAc">
                                </div>
                            </div>
                            <div class="col-xl-3">

                                <div class="input-group mb-2 mt-3">
                                    <button id="btnRangeAcBaru" class="btn btn-primary" type="button">Search</button>
                                    <input type="text" class="form-control input-range-ac-baru"
                                        placeholder="Cari data AC pemasangan Baru" name="rangeQueryAcBaru">
                                </div>

                            </div>
                        </div>

                        <!-- /tab-content -->
                        <div class="tab-content" id="myTabContent-3">

                            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                aria-labelledby="home-tab-3">
                                <div class="card-body pt-0">

                                    <div class="table-responsive">
                                        <div class="mb-3">

                                            <button type="button" class="btn btn-danger btn-icon-xxs"
                                                id="selectDeleteRecord"><i class='bx bx-trash'></i> Multiple Delete</button>
                                        </div>
                                        <table id="example4" class="display table">
                                            <div class="form-check custom-checkbox mb-3">
                                                <input type="checkbox" class="form-check-input" id="checkAllCheckbox">
                                                <label class="form-check-label" for="customCheckBox1">Select Semua
                                                    Data</label>
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>ID</th>
                                                    <th>Wing</th>
                                                    <th>Lantai</th>
                                                    <th>Lokasi</th>
                                                    <th>Merk</th>
                                                    <th>Status</th>
                                                    <th>Tgl Mainten</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $ac)
                                                    <tr id="sid{{ $ac->id }}">
                                                        <td><input type="checkbox" class="form-check-input checkBoxClass"
                                                                name="ids" value="{{ $ac->id }}"></td>
                                                        <td>{{ $ac->label }}</td>
                                                        <td>{{ $ac->wing }}</td>
                                                        <td>{{ $ac->lantai }}</td>
                                                        <td>{{ $ac->ruangan }}</td>
                                                        <td>{{ $ac->merk }}</td>

                                                        <td>
                                                            @if ($ac->status == 'Rusak')
                                                                <span
                                                                    class="badge light badge-danger">{{ $ac->status }}</span>
                                                            @else
                                                                <span
                                                                    class="badge light badge-success">{{ $ac->status }}</span>
                                                            @endif
                                                        </td>
                                                        @if ($ac->tgl_maintenance == null)
                                                            <td></td>
                                                        @else
                                                            <td>{{ Carbon::parse($ac->tgl_maintenance)->diffForHumans() }}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a href="{{ url('/ac/update/' . $ac->id) }}"
                                                                class="btn btn-primary btn-icon-xxs"><i
                                                                    class="fas fa-pencil-alt"></i></a>

                                                            <a href="javascript:void(0)" id="btnDetailAC"
                                                                class="btn btn-info btn-icon-xxs" data-bs-toggle="modal"
                                                                data-bs-target="#exampleScrollableModal"
                                                                data-id="{{ $ac->id }}"
                                                                data-labelac="{{ $ac->label }}"
                                                                data-assetsac="{{ $ac->assets }}"
                                                                data-wingac="{{ $ac->wing }}"
                                                                data-lantaiac="{{ $ac->lantai }}"
                                                                data-ruanganac="{{ $ac->ruangan }}"
                                                                data-merkac="{{ $ac->merk }}"
                                                                data-typeac="{{ $ac->type }}"
                                                                data-jenisac="{{ $ac->jenis }}"
                                                                data-kapasitasac="{{ $ac->kapasitas }}"
                                                                data-refrigerantac="{{ $ac->refrigerant }}"
                                                                data-productac="{{ $ac->product }}"
                                                                data-currentac="{{ $ac->current }}"
                                                                data-voltageac="{{ $ac->voltage }}"
                                                                data-btuac="{{ $ac->btu }}"
                                                                data-pipaac="{{ $ac->pipa }}"
                                                                data-statusac="{{ $ac->status }}"
                                                                data-seriindoorac="{{ $ac->seri_indoor }}"
                                                                data-serioutdoorac="{{ $ac->seri_outdoor }}"
                                                                data-catatanac="{{ $ac->catatan }}"
                                                                data-keteranganac="{{ $ac->keterangan }}"
                                                                data-kerusakanac="{{ $ac->kerusakan }}"
                                                                data-tglpemasanganac="{{ $ac->tgl_pemasangan }}"
                                                                data-petugasmaintac="{{ $ac->petugas_maint }}"
                                                                data-petugaspemasanganac="{{ $ac->petugas_pemasangan }}"
                                                                data-tanggalmaintenanceac="{{ Carbon::parse($ac->tgl_maintenance)->locale('id')->diffForHumans() }}"
                                                                data-updatedtimeac="{{ $ac->user_updated }}/{{ Carbon::parse($ac->user_updated_time)->diffForHumans() }}"><i
                                                                    class="fa-solid fa-eye"></i></a>

                                                            <a id="btnDeleteAc" href="{{ url('/ac/delete/' . $ac->id) }}"
                                                                class="btn btn-danger btn-icon-xxs"><i
                                                                    class="fa-solid fa-trash"></i></a>
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


        {{-- modal range data ac baru --}}
        <div class="modal fade" id="modalRangeDataAcBaru" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rangeTitleAcBaru">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <button class="btn btn-success btn-sm mb-2 btn-export-excel">Export Excel</button>
                                <thead>
                                    <tr>
                                        <th scope="col">Lantai</th>
                                        <th scope="col">Wing</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Merk</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Kapasitas</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tgl Pemasangan</th>
                                        <th scope="col">Petugas Pemasangan</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody id="rangeDataAcBaru">

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
    {{-- end modal range data ac baru --}}

    {{-- modal range data --}}
    <div class="modal fade" id="modalRangeDataAc" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rangeTitleAc">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Lantai</th>
                                    <th scope="col">Wing</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Diperbarui pada</th>
                                    <th scope="col">By_user</th>
                                </tr>
                            </thead>
                            <tbody id="rangeDataAc">

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
    {{-- end modal range data --}}


    {{-- Modal Detail --}}

    <div class="col">
        <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            {{-- <div class="card-body"> --}}
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Di ubah <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailUpdatedAC"></strong>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal
                                    Pemasangan <i class='bx bx-right-arrow-alt'></i> <strong
                                        id="detailTanggaPemasanganAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Petugas
                                    Pemasangan <i class='bx bx-right-arrow-alt'></i> <strong
                                        id="detailPetugasPemasanganAC" class="text-capitalize"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal
                                    Maintenance <i class='bx bx-right-arrow-alt'></i> <strong
                                        id="detailTglMaintenanceAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Petugas
                                    Maintenance <i class='bx bx-right-arrow-alt'></i> <strong
                                        id="detailPetugasMaintAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Label <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailLabelAC"
                                        class="text-capitalize"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Assets <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailAssetsAC"
                                        class="text-capitalize"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Wing <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailWingAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Lantai <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailLantaiAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Ruangan <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailRuanganAC"
                                        class="text-capitalize"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Merk <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailMerkAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Type <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailTypeAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Jenis <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailJenisAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Kapasitas <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailKapasitasAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Refrigerant
                                    <i class='bx bx-right-arrow-alt'></i> <strong id="detailRefrigerantAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Product <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailProductAC"
                                        class="text-capitalize"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Amper <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailAmperAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Voltage <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailVoltageAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Btu <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailBtuAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">No Seri
                                    Indoor <i class='bx bx-right-arrow-alt'></i> <strong id="detailSeriIndoorAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">No Seri
                                    Outdoor <i class='bx bx-right-arrow-alt'></i> <strong
                                        id="detailSeriOutdoorAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Pipa Liquid +
                                    Gas <i class='bx bx-right-arrow-alt'></i> <strong id="detailPipaAC"></strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Status <i
                                        class='bx bx-right-arrow-alt'></i> <strong id="detailStatusAC"></strong>
                                </li>

                                <div class="accordion accordion-no-gutter accordion-bordered">
                                    <div class="accordion-item">
                                        <div class="accordion-header rounded-lg collapsed" id="accord-4One"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4One"
                                            aria-controls="collapse4One" aria-expanded="false" role="button">
                                            <span class="accordion-header-text">Kerusakan</span>
                                            <span class="accordion-header-indicator"></span>
                                        </div>
                                        <div id="collapse4One" class="accordion__body collapse"
                                            aria-labelledby="accord-4One" data-bs-parent="#accordion-four"
                                            style="">
                                            <div class="accordion-body-text" id="detailKerusakanAC">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <div class="accordion-header collapsed rounded-lg" id="accord-4Two"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4Two"
                                            aria-controls="collapse4Two" aria-expanded="false" role="button">
                                            <span class="accordion-header-text">Keterangan</span>
                                            <span class="accordion-header-indicator"></span>
                                        </div>
                                        <div id="collapse4Two" class="collapse accordion__body"
                                            aria-labelledby="accord-4Two" data-bs-parent="#accordion-four">
                                            <div class="accordion-body-text" id="detailKeteranganAC">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <div class="accordion-header collapsed rounded-lg" id="accord-4Three"
                                            data-bs-toggle="collapse" data-bs-target="#collapse4Three"
                                            aria-controls="collapse4Three" aria-expanded="false" role="button">
                                            <span class="accordion-header-text">Catatan</span>
                                            <span class="accordion-header-indicator"></span>
                                        </div>
                                        <div id="collapse4Three" class="collapse accordion__body"
                                            aria-labelledby="accord-4Three" data-bs-parent="#accordion-four">
                                            <div class="accordion-body-text" id="detailCatatanAC">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </ul>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end modal detail --}}



    <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}/assets/js/excel/xlsx.full.min.js"></script>
    <script src="{{ asset('') }}/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="{{ asset('') }}/assets/js/myNotif.js"></script>





    {{-- CARI DATA AC BARU --}}
    <script type="text/javascript">
        $(function() {

            $('input[name="rangeQueryAcBaru"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="rangeQueryAcBaru"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="rangeQueryAcBaru"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>
    {{-- END CARI DATA AC BARU --}}


    {{-- SCRIPT AJAX DAN IMPORT EXCEL CARI DATA AC BARU --}}

    <script>
        $(document).on('click', '#btnRangeAcBaru', function() {
            const data = $('.input-range-ac-baru').val();
            const start = data.slice(0, 11).split('-').join('/');
            const end = data.slice(13, 23).split('-').join('/');

            $.ajax({
                url: "{{ url('/ac/dataacbaru') }}" + "/" + data,
                type: "GET",
                success: result => {

                    let card = '';
                    const count = result.count;
                    const data = result.data;
                    data.forEach(e => {
                        $('#modalRangeDataAcBaru').modal('show');
                        $("#rangeTitleAcBaru").text(
                            `${start} - ${end} | Total : ${count} Unit`);
                        card += updateCardAcBaru(e);
                    });
                    $("#rangeDataAcBaru").html(card);

                    // Tambahkan event listener untuk tombol "Export Excel"
                    $('.btn-export-excel').click(function() {
                        exportToExcel(data);
                    });

                },
                error: (xhr, textStatus, errorThrown) => {
                    if (xhr.status === 404) {
                        // Data tidak ditemukan, tampilkan alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Data tanggal ${start} - ${end} tidak ditemukan!`
                        })
                    }
                }
            });
        });


        function updateCardAcBaru(e) {
            const dataID = e.id;
            return `<tr>
                        <td>${e.lantai}</td>
                        <td>${e.wing}</td>
                        <td>${e.ruangan}</td>
                        <td>${e.merk}</td>
                        <td>${e.type}</td>
                        <td>${e.kapasitas}</td>
                        ${e.status == "Rusak" ? `<td style="background:#E72E2E;color:white">${e.status}</td>` : `<td style="background:#2FB5F2;color:white">${e.status}</td>`}
                        <td>${e.tgl_pemasangan}</td>
                        <td>${e.petugas_pemasangan == null ? '' : e.petugas_pemasangan}</td>
                        <td><a href="{{ url('/ac/datadetailacbaru/') }}/${e.id}"><i class='fa-solid fa-eye'></i></a></td>
                    </tr>`;

        }


        function exportToExcel(data) {
            // Mengambil hanya field yang diinginkan
            var exportedData = data.map(item => ({
                ID: item.label,
                Merk: item.merk,
                Type: item.type,
                Jenis: item.jenis,
                Kapasitas: item.kapasitas,
                Refigerant: item.refrigerant,
                Amper: item.current,
                Buatan: item.product,
                Tegangan_Kerja: item.voltage,
                Btu: item.btu,
                Ukuran_Pipa: item.pipa,
                No_Seri_Indoor: item.seri_indoor,
                No_Seri_Outdoor: item.seri_outdoor,
                Asset: item.assets,
                Lokasi: item.wing,
                Lantai: item.lantai,
                Ruangan: item.ruangan,
                Status_AC: item.status,
                Kerusakan_AC: item.kerusakan,
                Keterangan: item.keterangan,
                Tanggal_Pemasangan: item.tgl_pemasangan,
                Petugas_Pemasangan: item.petugas_pemasangan
                // Tambahkan field lain yang ingin diexport
            }));

            // Buat workbook baru
            var wb = XLSX.utils.book_new();

            // Buat worksheet baru dari data yang telah di-filter
            var ws = XLSX.utils.json_to_sheet(exportedData);

            // Tambahkan worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, "Data AC Baru");

            // Simpan file Excel
            var filename = "data_ac_baru.xlsx";
            XLSX.writeFile(wb, filename);
        }
    </script>
    {{-- END SCRIPT AJAX DAN IMPORT EXCEL CARI DATA AC BARU --}}

    {{-- CARI DATA AC UPDATE TERBARU --}}
    <script type="text/javascript">
        $(function() {

            $('input[name="rangeQueryAc"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="rangeQueryAc"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('input[name="rangeQueryAc"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>
    {{-- END CARI DATA AC UPDATE TERBARU --}}

    {{-- SCRIPT AJAX CARI DATA UPDATE AC --}}
    <script>
        $(document).on('click', '#btnRangeAc', function() {
            const nilai = $('.input-range-ac').val();
            const start = nilai.slice(0, 11).split('-').join('/');
            const end = nilai.slice(13, 23).split('-').join('/');

            $.ajax({
                url: "{{ url('/ac/range') }}" + "/" + nilai,
                type: "GET",
                success: result => {
                    let card = '';
                    const count = result.count;
                    const data = result.data;
                    data.forEach(e => {
                        $('#modalRangeDataAc').modal('show');
                        $("#rangeTitleAc").text(
                            `Data : ${start} - ${end} | Total : ${count} Data yang telah diupdate!`
                        );
                        card += updateCardAc(e);
                    });
                    $("#rangeDataAc").html(card);
                },
                error: (xhr, textStatus, errorThrown) => {
                    if (xhr.status === 404) {
                        // Data tidak ditemukan, tampilkan alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `Data tanggal ${start} - ${end} tidak ditemukan!`
                        })
                    }
                }
            });
        });


        function updateCardAc(e) {

            let date = Date.parse(e.updated_at);
            // let newD = date.setFullYear(e.created_at);
            let newD = new Date(date);
            let year = newD.getFullYear();
            let month = newD.getMonth() + 1;
            let day = newD.getUTCDate();

            return `<tr>
                  <td>${e.label == null ? '' : e.label}</td>
                  <td>${e.lantai}</td>
                  <td>${e.wing}</td>
                  <td>${e.ruangan}</td>
                  <td>${e.merk}</td>
                  <td>${e.type}</td>
                  ${e.status == "Rusak" ? `<td style="background:#E72E2E;color:white">${e.status}</td>` : `<td style="background:#2FB5F2;color:white">${e.status}</td>`}
                  <td>${year}-${month}-${day}</td>
                  <td>${e.user_updated}</td>
                  </tr>`;
        }
    </script>
    {{-- END SCRIPT AJAX CARI DATA UPDATE AC --}}


    {{-- SCRIPT DETAIL DATA AC --}}
    <script>
        $(document).on('click', '#btnDetailAC', function() {

            const label = $(this).data('labelac');
            const assets = $(this).data('assetsac');
            const wingac = $(this).data('wingac');
            const lantaiac = $(this).data('lantaiac');
            const ruanganac = $(this).data('ruanganac');
            const merkac = $(this).data('merkac');
            const typeac = $(this).data('typeac');
            const jenisac = $(this).data('jenisac');
            const kapasitasac = $(this).data('kapasitasac');
            const refrigerantac = $(this).data('refrigerantac');
            const productac = $(this).data('productac');
            const currentac = $(this).data('currentac');
            const voltageac = $(this).data('voltageac');
            const btuac = $(this).data('btuac');
            const pipaac = $(this).data('pipaac');
            const statusac = $(this).data('statusac');
            const seriIndoor = $(this).data('seriindoorac');
            const seriOutdoor = $(this).data('serioutdoorac');
            const catatanac = $(this).data('catatanac');
            const kerusakanac = $(this).data('kerusakanac');
            const keteranganac = $(this).data('keteranganac');
            const tanggalpemasanganac = $(this).data('tglpemasanganac');
            const petugaspemsanganac = $(this).data('petugaspemasanganac');
            const tanggalmaint = $(this).data('tanggalmaintenanceac');
            const petugasmaintac = $(this).data('petugasmaintac');
            const updatedtimeac = $(this).data('updatedtimeac');

            if (updatedtimeac == '/1 detik yang lalu') {

                $('#detailUpdatedAC').html('');


            } else {

                $('#detailUpdatedAC').html(updatedtimeac);


            }

            if (tanggalmaint == '1 detik yang lalu') {

                $('#detailTglMaintenanceAC').html('');

            } else {


                $('#detailTglMaintenanceAC').html(tanggalmaint);

            }


            $('#detailTanggaPemasanganAC').html(tanggalpemasanganac);
            $('#detailPetugasMaintAC').html(petugasmaintac);
            $('#detailPetugasPemasanganAC').html(petugaspemsanganac);
            $('#detailLabelAC').html(label);
            $('#detailAssetsAC').html(assets);
            $('#detailWingAC').html(wingac);
            $('#detailLantaiAC').html(lantaiac);
            $('#detailRuanganAC').html(ruanganac);
            $('#detailMerkAC').html(merkac);
            $('#detailTypeAC').html(typeac);
            $('#detailJenisAC').html(jenisac);
            $('#detailKapasitasAC').html(kapasitasac);
            $('#detailRefrigerantAC').html(refrigerantac);
            $('#detailProductAC').html(productac);
            $('#detailAmperAC').html(currentac);
            $('#detailVoltageAC').html(voltageac);
            $('#detailBtuAC').html(btuac);
            $('#detailSeriIndoorAC').html(seriIndoor);
            $('#detailSeriOutdoorAC').html(seriOutdoor);
            $('#detailPipaAC').html(pipaac);
            $('#detailStatusAC').html(statusac);
            $('#detailCatatanAC').html(catatanac);
            $('#detailKerusakanAC').html(kerusakanac);
            $('#detailKeteranganAC').html(keteranganac);
        });
    </script>
    {{-- END SCRIPT DETAIL DATA AC --}}

    {{-- SCRIPT DELETE DATA AC --}}
    <script>
        $(document).on('click', '#btnDeleteAc', function(e) {
            const href = $(this).attr('href');
            e.preventDefault();
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
                    window.location.href = href;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    </script>
    {{-- END SCRIPT DELETE DATA AC --}}


    {{-- SCRIPT MULTIPLE DELETE --}}
    <script>
        $(function(e) {
            $("#checkAllCheckbox").click(function() {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });

            $("#selectDeleteRecord").click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function() {
                    all_ids.push($(this).val());
                });

                // Menghitung jumlah data yang dicentang
                var selectedCount = all_ids.length;

                var table = $('#example4').DataTable();

                // Kondisi ketika tidak ada data yang dipilih
                if (selectedCount > 0) {
                    // Menampilkan konfirmasi SweetAlert
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Anda yakin ingin menghapus ' + selectedCount + ' data terpilih?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika dikonfirmasi, lakukan penghapusan dengan AJAX
                            $.ajax({
                                url: "{{ route('ac.deleteSelected') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: $("input[name=_token]").val()
                                },
                                success: function(responses) {
                                   
                                    $.each(all_ids, function(key, val) {
                                        $("#sid" + val).remove();
                                    });

                                    // Memperbarui pesan jumlah entri pada DataTable
                                    $('#example4_info').html('Showing 1 to ' +
                                        responses + ' of ' + responses +
                                        ' entries');

                                    // Menampilkan pesan sukses
                                    // Swal.fire({
                                    //     title: 'Sukses',
                                    //     text: 'Data telah dihapus',
                                    //     icon: 'success'
                                    // });
                                },
                                error: function(xhr, status, error) {
                                    // Menampilkan pesan error, ketika gagal menghapus data 
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat menghapus data',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih setidaknya 1 data!'
                    })
                }
            });
        });
    </script>
    {{-- END SCRIPT MULTIPLE DELETE --}}
@endsection
