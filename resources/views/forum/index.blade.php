<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Pitnik Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleBlog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css"') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</head>

<body>
    {{-- <div class="wavy-wraper">
		<div class="wavy">
		  <span style="--i:1;">p</span>
		  <span style="--i:2;">i</span>
		  <span style="--i:3;">t</span>
		  <span style="--i:4;">n</span>
		  <span style="--i:5;">i</span>
		  <span style="--i:6;">k</span>
		  <span style="--i:7;">.</span>
		  <span style="--i:8;">.</span>
		  <span style="--i:9;">.</span>
		</div>
	</div> --}}
    <div class="theme-layout">



        <section>
            <div class="gap gray-bg">
                @include('auth.alert')
                <div class="container">
                    <div class="row merged20">
                        <div class="col-lg-9">
                            <div class="forum-warper">
                                <div class="central-meta">

                                    <h4>A new way to find help </h4>
                                </div><!-- title block -->
                                <a class="addnewforum" href="{{ route('blog.createPost') }}" title=""><i
                                        class="fa fa-plus"></i> Add New</a>
                            </div>
                            <div class="central-meta">
                                <div class="forum-list">
                                    <div class="wrap-blogs">
                                        <div class="header">
                                            <h3 style="color: #fd7e14;">Forum</h3>
                                        </div>
                                        <div class="content-blogs">
                                            @foreach ($result as $post)
                                                @if ($post->status == 1)
                                                <div class="blog" style="width: 90%; margin: 0 auto; ">
                                                    <div class="container-blog" style="background-color: #edf2f6; padding: 40px;border-radius: 20px;  margin-bottom: 30px;">
                                                        <div class="tile-article">
                                                            <i class="fas fa fa-comments"></i>
                                                            <div class="dropdown">
                                                                <a href="forums-category.html"
                                                                    title="">{{ $post->title }}</a>
                                                                <div class="menu-action action" id=""
                                                                    style="cursor: pointer;">
                                                                    <i class="icons fas fa-light fa-ellipsis-vertical"
                                                                        style="padding: 10px;"></i>
                                                                        <ul class="menus" >
                                                                            <form action="" method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf  
                                                                                <li class="edit-blog" data-toggle="modal"
                                                                                data-target="#myModal" style="cursor: pointer; border-bottom:1px solid #ccc;">
                                                                                    <i style="margin-right: 5px;" class="fas fa-thin fa-pen-to-square"></i>edit
                                                                                </li>
                                                                                <li id="delete-blog"><i style="margin-right: 5px;" class="fas fa-thin fa-trash"></i>delete
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                            </div>
                                                            

                                                        </div>
                                                        <p>{{ $post->content }}</p>
                                                        @if (!empty($post->image))
                                                            <div class="thumbnail" style="width: 90%; height:500px; margin: 0 auto;">
                                                                <img src="{{ url('/public/uploads/' . $post->image) }}"
                                                                    class="img" alt="" style="height:100%;">
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                                @endif
                                            @endforeach

											
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
						<div class="col-lg-3">
							<aside class="sidebar static">
								<div class="widget">
									<h4 class="widget-title">Forum Statistics</h4>
									<ul class="forum-static">
										<li>
											<a href="#" title="">Forums</a>
											<span>13</span>
										</li>
										<li>
											<a href="#" title="">Registered Users</a>
											<span>50</span>
										</li>
										<li>
											<a href="#" title="">Topics</a>
											<span>14</span>
										</li>
										<li>
											<a href="#" title="">Replies</a>
											<span>32</span>
										</li>
										<li>
											<a href="#" title="">Topic Tags</a>
											<span>50</span>
										</li>
									</ul>
								</div>
								<div class="widget">
									<h4 class="widget-title">Recent Topics</h4>
									<ul class="recent-topics">
										<li>
											<a href="#" title="">The new Goddess of War trailer was launched at E3!</a>
											<span>2 hours, 16 minutes ago</span>
											<i>The Community</i>
										</li>
										<li>
											<a href="#" title="">The new Goddess of War trailer was launched at E3!</a>
											<span>2 hours, 16 minutes ago</span>
											<i>The Community</i>
										</li>
										<li>
											<a href="#" title="">The new Goddess of War trailer was launched at E3!</a>
											<span>2 hours, 16 minutes ago</span>
											<i>The Community</i>
										</li>
									</ul>
								</div>
								<div class="widget">
									<h4 class="widget-title">Featured Topics</h4>
									<ul class="feature-topics">
										<li>
											<i class="fa fa-star"></i>
											<a href="#" title="">What is your favourit season in summer?</a>
											<span>2 hours, 16 minutes ago</span>
										</li>
										<li>
											<i class="fa fa-star"></i>
											<a href="#" title="">The new Goddess of War trailer was launched at E3!</a>
											<span>2 hours, 16 minutes ago</span>
										</li>
										<li>
											<i class="fa fa-star"></i>
											<a href="#" title="">Summer is Coming! Picnic in the east boulevard park</a>
											<span>2 hours, 16 minutes ago</span>
										</li>
									</ul>
								</div>
							</aside>	
						</div>
                    </div>
                </div>
                {{-- modal --}}
                <div class="modal fade" id="myModal" style="width: 100%;">
                    <div class="modal-dialog" style="max-width: 800px !important;">
                        <div class="modal-content" >

                            <!-- Header của Modal dialog -->
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">
                                    プロファイル編集</h4>
                                <button type="button" class="close"
                                    data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Body của Modal dialog -->
                            <form action="">
                                <div class="modal-body">
                                    <div class=""
                                        style="width: 200px; margin: 0 auto; border-radius: 50%; ">
                                        <img src="" alt="" id="image"
                                            style="width:200px !important; border-radius:50%; max-height: 200px">
                                        <input type="hidden" name="imgFile" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><b>タイトル</b></label>
                                        <input type="text" name="name"
                                            class="form-control input" id="name"
                                            autocomplete="off"　 placeholder="Name"
                                            value="" style="
                                            background-color: #ccc; padding: 5px 10px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone"><b>内容</b></label>
                                        <input type="text" name="phone"
                                            class="form-control input" id="name"
                                            autocomplete="off" placeholder="Phone"
                                            value="" style="
                                            background-color: #ccc; padding: 5px;">
                                    </div>
                                    <div class="form-group" id="uploadfile">
                                        <label for="fileinput"><b>画像</b></label>
                                        <input style="display: none" type="file"
                                            name="file" id="fileinput"
                                            onchange="chooseFile(this)">
                                    </div>
                                </div>
    
                                <!-- Footer của Modal dialog -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">近い</button>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="getquot-baner purple high-opacity">
                <div class="bg-image" style="background-image:url(images/resources/animated-bg2.png)"></div>
                <span>Want to join our awesome forum and start interacting with others?</span>
                <a title="" href="#">Sign up</a>
            </div>
        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="widget">
                            <div class="foot-logo">
                                <div class="logo">
                                    <a href="index.html" title=""><img src="images/logo2.png"
                                            alt=""></a>
                                </div>
                                <p>
                                    The trio took this simple idea and built it into the world’s leading carpooling
                                    platform.
                                </p>
                            </div>
                            <ul class="location">
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <p>+1-56-346 345</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <div class="widget-title">
                                <h4>follow</h4>
                            </div>
                            <ul class="list-style">
                                <li><i class="fa fa-facebook-square"></i> <a
                                        href="https://web.facebook.com/shopcircut/" title="">facebook</a></li>
                                <li><i class="fa fa-twitter-square"></i><a href="https://twitter.com/login?lang=en"
                                        title="">twitter</a></li>
                                <li><i class="fa fa-instagram"></i><a href="https://www.instagram.com/?hl=en"
                                        title="">instagram</a></li>
                                <li><i class="fa fa-google-plus-square"></i> <a
                                        href="https://plus.google.com/discover" title="">Google+</a></li>
                                <li><i class="fa fa-pinterest-square"></i> <a href="https://www.pinterest.com/"
                                        title="">Pintrest</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <div class="widget-title">
                                <h4>Navigate</h4>
                            </div>
                            <ul class="list-style">
                                <li><a href="about.html" title="">about us</a></li>
                                <li><a href="contact.html" title="">contact us</a></li>
                                <li><a href="terms.html" title="">terms & Conditions</a></li>
                                <li><a href="#" title="">RSS syndication</a></li>
                                <li><a href="sitemap.html" title="">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <div class="widget-title">
                                <h4>useful links</h4>
                            </div>
                            <ul class="list-style">
                                <li><a href="#" title="">leasing</a></li>
                                <li><a href="#" title="">submit route</a></li>
                                <li><a href="#" title="">how does it work?</a></li>
                                <li><a href="#" title="">agent listings</a></li>
                                <li><a href="#" title="">view All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="widget">
                            <div class="widget-title">
                                <h4>download apps</h4>
                            </div>
                            <ul class="colla-apps">
                                <li><a href="https://play.google.com/store?hl=en" title=""><i
                                            class="fa fa-android"></i>android</a></li>
                                <li><a href="https://www.apple.com/lae/ios/app-store/" title=""><i
                                            class="ti-apple"></i>iPhone</a></li>
                                <li><a href="https://www.microsoft.com/store/apps" title=""><i
                                            class="fa fa-windows"></i>Windows</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- footer -->
        <div class="bottombar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="copyright">© Pitnik 2020. All rights reserved.</span>
                        <i><img src="images/credit-cards.png" alt=""></i>
                    </div>
                </div>
            </div>
        </div><!-- bottom bar -->

    </div>


    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('/js/blog.js') }}"></script>

</body>

</html>
