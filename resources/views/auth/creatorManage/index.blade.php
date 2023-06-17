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

    <style>
        .wrap {
            height: 100vh;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }

        .modal-content {
            min-width: 1100px;
            /* Adjust the value as needed */
            margin-right: 100px;
            /* Center the modal content horizontally */
        }

        @media (min-width: 576px) {
            .modal-dialog{
                max-width: 1100px !important;
                margin: 1.75rem auto;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex wrap">
        @include('publicView.sidebar')

        <!-- Page Content  -->
        <div class="bg-light p-4 flex-grow-1 ">
            @foreach ($creators as $item)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                        <div class="card shadow-0 border rounded-3">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <img src="{{ url('/public/uploads/' . $item->thumbnail) }}" class="w-100"
                                                style="max-height: 179.312px" />
                                            <a href="#!">
                                                <div class="hover-overlay">
                                                    <div class="mask"
                                                        style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <h2><b>{{ $item->name }}</b></h2>
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


                                            <button class="btn btn-outline-primary btn-sm mt-2" type="submit">
                                                Assign
                                            </button>

                                        </div>
                                        <div class="d-flex flex-column mt-4">


                                            <form action="{{ route('admin.creator.project', $item->main_id) }}">
                                                <button class="btn btn-outline-primary btn-sm mt-2" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                    data-id="{{ $item->main_id }}">
                                                    Assign
                                                </button>
                                            </form>


                                        </div>
                                        {{-- Modal --}}



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $creators->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>

    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">List Project
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover text-nowrap table-striped" id="projectTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Customer</th>
                                <th>Start</th>
                                <th>Deadline</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $('#staticBackdrop').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Lấy button đã nhấp để mở modal
            var id = button.data('id'); // Lấy giá trị của thuộc tính data-id

            var modal = $(this);
            var table = modal.find('#projectTable');

            // Gửi yêu cầu Ajax để tải dữ liệu từ máy chủ
            $.ajax({
                url: "{{ route('admin.creator.project', '') }}" + '/' +
                    id, // Đường dẫn tới endpoint xử lý yêu cầu
                type: 'GET',
                data: {
                    id: id
                }, // Gửi ID dưới dạng tham số

                success: function(response) {
                    // Xóa các hàng dữ liệu hiện có trong bảng
                    console.log(response);
                    table.find('tbody').empty();

                    // Thêm dữ liệu mới vào bảng
                    response.forEach(function(project) {
                        var row = $('<tr></tr>');

                        // Tạo các cột dữ liệu cho từng dự án
                        var idCell = $('<td></td>').text(project.id);
                        var nameCell = $('<td></td>').text(project.name);
                        var customerCell = $('<td></td>').text(project.customer);
                        var startCell = $('<td></td>').text(project.start);
                        var deadlineCell = $('<td></td>').text(project.deadline);
                        var actionCell = $('<td></td>').html(project.total_hours);  

                        // Thêm các cột vào hàng
                        row.append(idCell, nameCell, customerCell, startCell, deadlineCell,
                            actionCell);

                        // Thêm hàng vào tbody của bảng
                        table.find('tbody').append(row);
                    });
                },
                error: function(error) {
                    console.log(error)
                },
            });
        });
    </script>

</body>

</html>
