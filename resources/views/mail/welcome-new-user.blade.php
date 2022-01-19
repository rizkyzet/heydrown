<html>

<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        .header {
            text-align: center;
            background: black;
        }

        .header h3 {
            color: white;
        }

        hr {
            color: black;
            background-color: black;
        }

        .btn-mail {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: black;
            padding: 10px 15px;
        }

        .text {
            margin-bottom: 30px;
        }

        .link-group {
            text-align: center;
        }

        .footer {
            background-color: black;
            text-align: center;
            color: white;
            padding: 20px 25px;
            margin-top: 50px;
        }

    </style>
</head>

<body>

    <div class="header">
        <img src="https://rizkyzet.website/img/logo2.png" width="200" height="100">
    </div>
    <hr>
    <div class="body">
        <h3 style="text-align: center">Selamat Datang {{ $userName }}</h3>
        <p class="text">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis, dolorem? Optio libero, perspiciatis culpa
            cupiditate labore inventore quos nisi doloribus impedit illum. Ducimus minus doloremque, laboriosam neque
            consectetur voluptatem dolores commodi quae qui maiores nisi laudantium distinctio ab. Eius perspiciatis,
            sint excepturi nemo quasi mollitia neque! Debitis nulla cumque, nam deleniti neque eligendi nostrum quidem,
            atque omn?
        </p>

        <div class="link-group">
            <a href="{{ route('outside.products') }}" class="btn-mail" target="_blank">Semua Produk</a>
            <a href="{{ route('outside.products') . '?event=sale' }}" class="btn-mail" target="_blank">Sale
                Products</a>
        </div>

    </div>


    <div class="footer">
        <p>Copyright &copy; {{ date('Y') }} Heydrown&trade;. All Rights Reserved.</p>
    </div>
</body>

</html>
