@extends('layouts.main')



@section('content')
@php
    use Illuminate\Support\Carbon;
@endphp

    <style>
        .apexcharts-legend-series,
        .apexcharts-zoom-icon.apexcharts-selected,
        .apexcharts-pan-icon,
        .apexcharts-reset-icon,
        .apexcharts-menu-item.exportSVG,
        .apexcharts-menu-item.exportCSV {
            display: none !important;
        }

        .apexcharts-tooltip {
            text-align: center;
        }

        .apexcharts-tooltip .apexcharts-tooltip-series-group {
            transform: translateX(-15%);
            color: #0D99FF;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-titles">

        <ol class="breadcrumb">
            <li>
                <h5 class="bc-title">Dashboard</h5>
            </li>

        </ol>
        <a class="text-primary fs-13" data-bs-toggle="offcanvas" href="#offcanvasExample1" role="button"
            aria-controls="offcanvasExample1">+ Add Task</a>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12 wid-100">
                <div class="row">
                    <div class="col-xl-3  col-lg-6 col-sm-6">
						<div class="widget-stat card bg-primary">
							<div class="card-body  p-4">
								<div class="media">
									<span class="me-3">
										<i class="las la-table"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">Total AC</p>
										<h3 class="text-white">{{ $countData }}</h3>
										
                                        @if ($totalDataPemasanganACBulanIni != 0)
                                            
										<small>{{$totalDataPemasanganACBulanIni}} pemasangan AC bulan {{Carbon::now()->format('F-Y')}}</small>
                                        @endif
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-3  col-lg-6 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="las la-cog"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">total Ac rusak</p>
										<h3 class="text-white">{{$countAcRusak}}</h3>
										<div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: {{$persentaseACRusak}}%"></div>
                                        </div>
										<small>Kenaikan {{$persentaseACRusak }}% dalam {{$jumlahHariBulanLalu}} Hari</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-3  col-lg-6 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="las la-calendar"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">jadwal mainten ac</p>
										<h3 class="text-white">{{$jadwalCuci}}</h3>
										<div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white" style="width: {{$persentaseMaintenAC}}%;"></div>
                                        </div>
										<small>Kenaikan {{$persentaseMaintenAC }}% dalam {{$jumlahHariBulanLalu}} Hari</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-3  col-lg-6 col-sm-6">
						<div class="widget-stat card bg-danger ">
							<div class="card-body p-4">
								<div class="media">
									<span class="me-3">
										<i class="las la-tools"></i>
									</span>
									<div class="media-body text-white">
										<p class="mb-1">total maintenance ac</p>
										<h3 class="text-white">{{$kal}}</h3>
										
										<small>Dalam {{$kalTahun}} tahun</small>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card overflow-hidden">
                            <div class="card-header border-0 pb-0 flex-wrap">
                                <h4 class="heading mb-0" id="chartTitle">Projects Overview</h4>
                                <ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">
                                    <button id="exportExcelBtn" class="btn btn-success mb-2"><i
                                            class='bx bx-download'></i> Export Excel</button>
                                    <select class="default-select  form-control wide" name="tahun" id="tahun">
                                        @foreach ($list_tahun as $tahun)
                                            <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                        @endforeach
                                    </select>
                                </ul>

                                {{-- Chart --}}


                                {{-- <div class="col-xl-2 mb-3">
                                        
                                    </div>
                                    <div class="col-xl-4 mb-3">
                                        
                                    </div> --}}



                                {{-- End Chart --}}

                            </div>
                            <div class="card-body  p-0">

                                <div id="overiewChart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="heading mb-0">My To Do Items</h4>
                                <div>
                                    <a href="javascript:void(0);" class="text-primary me-2">View All</a>
                                    <a href="javascript:void(0);" class="text-black"> + Add To Do</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="dt-do-bx">
                                    <div class="draggable-zone dropzoneContainer to-dodroup dz-scroll" tabindex="0">
                                        <div class="sub-card draggable-handle draggable" tabindex="0">
                                            <div class="d-items">
                                                <span class="text-warning dang d-block mb-2">
                                                    <svg class="me-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.61051 15.3276H14.3978C15.5843 15.3276 16.329 14.0451 15.7395 13.0146L10.35 3.59085C9.75676 2.5536 8.26126 2.55285 7.66726 3.5901L2.26876 13.0139C1.67926 14.0444 2.42326 15.3276 3.61051 15.3276Z" stroke="#FF9F00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.00189 10.0611V7.7361" stroke="#FF9F00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8.99625 12.375H9.00375" stroke="#FF9F00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    Latest to do's
                                                </span>
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888"></rect>
                                                                <rect y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="15" width="1" height="1" fill="#888888"></rect>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox1" required="">
                                                                <label class="form-check-label" for="customCheckBox1">Compete this projects Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M7.34723 4.00059L10.9821 6.79201" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable" tabindex="0">
                                            <div class="d-items">
                                                <span class="text-success dang d-block mb-2">
                                                    <svg class="me-1" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15 4.5L6.75 12.75L3 9" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    Latest finished to do's
                                                </span>
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888"></rect>
                                                                <rect y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="15" width="1" height="1" fill="#888888"></rect>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                                                                <label class="form-check-label" for="customCheckBox2">Compete this projects Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M7.34723 4.00059L10.9821 6.79201" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable" tabindex="0">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888"></rect>
                                                                <rect y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="15" width="1" height="1" fill="#888888"></rect>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox3" required="">
                                                                <label class="form-check-label" for="customCheckBox3">Compete this projects Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M7.34723 4.00059L10.9821 6.79201" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable" tabindex="0">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888"></rect>
                                                                <rect y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="15" width="1" height="1" fill="#888888"></rect>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox4" required="">
                                                                <label class="form-check-label" for="customCheckBox4">Compete this projects Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M7.34723 4.00059L10.9821 6.79201" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>

                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                        <div class="sub-card draggable-handle draggable" tabindex="0">
                                            <div class="d-items">
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    <div class="d-items-2">
                                                        <div>
                                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="1" height="1" fill="#888888"></rect>
                                                                <rect y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="4" y="15" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="3" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="6" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="9" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="12" width="1" height="1" fill="#888888"></rect>
                                                                <rect x="8" y="15" width="1" height="1" fill="#888888"></rect>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="form-check custom-checkbox">
                                                                <input type="checkbox" class="form-check-input" id="customCheckBox5" required="">
                                                                <label class="form-check-label" for="customCheckBox5">Compete this projects Monday</label>
                                                            </div>
                                                            <span>2023-12-26 07:15:00</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="icon-box icon-box-md bg-danger-light me-1">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12.8833 6.31213C12.8833 6.31213 12.5213 10.8021 12.3113 12.6935C12.2113 13.5968 11.6533 14.1261 10.7393 14.1428C8.99994 14.1741 7.25861 14.1761 5.51994 14.1395C4.64061 14.1215 4.09194 13.5855 3.99394 12.6981C3.78261 10.7901 3.42261 6.31213 3.42261 6.31213" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M13.8055 4.1598H2.50012" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.6271 4.1598C11.1037 4.1598 10.6531 3.7898 10.5504 3.27713L10.3884 2.46647C10.2884 2.09247 9.94974 1.8338 9.56374 1.8338H6.74174C6.35574 1.8338 6.01707 2.09247 5.91707 2.46647L5.75507 3.27713C5.65241 3.7898 5.20174 4.1598 4.67841 4.1598" stroke="#FF5E5E" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="icon-box icon-box-md bg-primary-light">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.16492 13.6286H14" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.52001 2.52986C9.0371 1.91186 9.96666 1.82124 10.5975 2.32782C10.6324 2.35531 11.753 3.22586 11.753 3.22586C12.446 3.64479 12.6613 4.5354 12.2329 5.21506C12.2102 5.25146 5.87463 13.1763 5.87463 13.1763C5.66385 13.4393 5.34389 13.5945 5.00194 13.5982L2.57569 13.6287L2.02902 11.3149C1.95244 10.9895 2.02902 10.6478 2.2398 10.3849L8.52001 2.52986Z" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M7.34723 4.00059L10.9821 6.79201" stroke="#0D99FF" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>	
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('') }}/assets/js/excel/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/js/excel/FileSaver.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let chart = null;

        function chartAc(year, title) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('chart.getchart') }}",
                data: {
                    tahun: year
                },
                dataType: "JSON",
                success: result => {
                    if (chart) {
                        chart.destroy();
                    }
                    const total = result.map(item => parseInt(item.total));
                    const kalkus = total.reduce((acc, curr) => acc + curr);
                    $("#chartTitle").html(`${title} | Total : ${kalkus}`);
                    chart = drawChart(result, title, year);
                }
            });
        }

        function drawChart(result, title, year) {

            document.querySelector("#overiewChart").innerHTML = ""; // Menghapus elemen HTML chart sebelumnya

            var total = result.map(item => parseInt(item.total));
            var kalkulasi = total.reduce((acc, curr) => acc + curr);
            var bulan = result.map(item => item.bulan);

            var options = {
                series: [{
                    name: '',
                    type: 'column',
                    data: total
                }, {
                    name: '',
                    type: 'area',
                    data: total
                }, {
                    name: '',
                    type: 'line',
                    data: total
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    stacked: false,
                    toolbar: {
                        show: true,
                    },
                },
                stroke: {
                    width: [0, 1, 1],
                    curve: 'straight',
                    dashArray: [0, 0, 5]
                },
                legend: {
                    fontSize: '13px',
                    fontFamily: 'poppins',
                    labels: {
                        colors: '#888888',
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '18%',
                        borderRadius: 6,
                    }
                },

                fill: {
                    //opacity: [0.1, 0.1, 1],
                    type: 'gradient',
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        /* opacityFrom: 0.85,
                        opacityTo: 0.55, */
                        colorStops: [
                            [{
                                    offset: 0,
                                    color: 'var(--primary)',
                                    opacity: 1
                                },
                                {
                                    offset: 100,
                                    color: 'var(--primary)',
                                    opacity: 1
                                }
                            ],
                            [{
                                    offset: 0,
                                    color: '#3AC977',
                                    opacity: 1
                                },
                                {
                                    offset: 0.4,
                                    color: '#3AC977',
                                    opacity: .15
                                },
                                {
                                    offset: 100,
                                    color: '#3AC977',
                                    opacity: 0
                                }
                            ],
                            [{
                                    offset: 0,
                                    color: '#FF5E5E',
                                    opacity: 1
                                },
                                {
                                    offset: 100,
                                    color: '#FF5E5E',
                                    opacity: 1
                                }
                            ],
                        ],
                        stops: [0, 100, 100, 100]
                    }
                },
                colors: ["var(--primary)", "#3AC977", "#FF5E5E"],
                labels: bulan,
                markers: {
                    size: 0
                },
                xaxis: {
                    type: 'month',
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: '#888888',
                        },
                    },
                },
                yaxis: {
                    min: 0,
                    tickAmount: 4,
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: '#888888',
                        },
                    },
                },
                tooltip: {
                    shared: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== 'undefined') {
                                return y.toFixed(0) + ' unit';
                            }
                            return y;
                        }
                    },
                    style: {
                        fontSize: '16px', // Ukuran font tooltip
                        textAlign: 'center' // Penempatan teks di tengah
                    }
                }
            };

            var newChart = new ApexCharts(document.querySelector("#overiewChart"), options);
            newChart.render();

            return newChart; // Mengembalikan instance chart baru
        }

        function exportChartToExcel() {
            if (chart) {
                var chartData = chart.w.globals.series.slice(); // Menggunakan data yang sama dengan chart

                // Membuat array untuk menyimpan data yang akan diekspor ke Excel
                var exportData = [
                    ['Tahun', 'Bulan', 'Total']
                ];

                // Mengisi array exportData dengan data chart
                for (var i = 0; i < chartData[0].length; i++) {
                    var tahun = $('#tahun').val(); // Mengambil tahun dari input select dengan id "tahun"
                    var bulanIndex = chart.w.globals.labels[i] - 1;
                    var bulan = new Date(0, bulanIndex).toLocaleString('default', {
                        month: 'long'
                    });
                    var total = chartData[0][i];

                    exportData.push([tahun, bulan, total]);
                }

                // Membuat worksheet Excel menggunakan library "xlsx"
                var worksheet = XLSX.utils.aoa_to_sheet(exportData);

                // Membuat workbook Excel
                var workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Chart Data');

                // Mengkonversi workbook Excel menjadi file binary
                var excelFile = XLSX.write(workbook, {
                    bookType: 'xlsx',
                    type: 'binary'
                });

                // Mendownload file Excel
                saveAs(new Blob([s2ab(excelFile)], {
                    type: 'application/octet-stream'
                }), 'chart_data.xlsx');
            }
        }

        // Fungsi untuk mengkonversi string menjadi array buffer
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
            return buf;
        }


        $(document).ready(function() {
            $('#tahun').change(function() {
                var year = $(this).val();

                if (year != '') {
                    chartAc(year, `Statistic Bulanan Maintenance AC : Tahun ${year}`);
                }
            });

            const d = new Date();
            let tahun = d.getFullYear();
            $("#chartTitle").html(`Statistic Bulanan Maintenance AC : Tahun ${tahun}`);
            chartAc(tahun, `Statistic Bulanan Maintenance AC : Tahun ${tahun}`);

            // Event listener untuk tombol "Export Excel"
            $('#exportExcelBtn').click(function() {
                exportChartToExcel();
            });

        });
    </script>
@endsection
