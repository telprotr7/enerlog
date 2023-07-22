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
                                <h4 class="card-title">List Jadwal Mainten AC</h4>
                            </div>
                        </div>
                        <!-- /tab-content -->
                        <div class="tab-content" id="myTabContent-3">
                            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                                aria-labelledby="home-tab-3">
                                <div class="card-body pt-0">
                                    <div class="mb-3">

                                        <a href="{{ url('/ac') }}" class="btn btn-success btn-icon-xxs"><i
                                                class='bx bx-arrow-back'></i> BACK</a>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="example4" class="display table">
                                            <thead>
                                                <tr>
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
                                                    <tr>
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
                                                            
                                                            <a id="btnDetailAC" href="javascript:void(0)"
                                                                class="btn btn-primary btn-icon-xxs" data-bs-toggle="modal"
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
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Di ubah <i class='bx bx-right-arrow-alt' ></i> <strong id="detailUpdatedAC"></strong>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal
                                        Pemasangan <i class='bx bx-right-arrow-alt' ></i> <strong
                                            id="detailTanggaPemasanganAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Petugas
                                        Pemasangan <i class='bx bx-right-arrow-alt' ></i> <strong id="detailPetugasPemasanganAC"
                                            class="text-capitalize"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal
                                        Maintenance <i class='bx bx-right-arrow-alt' ></i> <strong
                                            id="detailTglMaintenanceAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Petugas
                                        Maintenance <i class='bx bx-right-arrow-alt' ></i> <strong
                                            id="detailPetugasMaintAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Label <i class='bx bx-right-arrow-alt' ></i> <strong id="detailLabelAC"
                                            class="text-capitalize"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Assets <i class='bx bx-right-arrow-alt' ></i> <strong id="detailAssetsAC"
                                            class="text-capitalize"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Wing <i class='bx bx-right-arrow-alt' ></i> <strong id="detailWingAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Lantai <i class='bx bx-right-arrow-alt' ></i> <strong id="detailLantaiAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Ruangan
                                        <i class='bx bx-right-arrow-alt' ></i> <strong id="detailRuanganAC"
                                            class="text-capitalize"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Merk <i class='bx bx-right-arrow-alt' ></i> <strong id="detailMerkAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Type <i class='bx bx-right-arrow-alt' ></i> <strong id="detailTypeAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Jenis <i class='bx bx-right-arrow-alt' ></i> <strong id="detailJenisAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Kapasitas
                                        <i class='bx bx-right-arrow-alt' ></i> <strong id="detailKapasitasAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Refrigerant <i class='bx bx-right-arrow-alt' ></i> <strong
                                            id="detailRefrigerantAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Product
                                        <i class='bx bx-right-arrow-alt' ></i> <strong id="detailProductAC"
                                            class="text-capitalize"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Amper <i class='bx bx-right-arrow-alt' ></i> <strong id="detailAmperAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Voltage
                                        <i class='bx bx-right-arrow-alt' ></i> <strong id="detailVoltageAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Btu <i class='bx bx-right-arrow-alt' ></i> <strong id="detailBtuAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">No Seri
                                        Indoor <i class='bx bx-right-arrow-alt' ></i> <strong id="detailSeriIndoorAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">No Seri
                                        Outdoor <i class='bx bx-right-arrow-alt' ></i> <strong
                                            id="detailSeriOutdoorAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Pipa
                                        Liquid + Gas <i class='bx bx-right-arrow-alt' ></i> <strong id="detailPipaAC"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Status <i class='bx bx-right-arrow-alt' ></i> <strong id="detailStatusAC"></strong>
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

        <script>
            // FUNGSI DETAIL       
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

            // END FUNGSI DETAIL
        </script>
    @endsection
