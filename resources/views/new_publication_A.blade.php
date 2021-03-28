@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Dodawanie nowego ogłoszenia</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="publicationForm" action="/create_publication" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label for="publication">Treść ogłoszenia</label>
                <textarea name="publication" id="publication" class="form-control" placeholder="Wprowadź ogłoszenie" cols="30" rows="10"></textarea>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Utwórz</button>
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
