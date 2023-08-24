<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login Admin</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        body {
            background-color: lightgreen;
        }

        header {
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 15vh;
            box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
        }

        h1 {
            letter-spacing: 1.5vw;
            font-family: 'system-ui';
            text-transform: uppercase;
            text-align: center;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 75vh;
            width: 100%;
            background: url(https://get.wallhere.com/photo/landscape-anime-Background-Art-Japanese-Art-Love-Money-Rock-n-Roll-visual-novel-digital-art-building-artwork-1956735.jpg) no-repeat center center;
            background-size: cover;
        }

        .form_class {
            width: 500px;
            padding: 40px;
            border-radius: 8px;
            background-color: white;
            font-family: 'system-ui';
            box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.3);
        }

        .form_div {
            text-transform: uppercase;
        }

        .form_div>label {
            letter-spacing: 3px;
            font-size: 1rem;
        }

        .info_div {
            text-align: center;
            margin-top: 20px;
        }

        .info_div {
            letter-spacing: 1px;
        }

        .field_class {
            width: 100%;
            border-radius: 6px;
            border-style: solid;
            border-width: 1px;
            padding: 5px 0px;
            text-indent: 6px;
            margin-top: 10px;
            margin-bottom: 20px;
            font-family: 'system-ui';
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        .submit_class {
            border-style: none;
            border-radius: 5px;
            background-color: #FFE6D4;
            padding: 8px 20px;
            font-family: 'system-ui';
            text-transform: uppercase;
            letter-spacing: .8px;
            display: block;
            margin: auto;
            margin-top: 10px;
            box-shadow: 2px 2px 5px rgb(0, 0, 0, 0.2);
            cursor: pointer;
        }

        footer {
            height: 10vh;
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: -5px -5px 10px rgb(0, 0, 0, 0.3);
        }

        footer>p {
            text-align: center;
            font-family: 'system-ui';
            letter-spacing: 3px;
        }

        footer>p>a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <body>
        <header>
            <h1>Adward JP</h1>
        </header>
        <main>
            <form id="login_form" class="form_class" action="{{ route('login.check') }}" method="post">
                @csrf
                <div class="form_div">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-danger text-light">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger bg-danger text-light">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <label>メール:</label>
                    <input class="field_class" name="email" type="text" placeholder="メールアドレスを入力してください" autofocus>
                    <label>パスワード:</label>
                    <input id="pass" class="field_class" name="password" type="password"
                        placeholder="パスワードを入力してください">
                    <button class="submit_class" type="submit" form="login_form"
                        onclick="return validarLogin()">ログイン</button>
                </div>
                <div class="info_div">
                    <p>パスワードをお忘れですか？ <a href="{{ route('forgetPass') }}">ここをクリック</a></p>
                </div>
            </form>
        </main>
        <footer>
            <p> <a href="#"></a></p>
        </footer>
    </body>
</body>

</html>
