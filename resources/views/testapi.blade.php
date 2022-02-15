<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST API</title>
</head>

<body>

    <h2>TEST API</h2>
    <h4>Masukkan Username Dan Password</h4>
    <form method="POST" action="/testapi">
        @csrf
        <input type="text" name="username" value="{{old('username')}}" placeholder="username"><br /><br />
        <input type="text" name="password" value="{{old('password')}}" placeholder="password"><br /><br />
        <button type="submit">Get Token</button><br />
    </form>
    Token Saya : {{$token}}

    <h2>Nilai Saya</h2>
    Masukkan Token<br />
    <form method="POST" action="/testapi/nilai">
        @csrf
        <input type="text" name="token" placeholder="Masukkan Token Disini"><br />
        <button type="submit">Get Nilai Saya</button><br /><br />
    </form>

    <table border='1'>
        <tr>
            <th>No</th>
            <th>Jawaban</th>
            <th>Kunci</th>
            <th>Hasil</th>
        </tr>
        @php
        $no = 1;
        @endphp
        @foreach ($data as $item)
        <tr>
            <td align="center">{{$no++}}</td>
            <td align="center">{{$item->kunci}}</td>
            <td align="center">{{$item->jawabanku}}</td>
            <td align="center">{{$item->kunci == $item->jawabanku ? 'Benar': 'Salah'}}</td>
        </tr>
        @endforeach
    </table>
    <br />
    <table border='1'>
        <thead>
            <tr>
                <th>NIK</th>
                <th>NAMA</th>
                <th>JUMLAH SOAL</th>
                <th>BENAR</th>
                <th>SALAH</th>
                <th>TIDAK DI JAWAB</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1111111111111111</td>
                <td>Asrani</td>
                <td>50</td>
                <td>38</td>
                <td>12</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
</body>

</html>