<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <style>
        .link-pass {
            width: 40px;
            height: 20px;
            background: rgb(100, 4, 104);
            font-size: 15px;
            border: 1px solid purple;
            border-radius: 26px;
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 13px;
            padding-right: 13px;
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <p>Silahkan klik tombol Reset Password dibawah ini untuk mengubah password Anda!</p>
    <br>
    <h4>Token ini hanya berlaku 1 menit.</h4>
    <br>
    <br>
    <a href="{{ route('reset.password', ['token' => $token, 'email' => $email]) }}" class="link-pass" style="text-decoration: none;color:white">Reset
        Password</a>
    <br>
    <br>
    <br>
    <p>Ini adalah pesan otomatis mohon untuk tidak dibalas!</p>
    <br>
    <br>
    <small>Develop By : Rinto Harahap</small>


</body>

</html>
