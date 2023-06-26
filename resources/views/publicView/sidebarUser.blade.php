<nav id="sidebar">
    <div class="p-4 pt-5">
        @if (Auth::user()->thumbnail != null)
        <img src="{{ url('/public/uploads/' .Auth::user()->thumbnail) }}" style="width:200px; height:200px; border-radius:50%;" alt="">
        @else
        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" style="width:200px; height:200px; border-radius:50%;">
        @endif
        <h2 style="color: aliceblue;">{{ Auth::user()->name }}</h2>
        <ul class="list-unstyled components mb-5">
            <li >
                @if (Auth::user()->type == 'user')
                    <a href="{{route('customer.home')}}" style="text-decoration: none;">ホームページ</a>
                @else
                <a href="{{route('creator.home')}}" style="text-decoration: none;">ホームページ</a>
                @endif
            </li>
            
            <li>
                <a href="{{ route('admin.users.logout') }}" style="text-decoration: none;" >ログアウト</a>
            </li>
        </ul>



    </div>
</nav>