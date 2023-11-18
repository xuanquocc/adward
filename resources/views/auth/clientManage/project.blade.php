<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">
    <title>プロジェクト</title>
</head>

<body>
    <div style="display: flex; flex-direction:row">

        @include('publicView.sidebar')

        <div class="content-wrapper flex-grow-1 mt-2" style="margin:0 !important;">

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default" id="searchBtn">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="" id="customerId" value="{{ $customer_id }}">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <table class="table table-hover text-nowrap" id="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>名前</th>
                                                <th>お客様</th>
                                                <th>から始まる</th>
                                                <th>締め切り</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                                <tr class="tr_info">
                                                    <td class="td_info">{{ $project->id }}</td>
                                                    <td class="td_info">
                                                        <P>{{ $project->name }}</P>
                                                    </td>
                                                    <td class="td_info">
                                                        <p>{{ $project->customer }}</p>
                                                    </td>
                                                    <td class="td_info">
                                                        <p>{{ \Carbon\Carbon::parse($project->start)->format('d/m/Y') }}
                                                        </p>
                                                    </td>
                                                    <td class="td_info">
                                                        <p>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                                                        </p>
                                                    </td>

                                                    <td class="td-control">
                                                        <div class="action" style="display:flex; flex-direction:row;">
                                                            <form
                                                                action="{{ route('admin.expiredProject', $project->id) }}"
                                                                method="post" class="form-action">
                                                                @method('PUT')
                                                                @csrf
                                                                @if ($project->expired == 1)
                                                                    <button type="submit"
                                                                        class="btn btn-success mr-3 text-white"><i
                                                                            class="icon-cart-add mr-2"></i>まだ有効</button>
                                                                @else
                                                                    <button type="submit"
                                                                        class="btn btn-danger mr-3 text-white"><i
                                                                            class="icon-cart-add mr-2"></i>期限切れ</button>
                                                                @endif
                                                            </form>
                                                            @if ($project->expired == 1)
                                                                <form
                                                                    action="{{ route('admin.creator.project.detail', $project->id) }}"
                                                                    method="get" class="form-action">

                                                                    <button type="submit"
                                                                        class="btn btn-warning mr-3 text-white"><i
                                                                            class="icon-cart-add mr-2"></i>詳細</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('admin.project.assign', [$project->id, $customer_id]) }}"
                                                                    method="get" class="form-action">

                                                                    <button type="submit"
                                                                        class="btn btn-primary">割当</button>
                                                                </form>
                                                            @endif
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Bắt sự kiện khi người dùng nhấn nút tìm kiếm
            $('#searchBtn').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit

                var searchValue = $('input[name="table_search"]').val(); // Lấy giá trị từ ô input tìm kiếm

                // Gửi yêu cầu Ajax để tìm kiếm
                $.ajax({
                    url: "{{ route('searchProject') }}", // Đường dẫn tới URL xử lý tìm kiếm
                    method: 'GET',
                    data: {
                        search: searchValue // Truyền giá trị tìm kiếm lên server
                    },
                    success: function(response) {
                        console.log(response);
                        var customerId = $('#customerId').val();
                        $('#table tbody').empty();
                        var row = $('<tr></tr>');
                        var idCell = $('<td></td>').text(response[0].id);
                        var nameCell = $('<td></td>').text(response[0].name);
                        var customerCell = $('<td></td>').text(response[0].customer);

                        var startDate = new Date(response[0].start);
                        var formattedStartDate = startDate.toLocaleDateString('ja-JP');
                        var startCell = $('<td></td>').text(formattedStartDate);

                        var deadlineDate = new Date(response[0].deadline);
                        var formattedDeadlineDate = deadlineDate.toLocaleDateString('ja-JP');
                        var deadlineCell = $('<td ></td>').text(formattedDeadlineDate);


                        var actionCell = $(
                            '<td style="display:flex; flex-direction:row;"></td>');
                        var formDetail = $('<form ></form>').attr('action',
                            '{{ route('admin.creator.project.detail', ':projectId') }}'
                        );
                        var formAssign = $('<form></form>').attr('action',
                            '{{ route('admin.project.assign', [':projectId', ':customerId']) }}'
                        );
                        var projectIdInput = $('<input>').attr('type', 'hidden').attr('name',
                            'projectId').val(response[0].id);

                        var customerIdInput = $('<input>').attr('type', 'hidden').attr('name',
                            'customerId').val(customerId);

                        var submitButton = $(
                                '<button class="btn btn-primary  text-white mr-2"></button>')
                            .attr(
                                'type', 'submit').text(
                                '詳細');
                        var assignButton = $(
                            '<button class="btn btn-warning  text-white"></button>').attr(
                            'type', 'submit').text(
                            '割当');
                        formDetail.append(projectIdInput, submitButton);
                        formAssign.append(projectIdInput, customerIdInput, assignButton)
                        actionCell.append(formDetail, formAssign);

                        formAssign.attr('action', formAssign.attr('action').replace(
                            ':projectId',
                            response[0].id).replace(':customerId', customerId));
                        formDetail.attr('action', formDetail.attr('action').replace(
                            ':projectId',
                            response[0].id));

                        row.append(idCell, nameCell, customerCell, startCell, deadlineCell,
                            actionCell);

                        $('#table tbody').append(row);
                    },
                    error: function(xhr) {
                        // Xử lý lỗi nếu có
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
