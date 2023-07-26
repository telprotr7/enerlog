
@php
    use Illuminate\Support\Carbon;
@endphp
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Penyelenggara</th>
            <th>Kegiatan</th>
            <th>Lokasi</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Durasi</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kegiatans as $kegiatan)
            @php
                
                $mulai = Carbon::parse($kegiatan->tanggal_mulai);
                $selesai = Carbon::parse($kegiatan->tanggal_selesai);
                $selisih = $mulai->diff($selesai);
                $durasi = $selisih->format('%d Hari %H jam');
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kegiatan->penyelenggara }}</td>
                <td>{{ $kegiatan->nama_kegiatan }}</td>
                <td>{{ $kegiatan->lokasi }}</td>
                <td>{{ date('Y-m-d H:i', strtotime($kegiatan->tanggal_mulai)) }}</td>
                <td>{{ date('Y-m-d H:i', strtotime($kegiatan->tanggal_selesai)) }}</td>
                <td>{{ $durasi }}
                <td>{{ $kegiatan->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
