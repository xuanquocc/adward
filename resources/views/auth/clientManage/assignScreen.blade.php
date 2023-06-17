<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebar')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <style>
        .wrap{
            height: 100vh;
        }
        .pagination{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="d-flex wrap">
        @include('publicView.sidebar')

        <!-- Page Content  -->
        <div class="bg-light p-4 flex-grow-1 ">

            @if ($creator[0] == null)

                <div>NO else to assign</div>
            @else
                @foreach ($creator as $item)
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <div class="card shadow-0 border rounded-3">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                <img src="{{ url('/public/uploads/' . $item->thumbnail) }}"
                                                    class="w-100" style="max-height: 179.312px" />
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask"
                                                            style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <h3>{{ $item->name }}</h3>
                                            <div style="display: flex; flex-direction:row;">
                                                <label for="">Email: </label>
                                                <p class="text-truncate mb-4 mb-md-0">
                                                    {{ $item->email }}
                                                </p>
                                            </div>
                                            
                                            <div style="display: flex; flex-direction:row;">
                                                <label for="">Phone:
                                                </label>
                                                <p class="text-truncate mb-4 mb-md-0">
                                                    {{ $item->phone }}
                                                </p>
                                            </div>
                                            <div style="display: flex; flex-direction:row;">
                                                <label for="">Experience:
                                                </label>
                                                <p class="text-truncate mb-4 mb-md-0">
                                                    {{ $item->experience }}
                                                </p>
                                            </div>
                                            <div style="display: flex; flex-direction:row;">
                                                <label for="">Major: </label>
                                                <p class="text-truncate mb-4 mb-md-0">
                                                    {{ $item->major }}
                                                </p>
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                            <div class="d-flex flex-column mt-4">
                                                <form
                                                    action="{{ route('admin.project.assign.store', [$projectId, $item->main_id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    
                                                    <button class="btn btn-outline-primary btn-sm mt-2" type="submit">
                                                        Assign
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{ $creator->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
    </div>
</body>

</html>
