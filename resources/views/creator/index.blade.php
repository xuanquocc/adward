<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebarUser')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        #content {
            display: flex;
            flex-direction: column;
            height: auto;
        }

        .wrap {
            flex-direction: row;
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        @include('publicView.sidebarUser')

        <!-- Page Content  -->
        <div id="content" class=" pt-5 pl-5 pb-5 mr-5">
            <section class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-4 mb-sm-5">
                            <div class="card mt-3 card-style1 border-0">
                                <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            @if ($creator->thumbnail == null)
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                    alt="...">
                                            @else
                                                <img src="{{ url('/public/uploads/' . $creator->thumbnail) }}"
                                                    alt="{{ $creator->thumbnail }}"
                                                    style="width: 507px; height: 315px;">
                                            @endif

                                        </div>
                                        <div class="col-lg-6 px-xl-10">
                                            <div
                                                class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                                <h3 class="h2 text-white mb-0">{{ $creatorDetail->name }}</h3>
                                                <span class="text-primary">Coach</span>
                                            </div>
                                            <ul class="list-unstyled mb-1-9">
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">電話:</span>
                                                    {{ $creatorDetail->phone }}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">経験:</span>
                                                    {{ $creatorDetail->experience }}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">メール:</span>
                                                    {{ $creatorDetail->email }}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">専門:</span>
                                                    {{ $creatorDetail->major }}</li>

                                            </ul>
                                            <form action="{{ route('creator.profile') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">
                                                    編集
                                                </button>
                                                {{-- modal --}}
                                                <div class="modal fade" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Header của Modal dialog -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title font-weight-bold">プロファイル編集</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Body của Modal dialog -->
                                                            <div class="modal-body">
                                                                <div class=""
                                                                    style="width: 200px; margin: 0 auto; border-radius: 50%; ">
                                                                    <img src="{{ url('/public/uploads/' . $creator->thumbnail) }}"
                                                                        alt="{{ $creator->thumbnail }}" id="image"
                                                                        style="width:200px !important; border-radius:50%; max-height: 200px">
                                                                    <input type="hidden" name="imgFile"
                                                                        value="{{ $creator->thumbnail }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">名前</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Name"
                                                                        value="{{ $creatorDetail->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone">電話</label>
                                                                    <input type="text" name="phone"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Phone"
                                                                        value="{{ $creatorDetail->phone }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="experience">経験</label>
                                                                    <input type="text" name="experience"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Experience"
                                                                        value="{{ $creatorDetail->experience }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="major">専門</label>
                                                                    <input type="text" name="major"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Major"
                                                                        value="{{ $creatorDetail->major }}">
                                                                </div>
                                                                <div class="form-group" id="uploadfile">
                                                                    <label for="fileinput">画像</label>
                                                                    <input style="display: none" type="file"
                                                                        name="file" id="fileinput"
                                                                        onchange="chooseFile(this)">
                                                                </div>
                                                            </div>

                                                            <!-- Footer của Modal dialog -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">近い</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">保存</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 style="font-weight: 700;">プロジェクト</h3>
                <div class="d-flex flex-wrap" style="d-flex flex-wrap">
                    @foreach ($projectName as $item)
                        <div class="row">
                            <div class="col-4">
                                <div class="ag-format-container" style="width: 351px">
                                    <div class="ag-courses_box">
                                        <div class="ag-courses_item">
                                            <a href="{{ route('getevent', [$item->id, Auth::user()->id]) }}"
                                                class="ag-courses-item_link">
                                                <div class="ag-courses-item_bg"></div>
                                                <div class="ag-courses-item_title">
                                                    {{ $item->name }}
                                                </div>
                                                <div class="ag-courses-item_date-box">
                                                    始める:
                                                    <span class="ag-courses-item_date">
                                                        {{ \Carbon\Carbon::parse($item->start)->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                                <div class="ag-courses-item_date-box">
                                                    締め切り:
                                                    <span class="ag-courses-item_date">
                                                        {{ \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') }}
                                                    </span>
                                                </div>
                                                <div class="ag-courses-item_date-box">
                                                    合計時間:
                                                    <span class="ag-courses-item_date">
                                                        {{ $item->total_hours_creator }}
                                                    </span>
                                                </div>
                                            </a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function chooseFile(fileInput) {
            var img = document.getElementById('image');
            if (fileInput.files && fileInput.files[0]) {

                img.style = 'width: 200px !important';
                // img.style = 'border-radius: 50%';
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>

</body>

</html>
