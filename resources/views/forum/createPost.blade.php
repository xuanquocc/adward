<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォーラム</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleBlog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css"') }}">
    <link rel="stylesheet" href="{{ asset('css/createPost.css"') }}">
</head>

<body>
    <div class="theme-layout">
        <section>
            <div class="gap gray-bg">
                <div class="container">
                    <div class="row merged20">
                        <div class="col-lg-9">
                            <div class="forum-warper">
                                <div class="central-meta">
                                    <div class="title-block">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="align-left">
                                                    <h5>フォーラムのトピックを作成する</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div><!-- title block -->
                            </div>
                            <div class="forum-form">
                                <div class="central-meta">
                                    <form method="post" action="{{ route('blog.addPost') }}" class="c-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label>タイトル </label>
                                            <input type="text" name="title" id="title" required
                                                placeholder="Enter your topic ..." aria-rowspan="3">
                                        </div>
                                        <div>
                                            <label>コンテンツ </label>
                                            <textarea class="p-3" name="content" id="content" cols="30" rows="10" required="Empty"></textarea>
                                        </div>
                                        <img src="" id="image" alt="">
                                        <div>
                                            <div class="form-group" id="uploadfile">
                                                <label for="fileinput">画像</label>
                                                <input style="display: none" type="file"
                                                    name="file" id="fileinput" onchange="chooseFile(this)">
                                            </div>
                                        </div>
                                        <div>
                                            <button class="main-btn" type="submit" data-ripple="">投稿トピック</button>
                                            <a class="main-btn3 float-right" href="{{ route('blog') }}"
                                                data-ripple="">キャンセル
                                            </a>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <aside class="sidebar static right">
                                <div class="widget">
                                    <h4 class="widget-title">フォーラムの統計</h4>
                                    <ul class="forum-static">
                                        <li>
                                            <a href="#" title="">フォーラム
                                            </a>
                                            <span>13</span>
                                        </li>
                                        <li>
                                            <a href="#" title="">登録ユーザー</a>
                                            <span>50</span>
                                        </li>
                                        <li>
                                            <a href="#" title="">トピック
                                            </a>
                                            <span>14</span>
                                        </li>
                                        <li>
                                            <a href="#" title="">返信
                                            </a>
                                            <span>32</span>
                                        </li>
                                        <li>
                                            <a href="#" title="">トピックのタグ</a>
                                            <span>50</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">注目のトピック</h4>
                                    <ul class="feature-topics">
                                        {{-- <li>
                                        <i class="fa fa-star"></i>
                                        <a href="#" title="">What is your favourit season in
                                            summer?</a>
                                        <span>2 hours, 16 minutes ago</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                        <a href="#" title="">The new Goddess of War trailer was
                                            launched at E3!</a>
                                        <span>2 hours, 16 minutes ago</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                        <a href="#" title="">Summer is Coming! Picnic in the east
                                            boulevard park</a>
                                        <span>2 hours, 16 minutes ago</span>
                                    </li> --}}
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/js/blog.js') }}"></script>
</body>

</html>
