<table>
    <tr>
        <th class="text-center">#</th>
        <th>NIK</th>
        <th>NAMA</th>
        <th>TELP</th>
        <th>JUMLAH SOAL</th>
        <th>DIJAWAB</th>
        <th>BELUM DIJAWAB</th>
        <th>BENAR</th>
        <th>SALAH</th>
        {{-- <th class="text-center">Detail Soal</th>
        <th class="text-center">Pendidikan</th>
        <th class="text-center">Status</th> --}}
    </tr>
    @foreach ($data as $key => $item)
    <tr>
        <td>{{$key+ 1}}</td>
        <td>'{{$item->nik}}</td>
        <td>{{$item->nama}}</td>
        <td>'{{$item->telp}}</td>
        <td>{{$jmlSoal}}</td>
        <td>{{$item->dijawab}}</td>
        <td> {{$jmlSoal - $item->dijawab}}</td>
        <td>{{$item->benar}}</td>
        <td>{{$jmlSoal - $item->benar}}</td>
        {{-- <td class="text-left">
            Jumlah : {{$jmlSoal}} <br />
            Di Jawab : {{$item->dijawab}} <br />
            Belum Di Jawab : {{$jmlSoal - $item->dijawab}} <br />
            Benar : {{$item->benar}} <br />
            Salah : {{$jmlSoal - $item->benar}}

        </td>
        <td class="text-left">
            Sekolah/PTA : {{$item->kampus}} <br />
            Jurusan : {{$item->jurusan}} <br />
            Tahun Lulus : {{$item->tahun_lulus}} <br />
            Email : {{$item->email}}</td>
        <td>

        <td>
            Ujian : {{$item->status_ujian}} ({{$item->keterangan_ujian}})<br />
            Berkas : {{$item->status_berkas}} ({{$item->keterangan_berkas}}) <br />
            Wawancara : {{$item->status_wawancara}} ({{$item->keterangan_wawancara}})
            <br>
            @if ($item->sanggah->count() != 0)
            <b><span class="text-red"> Sanggah : {{$item->sanggah->first()->isi}}</span></b>
            @endif
        </td> --}}
    </tr>
    @endforeach
</table>