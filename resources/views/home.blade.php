<link rel="stylesheet" href="{{ asset('css/homeAdmin.css') }}">
<div style="display: flex; flex-direction:row">

    @include('publicView.sidebar')

    <div class="content-wrapper flex-grow-1 mt-6" style="margin:0 !important;">
        <section class="content " style="margin-top:20px;">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">

                                <p>顧客管理</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.customer') }}" class="small-box-footer">より詳しい情報 <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">

                                <p>クリエイターマネージャー</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.creator') }}" class="small-box-footer">より詳しい情報 <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                </div>

        </section>

        <section>
            <div class=" area-box-chart">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </section>
    </div>

</div>

</div>



</div>
