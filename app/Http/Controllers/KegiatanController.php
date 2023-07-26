<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Exports\exportDataKegiatan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', [
            'title' => 'Data Event',
            'kegiatan' => $kegiatan
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
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'tanggal_mulai' => 'required'
        ]);

        $validator->sometimes('penyelenggara', 'min:2', function ($input) {
            return $input->penyelenggara !== null;
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah data!');
        }

        $validateDataKegiatan =
            [
                'penyelenggara' => $request->penyelenggara,
                'nama_kegiatan' => $request->nama_kegiatan,
                'lokasi' => $request->lokasi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'keterangan' => $request->keterangan
            ];

        Kegiatan::create($validateDataKegiatan);
        return redirect('kegiatan')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'tanggal_mulai' => 'required'
        ]);

        $validator->sometimes('penyelenggara', 'min:2', function ($input) {
            return $input->penyelenggara !== null;
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambah data!');
        }

        $data = [
            'penyelenggara' => $request->penyelenggara,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan
        ];

        $kegiatan->update($data);

        return redirect('kegiatan')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Hapus data kegiatan berdasarkan ID yang diterima dari parameter
        $kegiatan->delete();

        return redirect('kegiatan')->with('success', 'Data berhasil diupdate!');
    }

    function rangeKegiatan($nilai)
    {
        $start = substr($nilai, 0, 10);
        $end = substr($nilai, 13, 24);

        $dataKegiatan = Kegiatan::whereBetween('tanggal_mulai', [$start, $end])->get();
        $countDataKegiatan = $dataKegiatan->count();

        if ($countDataKegiatan === 0) {
            return response()->json([
                'count' => 0,
                'message' => 'Data not found'
            ], 404); // Mengirim status HTTP 404 jika data tidak ditemukan
        }

        $responseData = [
            'count' => $countDataKegiatan,
            'data' => $dataKegiatan
        ];

        return response()->json($responseData);
    }

    public function exportDataKegiatan()
    {
        return Excel::download(new exportDataKegiatan, 'data-kegiatan.xlsx');
    }

}
