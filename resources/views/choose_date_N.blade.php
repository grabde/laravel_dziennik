@extends('layouts.desktop_N')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Wybór dnia, w celu sprawdzenia frekwencji w klasie: <strong>{{session('n_class')}}</strong> przedmiot: <strong>{{session('n_subject')}}</strong></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="dateForm" action="/chosen_date" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label for="date">Data</label>
                <input class="form-control datetimepicker-input col-5" type="date" name="date" id="date" value={{session('current_date')}}>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Wybierz</button>
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
