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
    Token Saya :
</body>

</html>