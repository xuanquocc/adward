<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebarUser')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        @include('publicView.sidebarUser')

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <section class="bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-4 mb-sm-5">
                            <div class="card card-style1 border-0">
                                <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            @if ($creator->thumbnail ==null){
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                alt="...">
                                            }
                                            @else {
                                                <img src="{{ url('/public/uploads/' . $creator->thumbnail) }}"
                                                                        alt="{{ $creator->thumbnail }}" style="width: 507px; height: 315px;"  >
                                            }   
                                            @endif

                                        </div>
                                        <div class="col-lg-6 px-xl-10">
                                            <div
                                                class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                                <h3 class="h2 text-white mb-0">{{$creatorDetail->name}}</h3>
                                                <span class="text-primary">Coach</span>
                                            </div>
                                            <ul class="list-unstyled mb-1-9">
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">Phone:</span>
                                                    {{$creatorDetail->phone}}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">Experience:</span>
                                                        {{$creatorDetail->experience}}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                                                        {{$creatorDetail->email}}</li>
                                                <li class="mb-2 mb-xl-3 display-28"><span
                                                        class="display-26 text-secondary me-2 font-weight-600">Language:</span>
                                                        {{$creatorDetail->major}}</li>
                                                
                                            </ul>
                                            <form action="{{ route('creator.profile')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#myModal">
                                                    edit
                                                </button>
                                                {{-- modal --}}
                                                <div class="modal fade" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Header của Modal dialog -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Profile</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Body của Modal dialog -->
                                                            <div class="modal-body">
                                                                <div class="" style="width: 200px; margin: 0 auto; border-radius: 50%; " >
                                                                    <img src="{{ url('/public/uploads/' . $creator->thumbnail) }}"
                                                                        alt="{{ $creator->thumbnail }}"  id="image" style="width:200px !important; border-radius:50%;">
                                                                        <input type="hidden" name="imgFile" value="{{ $creator->thumbnail }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Name" value="{{$creatorDetail->name}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="phone">Phone</label>
                                                                    <input type="text" name="phone"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Phone" value="{{$creatorDetail->phone}}"> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="experience">Exeperience</label>
                                                                    <input type="text" name="experience"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Experience" value="{{$creatorDetail->experience}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="major">Major</label>
                                                                    <input type="text" name="major"
                                                                        class="form-control" id="name"
                                                                        autocomplete="off" placeholder="Major" value="{{$creatorDetail->major}}">
                                                                </div>
                                                                <div class="form-group" id="uploadfile">
                                                                    <label for="fileinput">Hình ảnh</label>
                                                                    <input style="display: none" type="file"
                                                                        name="file" id="fileinput"
                                                                        onchange="chooseFile(this)">
                                                                </div>
                                                            </div>

                                                            <!-- Footer của Modal dialog -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Đóng</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Lưu</button>
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
                        <div class="col-lg-12 mb-4 mb-sm-5">
                            <div>
                                <span class="section-title text-primary mb-3 mb-sm-4">About Me</span>
                                <p>Edith is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                    been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <p class="mb-0">It is a long established fact that a reader will be distracted by the
                                    readable content of a page when looking at its layout. The point of using Lorem
                                    Ipsum is that it has a more-or-less normal distribution of letters, as opposed.</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 mb-4 mb-sm-5">
                                    <div class="mb-4 mb-sm-5">
                                        <span class="section-title text-primary mb-3 mb-sm-4">Skill</span>
                                        <div class="progress-text">
                                            <div class="row">
                                                <div class="col-6">Driving range</div>
                                                <div class="col-6 text-end">80%</div>
                                            </div>
                                        </div>
                                        <div class="custom-progress progress progress-medium mb-3"
                                            style="height: 4px;">
                                            <div class="animated custom-bar progress-bar slideInLeft bg-secondary"
                                                style="width:80%" aria-valuemax="100" aria-valuemin="0"
                                                aria-valuenow="10" role="progressbar"></div>
                                        </div>
                                        <div class="progress-text">
                                            <div class="row">
                                                <div class="col-6">Short Game</div>
                                                <div class="col-6 text-end">90%</div>
                                            </div>
                                        </div>
                                        <div class="custom-progress progress progress-medium mb-3"
                                            style="height: 4px;">
                                            <div class="animated custom-bar progress-bar slideInLeft bg-secondary"
                                                style="width:90%" aria-valuemax="100" aria-valuemin="0"
                                                aria-valuenow="70" role="progressbar"></div>
                                        </div>
                                        <div class="progress-text">
                                            <div class="row">
                                                <div class="col-6">Side Bets</div>
                                                <div class="col-6 text-end">50%</div>
                                            </div>
                                        </div>
                                        <div class="custom-progress progress progress-medium mb-3"
                                            style="height: 4px;">
                                            <div class="animated custom-bar progress-bar slideInLeft bg-secondary"
                                                style="width:50%" aria-valuemax="100" aria-valuemin="0"
                                                aria-valuenow="70" role="progressbar"></div>
                                        </div>
                                        <div class="progress-text">
                                            <div class="row">
                                                <div class="col-6">Putting</div>
                                                <div class="col-6 text-end">60%</div>
                                            </div>
                                        </div>
                                        <div class="custom-progress progress progress-medium" style="height: 4px;">
                                            <div class="animated custom-bar progress-bar slideInLeft bg-secondary"
                                                style="width:60%" aria-valuemax="100" aria-valuemin="0"
                                                aria-valuenow="70" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="section-title text-primary mb-3 mb-sm-4">Education</span>
                                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                            their default model text, and a search for 'lorem ipsum' will uncover many
                                            web sites still in their infancy.</p>
                                        <p class="mb-1-9">There are many variations of passages of Lorem Ipsum
                                            available, but the majority have suffered alteration in some form, by
                                            injected humour.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

        </div>
    </div>
    </div>
</body>

</html>
