<?php

namespace App\Http\Controllers;

use App\Models\Ac;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function index()
   {

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


      // BULAN INI
      $jumlahHari = Carbon::now()->daysInMonth;



      // BULAN SEBELUMNYA
      // $bulanSebelumnya = Carbon::now()->subMonth();
      // $jumlahHari = $bulanSebelumnya->daysInMonth;

      // dd($jumlahHari);

      $persentaseMaintenAC = round(($dataCuciAC / $jumlahHari) * 100);

      $persentaseACRusak = round(($countAcRusak / $jumlahHari) * 100);


      $list_tahun = DB::table('chartac')
         ->select('tahun')
         ->groupBy('tahun')
         ->orderBy('tahun', 'DESC')
         ->get();

      return view('home.index', [
         'title' => 'Dashboard',
         'list_tahun' => $list_tahun,
         'countData' => AC::count(),
         'jadwalCuci' => $dataCuciAC,
         'persentaseMaintenAC' => $persentaseMaintenAC,
         'countUsers' => User::count(),
         'kal' => $kal,
         'kalTahun' => $kalTahun,
         'countAcRusak' => $countAcRusak,
         'persentaseACRusak' => $persentaseACRusak,
         'jumlahHariBulanLalu' => $jumlahHari,
         'totalDataPemasanganACBulanIni' => $totalDataPemasanganACBulanIni
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
