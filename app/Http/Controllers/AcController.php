<?php

namespace App\Http\Controllers;

use App\Models\Ac;
use Carbon\Carbon;
use App\Models\Chart;
use Illuminate\Http\Request;
use App\Exports\exportDataAc;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $data = Ac::all();
        return view('AC.index', [
            'title' => 'List AC',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AC/create', [
            'title' => 'Tambah Data AC'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wing' => 'required',
            'lantai' => 'required',
            'ruangan' => 'required|min:2',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required|min:3',
            'status' => 'required'
        ]);

        $validator->sometimes('seri_indoor', 'unique:ac,NULL', function ($input) {
            return $input->seri_indoor !== null;
        });

        $validator->sometimes('seri_outdoor', 'unique:ac,NULL', function ($input) {
            return $input->seri_outdoor !== null;
        });

        if ($request->label != NULL) {
            $validator->sometimes('label', 'unique:ac,NULL', function ($input) {
                return !empty($input->label);
            });
        }



        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah data!');
        }
        $petugas_maint = implode(',', $request->petugas_maint);

        $validateDataAc =
            [
                'label' => $request->label,
                'assets' => $request->assets,
                'wing' => $request->wing,
                'lantai' => $request->lantai,
                'ruangan' => $request->ruangan,
                'merk' => $request->merk,
                'type' => $request->type,
                'jenis' => $request->jenis,
                'kapasitas' => $request->kapasitas,
                'refrigerant' => $request->refrigerant,
                'product' => $request->product,
                'current' => $request->current,
                'voltage' => $request->voltage,
                'btu' => $request->btu,
                'pipa' => $request->pipa,
                'status' => $request->status,
                'catatan' => $request->catatan,
                'kerusakan' => $request->kerusakan,
                'keterangan' => $request->keterangan,
                'tgl_pemasangan' => $request->tgl_pemasangan,
                'petugas_pemasangan' => $request->petugas_pemasangan,
                'tgl_maintenance' => $request->tgl_maintenance,
                'petugas_maint' => $petugas_maint,
                'seri_indoor' => $request->seri_indoor,
                'seri_outdoor' => $request->seri_outdoor,
                'user_id' => auth()->user()->id
            ];

        AC::create($validateDataAc);
        return redirect('/ac')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ac = AC::find($id);
        // dd(gettype($ac->tgl_pemasangan));
        if (!$ac) {
            return back()->with('error', 'Data AC tidak ditemukan.');
        }

        return view('AC.update', [
            'title' => 'Update Data AC',
            'ac' => $ac,
            'dataall' => ['Rinto Harahap', 'Rahmat Abdullah', 'Alim Darmawan', 'Rahmat Hidayatullah', 'Rahmat Haryadi', 'Andriadi Hamid', 'Arif Nur', 'Arif Dg Awing', 'Syahril Dahlan', 'Hasrul']
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $old = AC::find($id);

        // dd($request->petugas_maint);

        $validator = Validator::make($request->all(), [
            'wing' => 'required',
            'lantai' => 'required',
            'ruangan' => 'required|min:3',
            'merk' => 'required',
            'type' => 'required',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'refrigerant' => 'required',
            'voltage' => 'required|min:3',
            'status' => 'required'
        ]);

        if ($old->seri_indoor != $request->seri_indoor) {
            $validator->sometimes('seri_indoor', 'unique:ac,NULL', function ($input) {
                return !empty($input->seri_indoor);
            });
        }
        if ($old->seri_outdoor != $request->seri_outdoor) {
            $validator->sometimes('seri_outdoor', 'unique:ac,NULL', function ($input) {
                return !empty($input->seri_outdoor);
            });
        }
        if ($old->label != $request->label) {
            $validator->sometimes('label', 'unique:ac,NULL', function ($input) {
                return !empty($input->label);
            });
        }



        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal mengubah data!');
        }


        if ($request->tgl_maintenance != $old->tgl_maintenance) {
            $iniBulan = Carbon::now()->format("F");
            $tahunIni = Carbon::now()->format("Y");

            $chartAc = Chart::where('bulan', $iniBulan)
                ->where('tahun', $tahunIni)
                ->first();

            if ($chartAc) {
                $chartAc->total++;
                $chartAc->save();
            } else {
                Chart::create([
                    'tahun' => $tahunIni,
                    'bulan' => $iniBulan,
                    'total' => 1,
                ]);
            }
        }




        $petugas_maint = '';

        if ($request->petugas_maint !== null) {
            $petugas_maint = implode(',', $request->petugas_maint);
        }

        $validateNewData = [
            'label' => $request->label,
            'assets' => $request->assets,
            'wing' => $request->wing,
            'lantai' => $request->lantai,
            'ruangan' => $request->ruangan,
            'merk' => $request->merk,
            'type' => $request->type,
            'jenis' => $request->jenis,
            'kapasitas' => $request->kapasitas,
            'refrigerant' => $request->refrigerant,
            'product' => $request->product,
            'current' => $request->current,
            'voltage' => $request->voltage,
            'btu' => $request->btu,
            'pipa' => $request->pipa,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'kerusakan' => $request->kerusakan,
            'keterangan' => $request->keterangan_edit,
            'petugas_pemasangan' => $request->petugas_pemasangan,
            'tgl_maintenance' => $request->tgl_maintenance,
            'petugas_maint' => $petugas_maint,
            'seri_indoor' => $request->seri_indoor,
            'seri_outdoor' => $request->seri_outdoor,
            'user_updated' => auth()->user()->name,
            'user_updated_time' => date('Y-m-d H:i:s'),
        ];

        if ($request->tgl_pemasangan !== null) {
            $validateNewData['tgl_pemasangan'] = $request->tgl_pemasangan;
        } else {
            $validateNewData['tgl_pemasangan'] = $old->tgl_pemasangan;
        }

        AC::where('id', $id)
            ->update($validateNewData);

        return redirect('/ac')->with('success', 'Data berhasil diubah!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Ac::where('id', $id)->update(['is_delete' => auth()->user()->name]);
            Ac::destroy($id);
            return redirect('/ac')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/ac')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function queryRangeAc($nilai)
    {
        $start = substr($nilai, 0, 10);
        $end = substr($nilai, 13, 24);

        $range = AC::whereBetween('user_updated_time', [$start, $end])->get();
        $countRange = $range->count();

        if ($countRange === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data tidak ditemukan!'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countRange,
            'data' => $range
        ];

        return response()->json($responseData);
    }

    public function queryDataAcBaru($data)
    {
        $start = substr($data, 0, 10);
        $end = substr($data, 13, 24);

        $dataACBaru = Ac::whereBetween('tgl_pemasangan', [$start, $end])->get();
        $countDataACBaru = $dataACBaru->count();

        if ($countDataACBaru === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data tidak ditemukan!'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countDataACBaru,
            'data' => $dataACBaru
        ];

        return response()->json($responseData);
    }

    public function trash()
    {
        return view('AC.trash', [
            'title' => 'Trash',
            'softData' => AC::onlyTrashed()->get()
        ]);
    }

    public function restore($id)
    {

        $restoreDataId = AC::withTrashed()->find($id);

        if ($restoreDataId && $restoreDataId->trashed()) {
            $restoreDataId->restore();
        }

        return response()->json(['success' => 'Data berhasil direstore']);
    }

    public function deleteAll()
    {
        AC::onlyTrashed()->forceDelete();
        return redirect('/ac/trash')->with('success', 'Recycle Bin berhasil dibersihkan!');
    }

    public function listMainten()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(4)->format('Y-m-d H:i');
        // dd($threeMonthsAgo);

        $dataAC = AC::where(DB::raw("STR_TO_DATE(tgl_maintenance, '%Y-%m-%d %H:%i')"), '<', $threeMonthsAgo)
            ->get();

        return view('AC.listMainten', [
            'title' => 'List Maintenance AC',
            'data' => $dataAC
        ]);
    }

    public function exportDataAc()
    {
        return Excel::download(new exportDataAc, 'data-ac.xlsx');
    }

    public function deleteCheckedAc(Request $request)
    {
        $ids = $request->ids;
        Ac::whereIn('id', $ids)->update(['is_delete' => auth()->user()->name]);
        Ac::whereIn('id', $ids)->delete();

        $responseData = Ac::all()->count();

        if ($responseData === 0) {
            return response()->json([$responseData], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        return response()->json($responseData);
    }


    // SEMUA FUNGSI API

    public function getDataAc()
    {
        // $data = Ac::all(['tgl_pemasangan','petugas_pemasangan','label','assets','wing','lantai','ruangan','merk','type','jenis','kapasitas','refrigerant','product','current','voltage','btu','pipa','seri_indoor','seri_outdoor','status','catatan','kerusakan','keterangan']);
        $data = Ac::all(['id', 'label', 'wing', 'lantai', 'ruangan', 'type', 'status']);

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not Found!']);
        }
    }

    public function getDataAcDetails($id)
    {
        $dataDetail = Ac::find($id);
        if ($dataDetail) {
            return response()->json($dataDetail);
        } else {
            return response()->json(['error' => 'Not Found!']);
        }
    }

    public function AcDelete($id)
    {
        $dataDetail = Ac::find($id);

        if ($dataDetail) {
            $dataDetail->delete();
            return response()->json(['success' => 'Data deleted successfully']);
        } else {
            return response()->json(['error' => 'Not Found!']);
        }
    }
    public function AcUpdate(Request $request, $id)
    {

        // Aturan validasi
        $rules = [
            'tgl_maintenance' => 'required|date',
            'petugas_maint' => 'required|string',
        ];

        // Pesan error custom untuk setiap aturan
        $messages = [
            'tgl_maintenance.required' => 'Tanggal maintenance harus diisi.',
            'tgl_maintenance.date' => 'Format tanggal maintenance tidak valid.',
            'petugas_maint.required' => 'Petugas maintenance harus diisi.',
            'petugas_maint.string' => 'Format petugas maintenance tidak valid.',
        ];

        // Validasi data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $old = AC::find($id);

        if ($request->tgl_maintenance != $old->tgl_maintenance) {
            $iniBulan = Carbon::now()->format("F");
            $tahunIni = Carbon::now()->format("Y");

            $chartAc = Chart::where('bulan', $iniBulan)
                ->where('tahun', $tahunIni)
                ->first();

            if ($chartAc) {
                $chartAc->total++;
                $chartAc->save();
            } else {
                Chart::create([
                    'tahun' => $tahunIni,
                    'bulan' => $iniBulan,
                    'total' => 1,
                ]);
            }
        }

        // Proses nilai "petugas_maint" dari string menjadi array yang terpisah
        $petugasArr = explode(", ", $request->petugas_maint);

        // Ambil array dan gabungkan sebagai string yang dipisahkan koma
        $petugas = implode(", ", $petugasArr);

        $data = [
            'tgl_maintenance' => $request->tgl_maintenance,
            'petugas_maint' => $petugas,
        ];

        AC::where('id', $id)
            ->update($data);
        return response()->json(['success' => 'Updated successfully']);
    }
}
