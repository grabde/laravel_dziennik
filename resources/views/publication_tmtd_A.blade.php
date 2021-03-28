@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Wybierz ogłoszenie/a, którego chcesz usunąć</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="publicationForm" action="/del_publication" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Wybór</th>
                    <th>Ogłoszenie</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- loop at publication --}}
                    @foreach ($publication as $item)
                      <tr>
                        <td><input type="checkbox" name='{{$item->id_publication}}' id="id_user" value='{{$item->id_publication}}'></td>
                        <td>
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
                          {{-- <input type="text" name='{{$item->id_publication}}' id="name" value='{{$item->id_publication}} {{$item->publication}} {{$item->timestamp}}' disabled> --}}
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Usuń</button>
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