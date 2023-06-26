<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/loginCreator.css') }}">
    <title>Login</title>
</head>

<body>


    <div id="login-button">
        <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png" />
    </div>
    <div id="container">
        @include('auth.alert')
        <h1>ログイン</h1>
        <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png" />
        </span>

        <form action="{{route('login.creator')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="メール">
            <input type="password" name="password" placeholder="パスワード">
           <button type="submit" class="btn btn-submit">ログイン</button>
            <div class=" haha" >
                <div class="register">
                    <span ><a href="{{route('creator.register')}}" style=" font-size:17px;">登録</a></span>
                </div>
                <div id="remember-container" >
                    <span id="forgotten"><a href="{{route('forgetPass')}}">パスワードをお忘れですか？</a></span>
                </div>
                
            </div>
        </form>
    </div>

    <!-- Forgotten Password Container -->
    <div id="forgotten-container">
        <h1>Forgotten</h1>
        <span class="close-btn">
            <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"/>
        </span>

        <form>
            <input type="email" name="email" placeholder="E-mail">
            <a href="#" class="orange-btn">Get new password</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $('#login-button').click(function() {
            $('#login-button').fadeOut("slow", function() {
                $("#container").fadeIn();
                TweenMax.from("#container", .4, {
                    scale: 0,
                    ease: Sine.easeInOut
                });
                TweenMax.to("#container", .4, {
                    scale: 1,
                    ease: Sine.easeInOut
                });
            });
        });

        $(".close-btn").click(function() {
            TweenMax.from("#container", .4, {
                scale: 1,
                ease: Sine.easeInOut
            });
            TweenMax.to("#container", .4, {
                left: "0px",
                scale: 0,
                ease: Sine.easeInOut
            });
            $("#container, #forgotten-container").fadeOut(800, function() {
                $("#login-button").fadeIn(800);
            });
        });

        /* Forgotten Password */
        $('#forgotten').click(function() {
            $("#container").fadeOut(function() {
                $("#forgotten-container").fadeIn();
            });
        });
    </script>
</body>

</html>
