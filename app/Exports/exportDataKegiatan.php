<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportDataKegiatan implements \Maatwebsite\Excel\Concerns\FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('kegiatan.export-excel', [
            'kegiatans' => Kegiatan::all()
        ]);
    }
}
