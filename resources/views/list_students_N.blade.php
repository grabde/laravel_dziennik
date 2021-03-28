@extends('layouts.desktop_N')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="col-md-4 mx-auto">
            <h1 class="m-0">Wybierz ucznia:</h1><br>
            @foreach ($students as $item)
                <a href="/student_N_{{$item->id_user}}" class="d-block">
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{$item->id_user}} {{$item->name}} {{$item->surname}}</span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
              <!-- /.info-box -->
            @endforeach
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
