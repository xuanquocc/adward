<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('library.sidebarUser')
    <link rel="stylesheet" href="{{ asset('css/dashboardCreator.css') }}">
    <style>
        .wrap{
            height: 100vh;
            flex-direction: row;
            width: 100%;
        }
        .pagination{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>

    <div class="d-flex wrap">
        @include('publicView.sidebarUser')

        <!-- Page Content  -->
        <div class="bg-light p-4 flex-grow-1 ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名前</th>
                                        <th>から始まる</th>
                                        <th>締め切り</th>
                                        <th>時間</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project as $item)
                                        <tr class="tr_info">
                                            <td class="td_info">{{ $item->id }}</td>
                                            <td class="td_info">
                                                <P>{{ $item->name }}</P>
                                            </td>
                                            <td class="td_info">
                                                <p>{{ $item->start }}</p>
                                            </td>
                                            <td class="td_info">
                                                <p>{{ $item->deadline }}</p>
                                            </td>
                                            
                                            <td class="td_info">
                                                <p>{{ $item->total_hours }}H</p>
                                            </td>

                                            <td class="td-control">
                                                <div class="action" style="display:flex; flex-direction:row;">
                                                    <form action="" class="form-action">
                                                        <button type="submit" class="btn btn-custom"><i
                                                                class="fas fa-duotone fa-pen"
                                                                style="--fa-primary-color: #7f90ad; --fa-secondary-color: #195fd7;"></i></button>
                                                    </form>
                                                    
                                                    <form action="{{route('customer.project.detail',$item->id)}}" method="get" class="form-action">
                                                        <button type="submit" class="btn btn-primary">詳細</button>
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
</body>

</html>
