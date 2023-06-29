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

   
</head>

<body>

    <div style="display: flex; flex-direction:row; height: auto;">

        @include('publicView.sidebar')

        <div class="bg-light p-4 flex-grow-1" style="height: 100vh;">
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
                                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                        <div class="d-flex flex-column mt-4">
                                            <form action="{{ route('admin.creator.project', $item->main_id) }}">
                                                <button class="btn btn-outline-primary btn-sm mt-2" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                    data-id="{{ $item->main_id }}">
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
                
                {{ $creators->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" style="margin-right:160px;">
            <div class="modal-content" style="min-width:1000px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">プロジェクトの一覧表示
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover text-nowrap table-striped" id="projectTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>クリエイター</th>
                                <th>から始まる</th>
                                <th>締め切り</th>
                                <th>合計時間</th>
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
                    table.find('tbody').empty();

                    // Thêm dữ liệu mới vào bảng
                    response.forEach(function(project) {
                        console.log(project);
                        var row = $('<tr></tr>');

                        // Tạo các cột dữ liệu cho từng dự án
                        var idCell = $('<td></td>').text(project.id);
                        var nameCell = $('<td></td>').text(project.name);
                        var customerCell = $('<td></td>').text(project.customer);
                        var startDate = new Date(project.start);
                        var formattedStartDate = startDate.toLocaleDateString('ja-JP');
                        var startCell = $('<td></td>').text(formattedStartDate);

                        var deadlineDate = new Date(project.deadline);
                        var formattedDeadlineDate = deadlineDate.toLocaleDateString('ja-JP');
                        var deadlineCell = $('<td></td>').text(formattedDeadlineDate);

                        var actionCell = $('<td></td>').html(project.total_hours);
                        var detailHoursCell = $('<td></td>');
                        var form = $('<form></form>').attr('action',
                            '{{ route('getEventCustomer', [':projectId', ':creatorId']) }}'
                        );
                        form.attr('method', 'GET'); // Thêm phương thức GET cho form
                        var projectIdInput = $('<input>').attr('type', 'hidden').attr('name',
                            'projectId').val(project.id);
                        var creatorIdInput = $('<input>').attr('type', 'hidden').attr('name',
                            'creatorId').val(project.creator_id);
                        var submitButton = $('<button></button>').attr('type', 'submit').text(
                            '詳細');

                        form.append(projectIdInput, creatorIdInput, submitButton);
                        detailHoursCell.append(form);

                        // Thay thế các giá trị ":projectId" và ":creatorId" bằng giá trị thực tế
                        form.attr('action', form.attr('action').replace(':projectId', project
                            .id).replace(':creatorId', project.creator_id));

                        row.append(idCell, nameCell, customerCell, startCell, deadlineCell,
                            actionCell, detailHoursCell);

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
