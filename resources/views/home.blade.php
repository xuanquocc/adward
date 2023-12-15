<link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">
<div style="display: flex; flex-direction:row">

    @include('publicView.sidebar')

    <div class="content-wrapper flex-grow-1 mt-6" style="margin:0 !important;">
        <section class="content " style="margin-top:20px;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">

                                <p>顧客管理</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.customer') }}" class="small-box-footer">より詳しい情報 <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">

                                <p>クリエイターマネージャー</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.creator') }}" class="small-box-footer">より詳しい情報 <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row blog-noti p-2">
                    @include('auth.alert')
                    <div class="col-12">
                        @foreach ($data_blogs as $blog)
                            @if ($blog->status == 0)
                            <div class=" blog">
                                <div class="col-12 blog-content">
                                   <div class="content">
                                        @foreach ($data_creator as $creator)
                                            @if ($creator->id == $blog->creator_id)
                                                <div class="ava">
                                                    <img src="{{ url('/public/uploads/' . $creator->thumbnail) }}"  style="width:100%; border-radius: 50%; " {{$creator->thumbnail}}">
                                                    <b>{{ $creator->name }}</b>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="title-blogs mt-2"><b>{{$blog->title}}</b></div>
                                   </div>
                                    <div class="blog-action">
                                        <form action="{{ route('admin.accept',$blog->id)}}" method="POST">
                                            @csrf
                                            <button type="submit">Accept</button>
                                        </form>
                                        <form action="{{ route('admin.reject',$blog->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Reject</button>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

        </section>

        
    </div>

</div>

</div>



</div>
