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
        <input type="text" name="username" placeholder="username"><br /><br />
        <input type="text" name="password" placeholder="password"><br /><br />
        <button type="submit">Get Token</button><br />
    </form>
    Token Saya : {{$token}}

    <h2>Nilai Saya</h2>
    Masukkan Token<br />
    <input type="text" name="username" placeholder="Masukkan Token Disini"><br />
    <button type="submit">Get Nilai Saya</button><br /><br />
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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>