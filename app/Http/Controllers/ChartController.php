<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Psr7\Request as Psr7Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $tahunIni = Carbon::now()->format('Y');

        $dataTotalUnit = Chart::where('tahun', $tahunIni)->sum('total');

        $data = Chart::where('tahun', $tahunIni)->get();

        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        

        $listUpdateTahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

        return view('chartAC.index', [
            'title' => 'Data chart AC',
            'listUpdateTahun' => $listUpdateTahun,
            'data' => $data,
            'month' => $month,
            'tahunTerpilih' => '',
            'dataTotalUnit' => intval($dataTotalUnit)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'bulan' => 'required',
            'total' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan data!');
        }

        $existingData = Chart::where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->first();

        if ($existingData) {
            return back()->with('error', 'Data already exists!');
        }

        $chart = new Chart;
        $chart->tahun = $request->tahun;
        $chart->bulan = $request->bulan;
        $chart->total = $request->total;
        $chart->save();

        return redirect('/chart')->with('success', 'Data has been added!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->idUpdateChart;

        $rules = [
            'tahunUpdateChart' => 'required',
            'monthUpdateChart' => 'required',
            'totalUpdateChart' => 'required'
        ];

        $data = $request->validate($rules);
        $data = [
            'tahun' => $request->tahunUpdateChart,
            'bulan' => $request->monthUpdateChart,
            'total' => $request->totalUpdateChart
        ];

        Chart::where('id', $id)->update($data);


        return redirect('/chart')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $tahun)
    {
        Chart::where('id', $id)->delete();
        $count = Chart::where('tahun', $tahun)->count();
        $total = Chart::where('tahun', $tahun)->sum('total');
        return response()->json([
           'count' => $count,
           'total' => $total
        ]);
    }

    public function searchChart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'updateTahun' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error', 'Tidak ada data yang dipilih!');
        }

        $input = $request->updateTahun;
        
        

        $dataTotalUnit = Chart::where('tahun', $input)->sum('total');


        $dataTahun = Chart::where('tahun', $input)->get();

        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


        $listUpdateTahun = DB::table('chartac')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

            
    
        return view('chartAC.index', [
            'title' => 'Data chart AC',
            'listUpdateTahun' => $listUpdateTahun,
            'data' => $dataTahun,
            'month' => $month,
            'tahunTerpilih' => $request->updateTahun,
            'dataTotalUnit' => intval($dataTotalUnit)
        ]);
    }

    public function deleteAllChart(Request $request)
    {
        $tahun = $request->deleteAllChart;
        
        if($tahun == null){
            return back()->with('error', 'Tidak ada data yang dipilih!');
        }else{
            Chart::where('tahun', $tahun)->delete();
            return back()->with('success', 'Data tahun ' . $tahun . ' berhasil dihapus!');
        }
    }
}
