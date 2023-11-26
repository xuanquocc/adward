<!doctype html>
<html lang="en">

<head>
    <title>割当</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebar')

</head>

<body>
    <div style="display: flex; flex-direction:row">

        @include('publicView.sidebar')

        <div class="content-wrapper flex-grow-1" style="margin:0 !important;">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="bg-light p-4 flex-grow-1 ">

                            @if ($creator[0] == null)

                                <div class="w-99 d-flex justify-content-center align-items-center" style="background-color:red; height: 40px; color:white;">割り当てる人がいない</div>
                            @else
                                @foreach ($creator as $item)
                                    <div class="row justify-content-center mb-3">
                                        <div class="col-md-12 col-xl-10">
                                            <div class="card shadow-0 border rounded-3">

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                            <div
                                                                class="bg-image hover-zoom ripple rounded ripple-surface">
                                                                @if ($item->thumbnail == null)
                                                                    <img src="{{url('/images/user.jpg')}}" alt="" class="w-100" style="max-height: 179.312px">
                                                                @else
                                                                <img src="{{ url('/public/uploads/' . $item->thumbnail) }}"
                                                                class="w-100" style="max-height: 179.312px" />
                                                                @endif
                                                                <a href="#!">
                                                                    <div class="hover-overlay">
                                                                        <div class="mask"
                                                                            style="background-color: rgba(253, 253, 253, 0.15);">
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                            <h3>{{ $item->name }}</h3>
                                                            <div style="display: flex; flex-direction:row;">
                                                                <label for="">Eメール: </label>
                                                                <p class="text-truncate mb-4 mb-md-0">
                                                                    {{ $item->email }}
                                                                </p>
                                                            </div>

                                                            <div style="display: flex; flex-direction:row;">
                                                                <label for="">電話番号:
                                                                </label>
                                                                <p class="text-truncate mb-4 mb-md-0">
                                                                    {{ $item->phone }}
                                                                </p>
                                                            </div>
                                                            <div style="display: flex; flex-direction:row;">
                                                                <label for="">経験:
                                                                </label>
                                                                <p class="text-truncate mb-4 mb-md-0">
                                                                    {{ $item->experience }}
                                                                </p>
                                                            </div>
                                                            <div style="display: flex; flex-direction:row;">
                                                                <label for="">専門: </label>
                                                                <p class="text-truncate mb-4 mb-md-0">
                                                                    {{ $item->major }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                        <div
                                                            class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                            <div class="d-flex flex-column mt-4">
                                                                <form
                                                                    action="{{ route('admin.project.assign.store', [$projectId, $item->main_id]) }}"
                                                                    method="POST">
                                                                    @csrf

                                                                    <button class="btn btn-outline-primary btn-sm mt-2"
                                                                        type="submit">
                                                                        割当
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
                    <!-- /.row -->
                    <!-- Main row -->

                    <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
    </div>

</body>

</html>
