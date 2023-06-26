<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>クライアント登録</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper d-flex">
  

  <!-- Main Sidebar Container -->
  @include('publicView.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper w-100 ml-0 pt-5">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <form action="{{ route('admin.customer.register') }}" method="post">
                @csrf
                @include('auth.alert')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">クライアント登録</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">名前</label>
                                <input type="text" name="name" class="form-control" id="name" autocomplete="off"
                                    placeholder="名前">
                            </div>
                            <div class="form-group">
                                <label for="email">電子メールアドレス</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="電子メールアドレス">
                            </div>
                            <div class="form-group">
                                <label for="location">位置</label>
                                <input type="text" name="location" class="form-control" id="location"
                                    placeholder="位置">
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="パスワード">
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">パスワードの確認</label>
                                <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm"
                                    placeholder="パスワードの確認">
                            </div>

                           
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">作成</button>
                        </div>
                    </form>
                </div>
            </form>
            </div>
            
        </div>
        
      </div>
    </section>
  
  </div>
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
