@extends('layouts.desktop_UR')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-4 mx-auto">
          <h1 class="m-0">Uwagi:</h1><br>
        </div>
        @if (count($notes) == 0)
          <div class="row mx-auto">
            <div class="col-20 col-sm-20 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">
                    Brak uwag
                  </span>
                  <span class="info-box-number">
                    Brak uwag
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        @else
          @foreach ($notes as $item)
            <div class="row">
              <div class="col-20 col-sm-20 col-md-9">
                <div class="info-box">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">
                      {{$item->timestamp}}
                    </span>
                    <span class="info-box-number">
                      {{$item->text}}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </div>
          @endforeach
        @endif
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
