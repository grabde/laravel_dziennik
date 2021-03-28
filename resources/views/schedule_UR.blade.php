@extends('layouts.desktop_UR')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-4 mx-auto">
            <h1 class="m-0">Plan lekcji:</h1><br>
            @foreach ($days as $day)
              <h3 class="m-0">{{$day->name}}</h3><br>
              @php
                  $index = $loop->index;
              @endphp
              @foreach ($schedule->where('id_day', $day->id_day) as $item)
                @switch($index)
                  @case(0)
                    <div class="info-box mb-3 bg-danger">
                    @break
                  
                  @case(1)
                    <div class="info-box mb-3 bg-warning">
                    @break
                  
                  @case(2)
                    <div class="info-box mb-3 bg-success">
                    @break
                  
                  @case(3)
                    <div class="info-box mb-3 bg-primary">
                    @break

                  @case(4)
                    <div class="info-box mb-3 bg-info">
                    @break

                @endswitch
                    <span class="info-box-icon"><i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{$item->name}}</span>
                        <span class="info-box-number">{{$item->t_from}} - {{$item->t_to}}</span>
                    </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              @endforeach
            @endforeach
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
