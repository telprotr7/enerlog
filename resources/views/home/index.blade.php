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

        .dt-button.buttons-excel.buttons-html5.btn.btn-sm.border-0 {
            display: none;
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
                                        <h3 class="text-white">{{ $totalAC }}</h3>

                                        @if ($totalDataPemasanganACBulanIni != 0)
                                            <small>{{ $totalDataPemasanganACBulanIni }} pemasangan AC bulan
                                                {{ Carbon::now()->format('F-Y') }}</small>
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
                                        <h3 class="text-white">{{ $countAcRusak }}</h3>
                                        <div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white"
                                                style="width: {{ $persentaseACRusak }}%"></div>
                                        </div>
                                        @if ($persentaseACRusak != 0)
                                            <small>{{ $persentaseACRusak }}% dari jumlah AC</small>
                                        @else
                                            <small>Semua AC dalam keadaan normal</small>
                                        @endif
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
                                        <p class="mb-1">jadwal maintenance ac</p>
                                        <h3 class="text-white">{{ $jadwalCuci }}</h3>
                                        @php
                                            // Mengatur nilai maksimal lebar progres bar menjadi 100
                                            $lebarProgresBar = 100 - $persentaseMaintenAC;
                                        @endphp

                                        <div class="progress">
                                            <div class="progress-bar progress-animated bg-white" role="progressbar"
                                                aria-valuenow="{{ $persentaseMaintenAC }}" aria-valuemin="0"
                                                aria-valuemax="100" style="width: {{ $lebarProgresBar }}%"></div>
                                        </div>
                                        {{-- <div class="progress mb-2 bg-primary">
                                            <div class="progress-bar progress-animated bg-white"
                                                style="width: {{ $persentaseMaintenAC }}%;"></div>
                                        </div> --}}
                                        <small>{{ $lebarProgresBar }}% dari jumlah AC</small>
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
                                        <h3 class="text-white">{{ $kal }}</h3>

                                        <small>Dalam {{ $kalTahun }} tahun</small>
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
                                    <button id="exportExcelBtn" class="btn btn-success mb-2"><i class='bx bx-download'></i>
                                        Export Excel</button>
                                    <select class="default-select  form-control wide" name="tahun" id="tahun">
                                        @foreach ($list_tahun as $tahun)
                                            <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                                        @endforeach
                                    </select>
                                </ul>
                            </div>
                            <div class="card-body  p-0">
                                <div id="overiewChart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 active-p">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive active-projects shorting">

                                    <div class="tbl-caption">
                                        <h4 class="heading mb-0">Active Tasks</h4>
                                    </div>
                                    <div id="projects-tbl_wrapper" class="dataTables_wrapper no-footer">
                                        <table id="projects-tbl" class="table ItemsCheckboxSec dataTable no-footer"
                                            role="grid" aria-describedby="projects-tbl_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Project Name: activate to sort column ascending"
                                                        style="width: 101.156px;">Task Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Project Lead: activate to sort column ascending"
                                                        style="width: 157.016px;">Start</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Progress: activate to sort column ascending"
                                                        style="width: 73.3125px;">End</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Assignee: activate to sort column ascending"
                                                        style="width: 74.8281px;">Assignee</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending"
                                                        style="width: 70.1562px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending"
                                                        style="width: 70.1562px;">Created</th>
                                                    <th class="sorting" tabindex="0" aria-controls="projects-tbl"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Due Date: activate to sort column ascending"
                                                        style="width: 83.2656px;">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tasks as $task)
                                                    <tr role="row" class="odd">
                                                        <td>{{ $task->name }}</td>
                                                        <td>

                                                            {{ $task->start }}

                                                        </td>
                                                        <td>

                                                            {{ $task->end }}
                                                        </td>
                                                        <td class="pe-0">
                                                            <div class="avatar-list avatar-list-stacked">
                                                                @foreach ($task->users as $user)
                                                                    @if (auth()->user()->image != 'default.png')
                                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                                            class="avatar rounded-circle"
                                                                            data-bs-container="body"
                                                                            data-bs-toggle="popover"
                                                                            data-bs-placement="top"
                                                                            data-bs-original-title="{{ $user->name }}"
                                                                            data-bs-trigger="hover" alt="">
                                                                    @else
                                                                        <img src="{{ asset('assets/images/avatar/' . $user->image) }}"
                                                                            class="avatar rounded-circle"
                                                                            data-bs-container="body"
                                                                            data-bs-toggle="popover"
                                                                            data-bs-placement="top"
                                                                            data-bs-original-title="{{ $user->name }}"
                                                                            data-bs-trigger="hover" alt="">
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        <td class="pe-0">
                                                            @if ($task->status == 'Started')
                                                                <span
                                                                    class="badge badge-primary light border-0 me-1">{{ $task->status }}</span>
                                                            @elseif ($task->status == 'Not Started')
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #ffeccc !important;
                                                            color: #FF9F00 !important;">{{ $task->status }}</span>
                                                            @elseif ($task->status == 'Complete')
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #daf5e6 !important;
                                                            color: #3AC977 !important;">{{ $task->status }}</span>
                                                            @elseif ($task->status == 'Pending')
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #ffdede !important;
                                                            color: #FF5E5E !important;">{{ $task->status }}</span>
                                                            @else
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: rgba(187, 107, 217, 0.1) !important;
                                                        color: #BB6BD9 !important;">{{ $task->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ Carbon::parse($task->created_at)->diffForHumans() }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($task->priority == 'Medium')
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #ffeccc !important;
                                                    color: #FF9F00 !important;">{{ $task->priority }}</span>
                                                            @elseif ($task->priority == 'High')
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #ffdede !important;
                                                    color: #FF5E5E !important;">{{ $task->priority }}</span>
                                                            @else
                                                                <span class="badge badge-primary light border-0 me-1"
                                                                    style="background-color: #daf5e6 !important;
                                                    color: #3AC977 !important;">{{ $task->priority }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                        chartAc(year, `Maintenance AC : Tahun ${year}`);
                    }
                });

                const d = new Date();
                let tahun = d.getFullYear();
                $("#chartTitle").html(`Maintenance AC : Tahun ${tahun}`);
                chartAc(tahun, `Maintenance AC : Tahun ${tahun}`);

                // Event listener untuk tombol "Export Excel"
                $('#exportExcelBtn').click(function() {
                    exportChartToExcel();
                });

            });
        </script>
    @endsection
