<!DOCTYPE html>
<html>
  <head>
    <title>プロジェクトの追加</title>
    <link rel="stylesheet" href="{{asset('css/addProject.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   
  </head>
  
  <body>
   <div class="wrap d-flex " style="height: 100vh">
    @include('publicView.sidebar')
    <div class="testbox w-100">
      <form action="{{ route('admin.project.store') }}" method="post" style="margin-left: 0; margin-top:0;">
        @csrf
        <p>プロジェクトの追加</p>
        <div class="item">
          <label for="name">>プロジェクト名<span>*</span></label>
          <input id="name" type="text" name="name" required/>
        </div>
        {{-- <div class="item">
          <label for="address">Address<span>*</span></label>
          <input id="address" type="address" name="address" required/>
        </div> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="customer" style="font-weight: bold">会社名</label>
                    <select name="customer" id="categoryID" class="form-control">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="item">
            <label for="start">から始める<span>*</span></label>
            <input id="start" type="date" name="start" required/>
            <i class="fas fa-calendar-alt"></i>
          </div>
        <div class="item">
          <label for="deadline">締め切り<span>*</span></label>
          <input id="deadline" type="date" name="deadline" required/>
          <i class="fas fa-calendar-alt"></i>
        </div>

        <div class="btn-block">
          <button type="submit" >作成</button>
        </div>
      </form>
    </div>
   </div>
  </body>
</html>