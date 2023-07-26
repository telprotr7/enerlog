<?php

namespace App\Http\Controllers;

use App\Models\Ac;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function index()
   {

      $TotalAC = AC::count();

      $threeMonthsAgo = Carbon::now()->subMonths(4)->format('Y-m-d H:i');
      // dd($threeMonthsAgo);

      $dataCuciAC = Ac::where(DB::raw("STR_TO_DATE(tgl_maintenance, '%Y-%m-%d %H:%i')"), '<', $threeMonthsAgo)
         ->get()->count();

      $kalTahun = DB::table('chartac')->select('tahun')->groupBy('tahun')->orderBy('tahun', 'DESC')->get()->count();

      $kal = intval(Chart::sum('total'));


      $countAcRusak = AC::where('status', 'Rusak')->count();

      $bulanIni = Carbon::now()->format('m');
      $tahunIni = Carbon::now()->format('Y');

      $totalDataPemasanganACBulanIni = Ac::whereMonth('tgl_pemasangan', $bulanIni)
         ->whereYear('tgl_pemasangan', $tahunIni)
         ->count();


   // Mendapatkan tanggal hari ini
    $tanggalHariIni = Carbon::today();

   // Mengurangi 3 bulan dari tanggal hari ini
    $tanggalTigaBulanKebelakang = $tanggalHariIni->subMonths(3);
    
    // Menghitung jumlah hari dalam bulan April (3 bulan kebelakang)
    $jumlahHariApril = $tanggalTigaBulanKebelakang->daysInMonth;

    // Menghitung jumlah hari dalam bulan Mei (2 bulan kebelakang)
    $jumlahHariMei = $tanggalTigaBulanKebelakang->daysInMonth;
    
    // Mengurangi satu bulan lagi untuk mendapatkan bulan sebelumnya (Juni)
    $tanggalSatuBulanKebelakang = $tanggalTigaBulanKebelakang->subMonth();
    
    // Menghitung jumlah hari dalam bulan Juni
    $jumlahHariJuni = $tanggalSatuBulanKebelakang->daysInMonth;
    
   // Mendapatkan selisih jumlah hari antara tanggal awal bulan ini dan tanggal saat ini
   $jumlahHariBulanIni = $tanggalHariIni->day;

   // Menghitung total jumlah hari dari ketiga bulan tersebut + bulan ini tanggal ini
    $jumlahTotalHari = $jumlahHariApril + $jumlahHariJuni + $jumlahHariMei + $jumlahHariBulanIni;

      // BULAN INI
      // $jumlahHari = Carbon::now()->daysInMonth;


      $persentaseMaintenAC = round(($dataCuciAC / $TotalAC) * 100);

      $persentaseACRusak = round(($countAcRusak /$TotalAC) * 100);

      $tasks = Task::with('users')->get();


      $list_tahun = DB::table('chartac')
         ->select('tahun')
         ->groupBy('tahun')
         ->orderBy('tahun', 'DESC')
         ->get();

      return view('home.index', [
         'title' => 'Dashboard',
         'list_tahun' => $list_tahun,
         'totalAC' => $TotalAC,
         'jadwalCuci' => $dataCuciAC,
         'persentaseMaintenAC' => $persentaseMaintenAC,
         'countUsers' => User::count(),
         'kal' => $kal,
         'kalTahun' => $kalTahun,
         'countAcRusak' => $countAcRusak,
         'persentaseACRusak' => $persentaseACRusak,
         // 'jumlahHariBulanLalu' => $jumlahTotalAC,
         'totalDataPemasanganACBulanIni' => $totalDataPemasanganACBulanIni,
         'tasks' => $tasks
      ]);
   }

   public function getChart(Request $request)
   {
      $tahun = $request->tahun;
      $data = Chart::where('tahun', $tahun)
         ->orderBy('tahun', 'ASC')
         ->get()->toArray();
      foreach ($data as $d) {
         $output[] = array(
            'tahun' => $d['tahun'],
            'bulan' => $d['bulan'],
            'total' => $d['total']
         );
      }
      echo json_encode($output);
   }
}
