@if (Session::has('success'))
    <div class="alert alert-success" style="color: white;">
        {{Session::get('success')}}
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger"  style="color: white;">
        {{Session::get('error')}}
    </div>
@endif