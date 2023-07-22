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
                                <h4 class="card-title">Recycle Bin</h4>
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

                                        <a id="btnDelPermanent" href="{{ url('/ac/trash/deleteAll') }}" class="btn btn-danger btn-icon-xxs"><i
                                                class='bx bx-trash'></i> DELETE ALL</a>

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
                                                @foreach ($softData as $ac)
                                                    <tr id="idone{{ $ac->id }}">
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
                                                            <a href="javascript:void(0)" class="btn btn-warning btn-icon-xxs" onclick="delFunc({{ $ac->id }})"><i
                                                                    class='bx bxs-download'></i></a>

                                                            <a href="javascript:void(0)" id="btnDetailTrash" class="btn btn-primary btn-icon-xxs" data-bs-toggle="modal" data-bs-target="#modalDetailTrash"
                                                            data-idtrash="{{ $ac->id }}"
                                                            data-labelactrash="{{ $ac->label }}"
                                                            data-assetsactrash="{{ $ac->assets }}"
                                                            data-wingactrash="{{ $ac->wing }}"
                                                            data-lantaiactrash="{{ $ac->lantai }}"
                                                            data-ruanganactrash="{{ $ac->ruangan }}"
                                                            data-merkactrash="{{ $ac->merk }}"
                                                            data-typeactrash="{{ $ac->type }}"
                                                            data-jenisactrash="{{ $ac->jenis }}"
                                                            data-kapasitasactrash="{{ $ac->kapasitas }}" data-refrigerantactrash="{{ $ac->refrigerant }}" data-productactrash="{{ $ac->product }}"
                                                            data-currentactrash="{{ $ac->current }}"
                                                            data-voltageactrash="{{ $ac->voltage }}"
                                                            data-btuactrash="{{ $ac->btu }}"
                                                            data-statusactrash="{{ $ac->status }}"
                                                            data-catatanactrash="{{ $ac->catatan }}" data-tglpemasanganactrash="{{ $ac->tgl_pemasangan }}" data-petugaspemasanganactrash="{{ $ac->petugas_pemasangan }}"
                                                            data-tanggalmaintenanceactrash="{{ Carbon::parse($ac->tgl_maintenance)->locale('id')->diffForHumans() }}" data-updatedtimeactrash="{{ $ac->is_delete }}/{{ Carbon::parse($ac->updated_at)->locale('id')->diffForHumans() }}"><i
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
            <div class="modal fade" id="modalDetailTrash" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="card">
                      {{-- <div class="card-body"> --}}
                        <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">Di hapus <span>:</span> <span id="detailUpdatedACTrash"></span>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Pemasangan <span>:</span> <span id="detailTanggaPemasanganACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Petugas Pemasangan <span>:</span> <span id="detailPetugasPemasanganACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Tanggal Maintenance <span>:</span> <span id="detailTglMaintenanceACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Label <span>:</span> <span id="detailLabelACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Assets <span>:</span> <span id="detailAssetsACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Wing <span>:</span> <span id="detailWingACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Lantai <span>:</span> <span id="detailLantaiACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Ruangan <span>:</span> <span id="detailRuanganACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Merk <span>:</span> <span id="detailMerkACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Type <span>:</span> <span id="detailTypeACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Jenis <span>:</span> <span id="detailJenisACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Kapasitas <span>:</span> <span id="detailKapasitasACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Refrigerant <span>:</span> <span id="detailRefrigerantACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Product <span>:</span> <span id="detailProductACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Amper <span>:</span> <span id="detailAmperACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Voltage <span>:</span> <span id="detailVoltageACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Btu <span>:</span> <span id="detailBtuACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">Status <span>:</span> <span id="detailStatusACTrash"></span>
                          </li>
                          <li class="list-group-item d-flex justify-content-center align-items-center text-center" id="detailCatatanACTrash"></span>
                          </li>
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

        // FUNGSI RESTORE
        function delFunc(id)
          {
              $.ajax({
                url:"{{ url('/ac/trash') }}" + "/" + id,
                type: "DELETE",
                data:{
                  _token : $("input[name=_token]").val()
                },
                success : function(response){
                  $("#idone"+id).remove();
                }
              });
          }
        // END FUNGSI RESTORE

        // FUNGSI DETAIL       
        $(document).on('click', '#btnDetailTrash', function() {
              const labeltrash = $(this).data('labelactrash');
              const assetstrash = $(this).data('assetsactrash');
              const wingactrash = $(this).data('wingactrash');
              const lantaiactrash = $(this).data('lantaiactrash');
              const ruanganactrash = $(this).data('ruanganactrash');
              const merkactrash = $(this).data('merkactrash');
              const typeactrash = $(this).data('typeactrash');
              const jenisactrash = $(this).data('jenisactrash');
              const kapasitasactrash = $(this).data('kapasitasactrash');
              const refrigerantactrash = $(this).data('refrigerantactrash');
              const productactrash = $(this).data('productactrash');
              const currentactrash = $(this).data('currentactrash');
              const voltageactrash = $(this).data('voltageactrash');
              const btuactrash = $(this).data('btuactrash');
              const statusactrash = $(this).data('statusactrash');
              const catatanactrash = $(this).data('catatanactrash');
              const tanggalpemasanganactrash = $(this).data('tglpemasanganactrash');
              const petugaspemsanganactrash = $(this).data('petugaspemasanganactrash');
              const tanggalmainttrash = $(this).data('tanggalmaintenanceactrash');
              const updatedtimeactrash = $(this).data('updatedtimeactrash');

              if(updatedtimeactrash == '1 detik yang lalu'){

                $('#detailUpdatedACTrash').html('');

              }else{

                $('#detailUpdatedACTrash').html(updatedtimeactrash);

              }

              $('#detailTanggaPemasanganACTrash').html(tanggalpemasanganactrash);
              $('#detailPetugasPemasanganACTrash').html(petugaspemsanganactrash);
              $('#detailTglMaintenanceACTrash').html(tanggalmainttrash);
              $('#detailLabelACTrash').html(labeltrash);
              $('#detailAssetsACTrash').html(assetstrash);
              $('#detailWingACTrash').html(wingactrash);
              $('#detailLantaiACTrash').html(lantaiactrash);
              $('#detailRuanganACTrash').html(ruanganactrash);
              $('#detailMerkACTrash').html(merkactrash);
              $('#detailTypeACTrash').html(typeactrash);
              $('#detailJenisACTrash').html(jenisactrash);
              $('#detailKapasitasACTrash').html(kapasitasactrash);
              $('#detailRefrigerantACTrash').html(refrigerantactrash);
              $('#detailProductACTrash').html(productactrash);
              $('#detailAmperACTrash').html(currentactrash);
              $('#detailVoltageACTrash').html(voltageactrash);
              $('#detailBtuACTrash').html(btuactrash);
              $('#detailStatusACTrash').html(statusactrash);
              $('#detailCatatanACTrash').html(catatanactrash);
          });
           // END FUNGSI DETAIL

        // FUNGSI DELETE ALL

        $(document).on('click', '#btnDelPermanent', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

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

        // END FUNGSI DELETE ALL
    </script>


   


@endsection
