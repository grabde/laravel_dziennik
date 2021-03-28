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
              <h3 class="card-title">Tworzenie nowej wiadomości</h3>
            </div>

            <form id="mailForm" action="/send_reply_mail" method="POST">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                  <label for="to" class="col-md-4 col-form-label">{{ __('Do') }}</label>
                  <select name="to" class="col-md-4 col-form-label text-md-right form-control" required disabled>
                    <option value="{{$to[0]->id}}">{{$to[0]->id}} {{$to[0]->name}} {{$to[0]->surname}}</option>
                  </select>
                  <select name="to" class="col-md-4 col-form-label text-md-right form-control" required hidden>
                    <option value="{{$to[0]->id}}">{{$to[0]->id}} {{$to[0]->name}} {{$to[0]->surname}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Temat:" name="subject" required value="{{$reply['subject']}}" disabled>
                  <input class="form-control" placeholder="Temat:" name="subject" required value="{{$reply['subject']}}" hidden>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="mail" class="form-control" style="height: 300px" placeholder="Treść wiadomośći" required></textarea>
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
