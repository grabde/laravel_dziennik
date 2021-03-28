@extends('layouts.desktop'.session('suffix'))

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-4 mx-auto">
          <h1 class="m-0">Wybierz wiadomość:</h1><br>
        </div>
        @foreach ($mails as $item)
          <a href="/mail_{{$item->id_mail}}" class="text-dark text-decoration-none">
            <div class="row">
              <div class="col-20 col-sm-20 col-md-9">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-paper-plane nav-icon"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">
                      {{$item->timestamp}}
                    </span>
                    <span class="info-box-number">
                      {{$item->subject}}
                    </span>
                    <span class="info-box-number">
                      Do: {{$item->id_to}} {{$item->name}} {{$item->surname}}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </div>
          </a>
        @endforeach
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
