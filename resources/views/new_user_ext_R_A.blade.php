@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Wybierz ucznia, którego chcesz przypisać do rodzica</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="userForm" action="/create_user_R" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>

                    <tr>
                        <td><label for="students" class="col-md-4 col-form-label text-md-right">{{ __('Uczeń') }}</label></td>
                        <td>
                            <select name="students" class="col-md-4 col-form-label text-md-right form-control" required>
                              @foreach ($students as $item)
                                <option value='{{$item->id}}'>{{$item->id}} {{$item->name}} {{$item->surname}}</option>
                              @endforeach
                            </select>
                        </td>
                    </tr>

                </tbody>
              </table>
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