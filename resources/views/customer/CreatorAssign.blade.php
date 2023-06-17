<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebarUser')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
        body {
            margin: 0;
            font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5385;
            color: #333;
            text-align: left;
            background-color: #f5f5f5;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }


        .bg-teal-400 {
            background-color: #26a69a;
        }

        a {
            text-decoration: none !important;
        }


        .fa {
            color: red;
        }

        .wrap {
            height: 100vh;
        }

        .contentwraper {
            width: 60%;
        }

        .Toast {
            border-radius: 10px;
            padding: 18px;
        }

        .hours {
            width: 112px;
            padding: 7px 4px;
            border-radius: 20px;
            background-color: #d7d7a0;
        }

        .wrap-content:hover{
            background-color: rgb(109, 99, 88);
            color: aliceblue;
            cursor: pointer;
            transition: 0.2s linear 0.2s;
        }

        .btn-custom{
            background-color: #607bdf;
            width: 112px;
            padding: 12px 4px;
            border-radius: 20px;
        }
        .btn-custom:hover{
            opacity:0.6;
        }
    </style>
</head>

<body>

    <div class="d-flex wrap">
        @include('publicView.sidebarUser')

        <!-- Page Content  -->
        <div class="contentwraper  mt-50 mb-50">
            <div class="row">
                
                <div class="col-lg-4 col-6 ml-4">
                    <!-- small box -->
                    <div class="Toast bg-success">
                        <div class="inner">
                            <h2><span>{{ $projectName }}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6 ml-4">
                    <!-- small box -->
                    <div class="Toast bg-danger">
                        <div class="inner">
                            <h2>{{ $creatorsInfo[0]->total_hours }}H </h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6 ml-4">
                    <form action="{{route('customer.project.search',$projectId)}}" method="POST">
                        @csrf
                        <input type="date" name="date" id="date">
                        <button type="submit" id="search-button">Search</button>
                    </form>
                </div>

            </div>
            <div class="row">

                <div class="col-md-12 ml-4">
                    @foreach ($creatorsInfo as $item)
                        <div class="card card-body mt-3 wrap-content">
                            <div
                                class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0">

                                    <img src="{{ url('/public/uploads/' . $item->thumbnail) }}" width="150"
                                        height="150" alt="">

                                </div>

                                <div class="media-body">
                                    <h4 class="media-title font-weight-semibold font-bold">
                                        <p href="#" data-abc="true">{{ $item->name }}</p>
                                    </h4>



                                    <div style="display:flex; flex-direction: row;">
                                        <h6 for="">Số điện thoại: </h6>
                                        <p class="mb-3">
                                            {{ $item->phone }}
                                        </p>
                                    </div>

                                    <div style="display:flex; flex-direction: row;">
                                        <h6 for="">Email: </h6>
                                        <p class="mb-3">
                                            {{ $item->email }}
                                        </p>
                                    </div>

                                    <div style="display:flex; flex-direction: row;">
                                        <h6 for="">Experience: </h6>
                                        <p class="mb-3">
                                            {{ $item->experience }}
                                        </p>
                                    </div>

                                    <div style="display:flex; flex-direction: row;">
                                        <h6 for="">Major: </h6>
                                        <p class="mb-3">
                                            {{ $item->major }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                   
                                    <div class="hours">
                                        <h3 class="mb-0 font-weight-semibold">{{ $item->total_hours_creator }}h</h3>
                                    </div>

                                    <form action="{{ route('getevent', [$projectId, $item->main_id]) }}">
                                    <button type="submit" class="btn btn-custom  mt-4 text-white"><i
                                        class="icon-cart-add mr-2"></i> show detail</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
   
</body>

</html>
