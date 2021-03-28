@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Zmiana ogłoszenia</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="publicationForm" action="/update_publication" method="POST">
            <div class="card-body">
              <div class="form-group">
                
                {{-- Id publication --}}
                <label for="id" class="col-md-4 col-form-label">{{ __('Id ogłoszenia') }}</label>
                <input id="id" type="text" class="col-md-2 col-form-label form-control" name="id" value="{{ $publication[0]->id_publication }}" disabled>
                {{-- hidden input for id publication --}}
                <input id="id" type="text" class="col-md-2 col-form-label form-control" name="id" value="{{ $publication[0]->id_publication }}" hidden>
                <br>

                <label for="publication">Treść ogłoszenia</label>
                <textarea name="publication" id="publication" class="form-control" placeholder="Wprowadź ogłoszenie" cols="30" rows="10">{{$publication[0]->publication}}</textarea>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Zaaktualizuj</button>
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
