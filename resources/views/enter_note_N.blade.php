@extends('layouts.desktop_N')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{session('id_student')}} {{session('student_name')}} {{session('student_surname')}}</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="noteForm" action="/enter_note" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label for="note">Uwaga</label>
                <textarea name="note" id="note" class="form-control" placeholder="Wprowadź uwagę" cols="30" rows="10"></textarea>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Zapisz</button>
            </div>
            @csrf
          </form>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
