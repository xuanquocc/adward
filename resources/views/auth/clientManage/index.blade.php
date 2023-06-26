<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">
    <title>Home</title>
    @include('library.Style')
</head>

<body>
    <div style="display: flex; flex-direction: row;">
        @include('publicView.sidebar')
        <div class="content-wrapper flex-grow-1" style="margin:0 !important;">
            <div class="content mt-4">
                <div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i
                                        class="fas fa-solid fa-user"></i></span>

                                <div class="info-box-content">
                                    <a href="{{ route('admin.customer.create') }}">クライアントを作成する</a>
                                    <span class="info-box-number">
                                        10
                                        <small>%</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fas fa-duotone fa-book"></i></span>

                                <div class="info-box-content">
                                    <a href="{{ route('admin.project.create') }}">プロジェクトを作成する</a>
                                    <span class="info-box-number">
                                        10
                                        <small>%</small>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>

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
                                                <th>位置</th>
                                                <th>Eメール</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $customer)
                                                <tr class="tr_info">
                                                    <td class="td_info">{{ $customer->id }}</td>
                                                    <td class="td_info">
                                                        <p>{{ $customer->name }}</p>
                                                    </td>
                                                    <td class="td_info">
                                                        <p>{{ $customer->location }}</p>
                                                    </td>
                                                    <td class="td_info">
                                                        <p>{{ $customer->email }}</p>
                                                    </td>
                                                    <td class="td-control"
                                                        style="display: flex;justify-content:center; align-items:center;">
                                                        <div class="action">
                                                            <form
                                                                action="{{ route('admin.project', $customer->id) }}">
                                                                <button type="submit"
                                                                    class="btn btn-warning  text-white"><i
                                                                        class="icon-cart-add mr-2"></i> 詳細</button>
                                                            </form>
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
                </div>
            </div>
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
                    url: "{{ route('searchTable') }}", // Đường dẫn tới URL xử lý tìm kiếm
                    method: 'GET',
                    data: {
                        search: searchValue // Truyền giá trị tìm kiếm lên server
                    },
                    success: function(response) {
                        console.log(response[0].location);
                        $('#table tbody').empty();
                        var row = $('<tr></tr>');
                        var idCell = $('<td></td>').text(response[0].id);
                        var nameCell = $('<td></td>').text(response[0].name);
                        var locationCell = $('<td></td>').text(response[0].location);
                        var emailCell = $('<td></td>').text(response[0].email);
                        var actionCell = $('<td></td>');
                        var form = $('<form></form>').attr('action',
                            '{{ route('admin.project', ':customerId') }}'
                        );
                        var customerIdInput = $('<input>').attr('type', 'hidden').attr('name',
                            'projectId').val(response[0].id);
                        var submitButton = $('<button class="btn btn-warning  text-white"></button>').attr('type', 'submit').text(
                            '詳細');
                        form.append(customerIdInput, submitButton);

                        actionCell.append(form);

                        form.attr('action', form.attr('action').replace(':customerId', response[0].id));

                        row.append(idCell, nameCell, locationCell, emailCell, actionCell);

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
