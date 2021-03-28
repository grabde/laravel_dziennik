@extends('layouts.desktop'.session('suffix'))

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Wyświetlenie odebranej wiadomości</h3>
            </div>

            <form id="mailForm" action="/reply_mail" method="POST">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                  <label for="to" class="col-md-4 col-form-label">{{ __('Do') }}</label>
                  <select name="to" class="col-md-4 col-form-label text-md-right form-control" required disabled>
                      <option value="{{$mail[0]->id_to}}">{{$mail[0]->id_to}} {{$mail[0]->name}} {{$mail[0]->surname}}</option>
                  </select>
                  <select name="to" class="col-md-4 col-form-label text-md-right form-control" required hidden>
                    <option value="{{$mail[0]->id_to}}">{{$mail[0]->id_to}} {{$mail[0]->name}} {{$mail[0]->surname}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Temat:" name="subject" required value="{{$mail[0]->subject}}" disabled>
                  <input class="form-control" placeholder="Temat:" name="subject" required value="{{$mail[0]->subject}}" hidden>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="mail" class="form-control" style="height: 300px" placeholder="Treść wiadomośći" required disabled>{{$mail[0]->mail}}</textarea>
                    <textarea id="compose-textarea" name="mail" class="form-control" style="height: 300px" placeholder="Treść wiadomośći" required hidden>{{$mail[0]->mail}}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Odpowiedz</button>
              </div>
            </div>

            @csrf
            </form>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
