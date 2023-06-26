<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebar')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{asset('css/projectDetail.css')}}">
</head>

<body>

    <div style="display: flex; flex-direction:row">

        @include('publicView.sidebar')

        <div class="content-wrapper flex-grow-1" style="margin:0 !important;">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-4 col-6 ml-4">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h2><span>{{ $projectName }}</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 ml-4">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h2>{{ $creators_info[0]->total_hours }}H </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6 ml-4 wrapsearch">
                        <form action="{{ route('customer.project.search', $projectId) }}" method="POST" style="display: flex;">
                            @csrf
                            <input type="date" name="date" id="date" class="searchTerm">
                            <button type="submit" id="search-button" class="searchButton"><i
                                    class="fa fa-search"></i></button>
                        </form>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 ml-4">
                        @foreach ($creators_info as $item)
                            <div class="card card-body mt-3">
                                <div
                                    class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                    <div class="mr-2 mb-3 mb-lg-0">
                                        <img src="{{ url('/public/uploads/' . $item->thumbnail) }}" width="150"
                                            height="150" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-title font-weight-semibold">
                                            <p href="#" data-abc="true">{{ $item->name }}</p>
                                        </h6>
                                        <div style="display:flex; flex-direction: row;">
                                            <label for="">電話番号: </label>
                                            <p class="mb-3">
                                                {{ $item->phone }}
                                            </p>
                                        </div>
                                        <div style="display:flex; flex-direction: row;">
                                            <label for="">Eメール: </label>
                                            <p class="mb-3">
                                                {{ $item->email }}
                                            </p>
                                        </div>
                                        <div style="display:flex; flex-direction: row;">
                                            <label for="">経験: </label>
                                            <p class="mb-3">
                                                {{ $item->experience }}
                                            </p>
                                        </div>
                                        <div style="display:flex; flex-direction: row;">
                                            <label for="">専門: </label>
                                            <p class="mb-3">
                                                {{ $item->major }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                        <h3 class="mb-0 font-weight-semibold">{{ $item->total_hours_creator }}h</h3>
                                        <form
                                            action="{{ route('getEventCustomer', [$projectId, $item->main_id]) }}">
                                            <button type="submit" class="btn btn-warning mt-4 text-white"><i
                                                    class="icon-cart-add mr-2"></i> 詳細</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ml-4">
                        <div id="pagination">
                            {{ $creators_info->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>

</html>
