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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
                <div class="m-3">
                    @include('auth.alert')
                </div>

                <div class="container">
                    <div class="row merged20">
                        <div class="col-lg-9">
                            <div class="forum-warper">
                                <div class="central-meta">

                                    <h4>助けを見つける新しい方法</h4>
                                </div><!-- title block -->


                                <a class=" float-left btn btn-dark" href="{{ route('blog') }}" title="">
                                    戻る
                                </a>
                            </div>
                            <div class="central-meta">
                                <div class="forum-list">
                                    <div class="wrap-blogs">
                                        <div class="header">
                                            <h3 style="color: #fd7e14;">フォーラム
                                            </h3>
                                        </div>
                                        <div class="content-blogs mt-5">

                                            <div class="blog border-bottom"
                                                style="width: 100%; margin: 20px auto; padding: 10px">
                                                <div class="container-blog"
                                                    style="background-color: #edf2f6; padding: 10px;border-radius: 20px;  margin-bottom: 30px;">
                                                    <div class="tile-article">
                                                        <i class="fas fa fa-comments"></i>
                                                        <div class="dropdown">
                                                            <a href="forums-category.html"
                                                                title="">{{ $post->title }}</a>
                                                            <div class="menu-action action" id=""
                                                                style="cursor: pointer;">
                                                                <i class="icons fas fa-light fa-ellipsis-vertical"
                                                                    style="padding: 10px;"></i>
                                                                <ul class="menus">
                                                                    <form action="" method="post"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <li class="edit-blog" data-toggle="modal"
                                                                            data-target="#myModal"
                                                                            style="cursor: pointer; border-bottom:1px solid #ccc;">
                                                                            <i style="margin-right: 5px;"
                                                                                class="fas fa-thin fa-pen-to-square"></i>edit
                                                                        </li>
                                                                        <li id="delete-blog"><i
                                                                                style="margin-right: 5px;"
                                                                                class="fas fa-thin fa-trash"></i>delete
                                                                        </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <p>{{ $post->content }}</p>
                                                    @if (!empty($post->image))
                                                        <div class="thumbnail"
                                                            style="width: 90%; height:500px; margin: 0 auto;">
                                                            <img src="{{ url('/public/uploads/' . $post->image) }}"
                                                                class="img" alt="" style="height:100%;">

                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="mt-4">
                                                    <h6><b>コメント ()</b></h6>
                                                    <form action="" id="form_comment" method="POST"
                                                        role="form">
                                                        @csrf
                                                        <div class="mb-9">
                                                            <input class="d-none" type="number"
                                                            value="{{ $post->id }}" name="blog_id"
                                                            id="blog_id">
                                                        <textarea name="comment_content" id="comment_content" style="height: 50px;" cols="30" rows="10"
                                                            required="Empty" placeholder="Your comment"></textarea>
                                                        
                                                        <button type="submit" id="comment_btn"
                                                            class="btn btn-dark mt-2 mb-2 float-right">提出する</button>
                                                </div>
                                                    </form>
                                                    <div class="p-3" id="comment" >
                                                        @foreach ($post->comments as $comment)
                                                            @if ($comment->reply_id == 0)
                                                            <div class="media border-bottom mb-3 d-flex flex-row" style="background-color: #dde1e1; padding: 14px 21px; border-radius: 20px; ">
                                                                <a class="flex-1 mt-3 mr-2" href="#" style="width: 56px;">
                                                                    <img class="mr-3 "
                                                                        style="width: 100%; height: 10%; border-radius: 50%"
                                                                        src="{{ url('/public/uploads/' . $comment->user->thumbnail) }}"
                                                                        alt="コメント者の名前">
                                                                    
                                                                </a>
                                                                <div class="media-body mt-3 flex-2">
                                                                    <h5 class="mt-0">
                                                                        {{ $comment->user->name }}</h5>
                                                                    <p>{{ $comment->content }}</p>
                                                                    <p><a class="btn btn-warning mt-2 text-white mb-2 btn-show-reply-form" data-id="{{$comment->id}}">返事</a></p>
                                                                    {{-- form trả lời con --}}
                                                                    <form action="" id="form_comment" method="POST"
                                                                        role="form" class="formReply form-reply-{{$comment->id}}" style="display: none;">
                                                                        @csrf
                                                                        <div class="mb-9">
                                                                            {{-- <input class="d-none" type="number"
                                                                            value="{{ $post->id }}" name="blog_id"
                                                                            id="blog_id"> --}}
                                                                        <textarea  id="content-reply-{{$comment->id}}" style="height: 50px;" cols="30" rows="10"
                                                                            required="Empty" placeholder="Your comment"></textarea>
                                                                        
                                                                        <button data-id="{{$comment->id}}" type="submit" 
                                                                            class="btn btn-dark mt-2 float-right btn-send-comment-reply">返事</button>
                                                                        </div>
                                                                    </form>
                                                                    {{-- các bình luận con --}}
                                                                    @foreach ($comment->replies as $child)
                                                                        <div class="media mb-3 d-flex" style="width: 100%;" >
                                                                            <a class=" mt-3 mr-2" href="#" style="width: 8%;">
                                                                                <img class="mr-3 "
                                                                                    style="width: 100%; height: 10%; border-radius: 50%"
                                                                                    src="{{ url('/public/uploads/' . $child->user->thumbnail) }}"
                                                                                    alt="コメント者の名前">
                                                                                
                                                                            </a>
                                                                            <div class="media-body mt-3 flex-2" style="background-color: #cdd5dc; padding: 10px 20px; border-radius: 20px;">
                                                                                <h5 class="mt-0">
                                                                                    {{ $child->user->name }}</h5>
                                                                                <p>{{ $child->content }}</p>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>    
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <aside class="sidebar static">
                                <div class="widget">
                                    <h4 class="widget-title">フォーラムの統計</h4>
                                    <ul class="forum-static">
                                        <li>
                                            <a href="#" title="">フォーラム</a>
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
                                    </ul>
                                </div>

                            </aside>
                        </div>
                    </div>
                </div>
                {{-- modal --}}
                {{-- <div class="modal fade" id="myModal" style="width: 100%;">
                    <div class="modal-dialog" style="max-width: 800px !important;">
                        <div class="modal-content">

                            <!-- Header của Modal dialog -->
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">
                                    プロファイル編集</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Body của Modal dialog -->
                            <form action="">
                                <div class="modal-body">
                                    <div class="" style="width: 200px; margin: 0 auto; border-radius: 50%; ">
                                        <img src="" alt="" id="image"
                                            style="width:200px !important; border-radius:50%; max-height: 200px">
                                        <input type="hidden" name="imgFile" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><b>タイトル</b></label>
                                        <input type="text" name="name" class="form-control input"
                                            id="name" autocomplete="off"　 placeholder="Name" value=""
                                            style="
                                            background-color: #ccc; padding: 5px 10px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone"><b>内容</b></label>
                                        <input type="text" name="phone" class="form-control input"
                                            id="name" autocomplete="off" placeholder="Phone" value=""
                                            style="
                                            background-color: #ccc; padding: 5px;">
                                    </div>
                                    <div class="form-group" id="uploadfile">
                                        <label for="fileinput"><b>画像</b></label>
                                        <input style="display: none" type="file" name="file" id="fileinput"
                                            onchange="chooseFile(this)">
                                    </div>
                                </div>

                                <!-- Footer của Modal dialog -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">近い</button>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> --}}
            </div>
        </section>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ URL::asset('/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/js/blog.js') }}"></script>

    <script>
        var _csrf = '{{ csrf_token() }}';
        let comment_url = '{{ route('blog.comment') }}';

        $('#comment_btn').click(function(event) {
            event.preventDefault();
            let content = $('#comment_content').val();
            let blog_id = $('#blog_id').val()
            
            console.log(content, comment_url);

            $.ajax({
                url: comment_url,
                type: "POST",
                data: {
                    content: content,
                    blog_id: blog_id,
                    _token: _csrf
                },
                success: function(res) {
                    if (res.error) {
                        $('#error_block').html(res.error);
                    } else {
                        $('#error_block').html('');
                        // $('#comment').html(res);
                        $('#comment_content').val('');
                        location.reload();
                    }
                }
            });
        });

    $(document).on('click', '.btn-show-reply-form', function(ev) {
        ev.preventDefault();

        var id = $(this).data('id');
        var common_reply_id = '#content-reply-' + id;
        var form_reply = '.form-reply-' + id;
        var contentReply = $(common_reply_id).val();
        
        $('.formReply').slideUp();
        $(form_reply).slideDown();

    });

    
    $(document).on('click', '.btn-send-comment-reply', function(ev) {
        ev.preventDefault();

        var id = $(this).data('id');
        var common_reply_id = '#content-reply-' + id;
        var contentReply = $(common_reply_id).val();
        var form_reply = '.form-reply-' + id;
        let blog_id = $('#blog_id').val()
        console.log('ID:', blog_id);
        $.ajax({
                url: comment_url,
                type: "POST",
                data: {
                    content: contentReply,
                    blog_id: blog_id,
                    reply_id: id,
                    _token: _csrf
                },
                success: function(res) {
                    if (res.error) {
                        $('#error_block').html(res.error);
                    } else {
                        $('#error_block').html('');
                        $('#comment').html(res);
                        $('#comment_content').val('');
                        location.reload();
                    }
                }
        });

    });

    </script>
</body>

</html>
