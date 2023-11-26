<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Award Japan</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/landingpage/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/landingpage/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css/landingpage/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/landingpage/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
    
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/landingpage/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="header_main">
            <div class="mobile_menu">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="logo_mobile"><a href="index.html"><img src="{{ asset('/images/Adward.png') }}"></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>
            </div>
            <div class="container-fluid">
                <div class="logo"><a href="index.html"><img src="{{ asset('/images/logo.png') }}"></a></div>

            </div>
        </div>
        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <h1 class="banner_taital">Adware Japan</h1>
                            <p class="banner_text">大学生向けNecscat企業賞 VKU</p>
                            <div class="login" style="display: flex; flex-direction: row;justify-content:center;">
                                <div class="read_bt"><a href="{{ route('creator.login')}}">ログイン</a></div>
                                <div class="read_bt"><a href="{{ route('creator.register')}}">登録</a></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- services section start -->
    <div class="services_section layout_padding">
        <div class="container">
            <h1 class="services_taital">サービス </h1>
            <p class="services_text">私たちのウェブサイトにはたくさんのサービスがあります</p>
            <div class="services_section_2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="wp"><img src="{{ asset('/images/landingpage2.jpeg') }}" class="services_img"
                                style="max-height: 233.325px;"></div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="wp"><img src="{{ asset('/images/landingpage3.jpeg') }}" class="services_img"></div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="wp"><img src="{{ asset('/images/landingpage4.jpeg') }}" class="services_img"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services section end -->
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_taital_main">
                        <h1 class="about_taital">情報</h1>
                        <p class="about_text"> ベトナム韓国情報通信大学（VKU）の学生<br>
                            Necscat社でインターン。<br>
                            日本に住んで働くという夢。<br>
                            得意なプログラミング言語 php、javascript. <br>
                            フレームワークはreactJs、Laravel、CakePHPを使用しています</p>
                    </div>
                </div>
                <div class="col-md-6 padding_right_0">
                    <div><img src="{{ asset('/images/aboutUs2.jpg') }}" class="about_img"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- blog section start -->
    <div class="blog_section layout_padding">
        <div class="container">
            <h1 class="blog_taital">日本の情報</h1>
            <p class="blog_text">日本語ではニャットホアとして知られる日本は、東アジアに位置する島国です。
                日本は世界をリードする先進経済国でもあります。 日本の主要産業には、自動車、エレクトロニクス、機械、医療機器、ハイテク製品が含まれます。 テクノロジーとイノベーションは日本社会の重要な部分を占めており、トヨタ、ソニー、パナソニック、任天堂などの日本企業は世界的に有名なブランドとなっています。</p>

        </div>
    </div>
    <!-- blog section end -->
    <!-- client section start -->

    <!-- client section start -->
    <!-- choose section start -->
    <div class="choose_section layout_padding">
        <div class="container">
            <h1 class="choose_taital">使用されている言語とフレームワーク</h1>
            <p class="choose_text">Laravel は、PHP 言語で書かれた Web アプリケーション開発フレームワークです。 複雑な Web サイトや Web アプリケーションを構築するための簡単かつ柔軟なアプローチを提供します。 Laravel には、アプリケーション開発をより迅速かつ簡単にする、素晴らしく明確で理解しやすい構文があります。</p>
            
            <div class="newsletter_box">
                <h1 class="let_text">Let Start Talk with Us</h1>
                <div class="getquote_bt"><a href="#">Get A Quote</a></div>
            </div>
        </div>
    </div>
    <!-- choose section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="input_btn_main">
                <input type="text" class="mail_text" placeholder="Enter your email" name="Enter your email">
                <div class="subscribe_bt"><a href="#">Subscribe</a></div>
            </div>
            <div class="location_main">
                <div class="call_text"><img src="{{ asset('/images/call-icon.png') }}"></div>
                <div class="call_text"><a href="#">Call +01 1234567890</a></div>
                <div class="call_text"><img src="{{ asset('/images/mail-icon.png') }}"></div>
                <div class="call_text"><a href="#">demo@gmail.com</a></div>
            </div>
            <div class="social_icon">
                <ul>
                    <li><a href="#"><img src="{{ asset('/images/fb-icon.png') }}"></a></li>
                    <li><a href="#"><img src="{{ asset('/images/twitter-icon.png') }}"></a></li>
                    <li><a href="#"><img src="{{ asset('/images/linkedin-icon.png') }}"></a></li>
                    <li><a href="#"><img src="{{ asset('/images/instagram-icon.png') }}"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{ asset('js/landingpageJs/jquery.min.js') }}"></script>
    <script src="{{ asset('js/landingpageJs/popper.min.js') }}"></script>
    <script src="{{ asset('js/landingpageJs/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/landingpageJs/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('js/landingpageJs/plugin.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('js/landingpageJs/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('js/landingpageJs/custom.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('js/landingpageJs/owl.carousel.js') }}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>
