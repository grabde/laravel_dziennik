@extends('layouts.desktop_A')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Zmiena danych</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="userForm" action="/update_AN" method="POST">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <tbody>

                    <tr>
                      <td><label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label></td>
                      <td>
                        <input id="id" type="text" class="col-md-4 col-form-label form-control" name="id" value="{{ $user_data[0]->id }}" disabled>
                        <input id="id" type="text" class="col-md-4 col-form-label form-control" name="id" value="{{ $user_data[0]->id }}" hidden>
                      </td>
                    </tr>

                    <tr>
                        <td><label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label></td>
                        <td><input id="name" type="text" class="col-md-4 col-form-label form-control" name="name" value="{{ $user_data[0]->name }}" required autocomplete="name" autofocus></td>
                    </tr>

                    <tr>
                        <td><label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label></td>
                        <td><input id="surname" type="text" class="col-md-4 col-form-label form-control" name="surname" value="{{ $user_data[0]->surname }}" required autocomplete="surname"></td>
                    </tr>

                    <tr>
                        <td><label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres E-Mail') }}</label></td>
                        <td><input id="email" type="email" class="col-md-4 col-form-label form-control" name="email" value="{{ $user_data[0]->email }}" required autocomplete="email"></td>
                    </tr>

                    {{-- <tr>
                        <td><label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label></td>
                        <td><input id="password" type="password" class="col-md-4 col-form-label form-control" name="password" value="{{ $user_data[0]->password }}" required autocomplete="new-password"></td>
                    </tr> --}}

                    {{-- <tr>
                        <td><label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potwierdź hasło') }}</label></td>
                        <td><input id="password-confirm" type="password" class="col-md-4 col-form-label form-control" name="password_confirmation" required autocomplete="new-password"></td>
                    </tr> --}}

                    {{-- <tr>
                        <td><label for="who" class="col-md-4 col-form-label text-md-right">{{ __('Typ użytkownika') }}</label></td>
                        <td>
                            <select name="who" class="col-md-4 col-form-label text-md-right form-control" required>
                                <option value="U">Uczeń</option>
                                <option value="R">Rodzic</option>
                                <option value="N">Nauczyciel</option>
                                <option value="A">Administrator</option>
                            </select>
                        </td>
                    </tr> --}}

                    @php
                      $bool = 0;
                      if (session('error') != null)
                      {
                        $bool = 1;
                      }
                    @endphp

                    @if ($bool == 1)
                      <tr>
                        <td>
                          {{-- <strong class="col-md-4 col-form-label text-danger text-md-right">{{ session('error') }}</strong> --}}
                        </td>
                        <td>
                          <strong class="col-md-4 col-form-label text-danger text-md-right">{{ session('error') }}</strong>
                        </td>
                      </tr>
                      @php
                          session(['error' => null]);
                      @endphp
                    @endif

                </tbody>
              </table>
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