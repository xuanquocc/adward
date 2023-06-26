<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/registerCreator.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="cotn_principal">
        <div class="cont_centrar">

            <div class="cont_login">
                <div class="cont_info_log_sign_up">
                    {{-- <div class="col_md_login">
                        <div class="cont_ba_opcitiy">

                            <h2>LOGIN</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <button class="btn_login" onclick="change_to_login()">LOGIN</button>
                        </div>
                    </div> --}}
                    <div class="col_md_sign_up">
                        <div class="cont_ba_opcitiy">
                            <h2>登録</h2>


                            <p>アカウントをお持ちでない場合は、ここから登録してください</p>

                            <button class="btn_sign_up" onclick="change_to_sign_up()">登録</button>
                        </div>
                    </div>
                </div>


                <div class="cont_back_info">
                    <div class="cont_img_back_grey">
                        <img src="{{asset('/images/registerbackground.jpg')}}"
                            alt="" />
                    </div>

                </div>
                <div class="cont_forms">
                    <div class="cont_img_back_">
                        <img src="{{asset('/images/registerbackground.jpg')}}"
                            alt="" />
                    </div>
                    <div class="cont_form_login">
                        <a href="#" onclick="hidden_login_and_sign_up()"><i
                                class="material-icons">&#xE5C4;</i></a>
                        <h2>LOGIN</h2>
                        <input type="text" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
                        <button class="btn_login" onclick="change_to_login()">LOGIN</button>
                    </div>

                    <form action="{{route('register.creator')}}" method="POST">
                        @csrf
                        <div class="cont_form_sign_up">
                            <a href="#" onclick="hidden_login_and_sign_up()"><i
                                    class="material-icons">&#xE5C4;</i></a>
                            <h2>登録</h2>
                            <input type="text" name="email" placeholder="Eメール" />
                            <input type="text" name="name" placeholder="名前" />
                            <input type="password" name="password" placeholder="パスワード" />
                            <input type="password" name="passwordConfirm" placeholder="パスワードを認証する" />
                            <button class="btn_sign_up" type="submit" onclick="change_to_sign_up()">登録</button>
    
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        const time_to_show_login = 400;
        const time_to_hidden_login = 200;

        // function change_to_login() {
        //     document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";
        //     document.querySelector('.cont_form_login').style.display = "block";
        //     document.querySelector('.cont_form_sign_up').style.opacity = "0";

        //     setTimeout(function() {
        //         document.querySelector('.cont_form_login').style.opacity = "1";
        //     }, time_to_show_login);

        //     setTimeout(function() {
        //         document.querySelector('.cont_form_sign_up').style.display = "none";
        //     }, time_to_hidden_login);
        // }

        const time_to_show_sign_up = 100;
        const time_to_hidden_sign_up = 400;

        function change_to_sign_up(at) {
            document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
            document.querySelector('.cont_form_sign_up').style.display = "block";
            document.querySelector('.cont_form_login').style.opacity = "0";

            setTimeout(function() {
                document.querySelector('.cont_form_sign_up').style.opacity = "1";
            }, time_to_show_sign_up);

            setTimeout(function() {
                document.querySelector('.cont_form_login').style.display = "none";
            }, time_to_hidden_sign_up);


        }

        const time_to_hidden_all = 500;

        function hidden_login_and_sign_up() {

            document.querySelector('.cont_forms').className = "cont_forms";
            document.querySelector('.cont_form_sign_up').style.opacity = "0";
            document.querySelector('.cont_form_login').style.opacity = "0";

            setTimeout(function() {
                document.querySelector('.cont_form_sign_up').style.display = "none";
                document.querySelector('.cont_form_login').style.display = "none";
            }, time_to_hidden_all);

        }
    </script>
</body>

</html>
