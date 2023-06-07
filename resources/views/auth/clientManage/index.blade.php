<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <title>Document</title>
    @include('library.Style')
</head>

<body>
    <div>
        @include('publicView.sidebar')
        <div class="content-wrapper">
            <div class="content">
                <div>
                    <a href="{{ route('admin.customer.create') }}">tạo client</a>
                </div>
                <div>
                    <a href="{{ route('admin.project.create') }}">tạo project</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Responsive Hover Table</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $customer)
                                            <tr class="tr_info">
                                                <td class="td_info">{{ $customer->id }}</td>
                                                {{-- <td><img src="{{ url('/public/uploads/' . $book->thumbnail) }}"
                                                        class="img-book child-child-box" alt=""></td> --}}
                                                <td class="td_info">
                                                    <P>{{ $customer->name }}</P>
                                                </td>
                                                <td class="td_info">
                                                    <p>{{ $customer->location }}</p>
                                                </td>
                                                <td class="td_info">
                                                    <p>{{ $customer->email }}</p>
                                                </td>

                                                <td class="td-control">
                                                    <div class="action" style="display:flex; flex-direction:row;">
                                                        <form action="" class="form-action">
                                                            <button type="submit" class="btn btn-custom"><i
                                                                    class="fas fa-duotone fa-pen"
                                                                    style="--fa-primary-color: #7f90ad; --fa-secondary-color: #195fd7;"></i></button>
                                                        </form>
                                                        <form action="" method="post" class="form-action">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn"><i
                                                                    class="fas fa-sharp fa-solid fa-trash"
                                                                    style="color: #c90838;"></i></button>
                                                        </form>
                                                        <form action="{{ route('admin.project', $customer->id) }}" method="get" class="form-action">
                                                            <button type="submit" class="btn"><i class="fas fa-eye" style="color: #0d59de;"></i></button>
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
