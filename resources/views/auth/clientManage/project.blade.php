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
                                            <th>Customer</th>
                                            <th>Start</th>
                                            <th>Deadline</th>
                                            <th>Action</th>
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
                                                    <p>{{ $project->start }}</p>
                                                </td>
                                                <td class="td_info">
                                                    <p>{{ $project->deadline }}</p>
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
                                                        <form action="{{ route('admin.project.assign', $project->id) }}" method="get" class="form-action">
                                                            
                                                            <button type="submit" class="btn"><i class="fas fa-eye" style="color: #0d59de;"></i></button>
                                                        </form>
                                                        <form action="{{ route('admin.project.assign', $project->id) }}" method="get" class="form-action">
                                                            
                                                            <button type="submit" class="btn btn-primary">Assign</button>
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
