@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Zaznacz użytkownika, któremu chcesz zmienić dane</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="usersForm" action="/change_user" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Wybór</th>
                    <th>Użytkownik</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- loop at students --}}
                    @foreach ($users as $item)
                      <tr>
                        <td><input type="radio" name='id_user' id="id_user" value='{{$item->id}}'></td>
                        <td><input type="text" name='{{$item->id}}' id="name" value='{{$item->id}} {{$item->name}} {{$item->surname}}' disabled></td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Zmień dane</button>
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