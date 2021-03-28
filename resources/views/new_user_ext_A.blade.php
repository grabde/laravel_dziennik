@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Wprowadź dane aby utworzyć nowego użytkownika</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="userForm" action="/new_user_ext" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>
                    <tr>
                        <td><label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label></td>
                        <td><input id="name" type="text" class="col-md-4 col-form-label form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus></td>
                    </tr>

                    <tr>
                        <td><label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label></td>
                        <td><input id="surname" type="text" class="col-md-4 col-form-label form-control" name="surname" value="{{ old('surname') }}" required autocomplete="surname"></td>
                    </tr>

                    <tr>
                        <td><label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres E-Mail') }}</label></td>
                        <td><input id="email" type="email" class="col-md-4 col-form-label form-control" name="email" value="{{ old('email') }}" required autocomplete="email"></td>
                    </tr>

                    <tr>
                        <td><label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label></td>
                        <td><input id="password" type="password" class="col-md-4 col-form-label form-control" name="password" required autocomplete="new-password"></td>
                    </tr>

                    <tr>
                        <td><label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź hasło') }}</label></td>
                        <td><input id="password-confirm" type="password" class="col-md-4 col-form-label form-control" name="password_confirmation" required autocomplete="new-password"></td>
                    </tr>

                    <tr>
                        <td><label for="who" class="col-md-4 col-form-label text-md-right">{{ __('Typ użytkownika') }}</label></td>
                        <td>
                            <select name="who" class="col-md-4 col-form-label text-md-right form-control" required>
                                <option value="U">Uczeń</option>
                                <option value="R">Rodzic</option>
                                <option value="N">Nauczyciel</option>
                                <option value="A">Administrator</option>
                            </select>
                        </td>
                    </tr>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Przejdź dalej</button>
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