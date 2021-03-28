@extends('layouts.desktop_N')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-4 mx-auto">
          <h1 class="m-0">Ogłoszenia:</h1><br>
        </div>
        @if (count($publication) == 0)
          <div class="row mx-auto">
            <div class="col-20 col-sm-20 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">
                    Brak ogłoszeń
                  </span>
                  <span class="info-box-number">
                    Brak ogłoszeń
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        @else
          @foreach ($publication as $item)
            <div class="row">
              <div class="col-20 col-sm-20 col-md-9">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">
                      {{$item->timestamp}}
                    </span>
                    <span class="info-box-number">
                      {{$item->publication}}
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
