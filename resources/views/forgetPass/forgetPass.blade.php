<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('library.Login')
    <title>Document</title>
</head>
<body>
    <form action="{{ route('postForgetPass') }}" method="POST">
        @csrf
        <legend style="text-align: center;">パスワードの取得</legend>
        <p style="text-align: center;">登録したメールアドレスを入力してください</p>
        <div class="form-group d-flex w-70 justify-content-center " >
            @include('auth.alert')
            <label for="" style="align-self: center; font-size:18px; font-weight:700;">メール </label>
            <input type="text" class="form-control" placeholder="メールアドレスを入力してください" value="" name="email" style="width:50%;">
            <button type="submit" class="btn btn-primary">確認メールを送信する</button>
        </div>
    </form>
</body>
</html>