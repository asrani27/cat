<table>
    <tr>
        <th class="text-center">#</th>
        <th>RANKING</th>
        <th>NIK</th>
        <th>NAMA</th>
        <th>TELP</th>
        <th>JUMLAH SOAL</th>
        <th>DIJAWAB</th>
        <th>BELUM DIJAWAB</th>
        <th>BENAR</th>
        <th>SALAH</th>
        <th>STATUS UJIAN</th>
        <th>STATUS BERKAS</th>
        <th>STATUS WAWANCARA</th>
    </tr>
    @php
    $no=1
    @endphp
    @foreach ($data as $key => $item)
    <tr>
        <td>{{$no++}}</td>
        <td>{{ $item->ranking }}</td>
        <td>'{{$item->nik}}</td>
        <td>{{$item->nama}}</td>
        <td>'{{$item->telp}}</td>
        <td>{{$jmlSoal}}</td>
        <td>{{$item->dijawab}}</td>
        <td> {{$jmlSoal - $item->dijawab}}</td>
        <td>{{$item->benar}}</td>
        <td>{{$jmlSoal - $item->benar}}</td>
        <td>{{$item->status_ujian}}</td>
        <td>{{$item->status_berkas}}</td>
        <td>{{$item->status_wawancara}}</td>
    </tr>
    @endforeach
</table>