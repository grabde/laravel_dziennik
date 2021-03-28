@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Wybierz klase do której przypisać ucznia</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="userForm" action="/create_user_U" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>

                    <tr>
                        <td><label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Klasa') }}</label></td>
                        <td>
                            <select name="class" class="col-md-4 col-form-label text-md-right form-control" required>
                              @foreach ($class as $item)
                                <option value='{{$item->id_class}}'>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                      <td><label for="schedule" class="col-md-4 col-form-label text-md-right">{{ __('Plan lekcji') }}</label></td>
                      <td>
                          <select name="schedule" class="col-md-4 col-form-label text-md-right form-control" required>
                              @foreach ($list_schedule as $item)
                                <option value="{{$item->id_schedule}}">{{$item->id_schedule}}</option>
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