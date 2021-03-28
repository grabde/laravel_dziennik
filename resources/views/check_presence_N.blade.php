@extends('layouts.desktop_N')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Sprawdzenie frekwencji w klasie: <strong>{{session('n_class')}}</strong> przedmiot: <strong>{{session('n_subject')}}</strong></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="dateForm" action="/enter_presence" method="POST">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date">Data</label><br>
                    <input type="date" name="date" id="date" value={{$date}} disabled><br><br>
                    <input type="hidden" name="date" id="date" value={{$date}}>
                    <label for="date">Uczeń</label><br>
                    @foreach ($students as $item)
                      @php
                        $bool = 0;
                      @endphp
                      @foreach (session('swp')->where('id_user', $item->id_user) as $item_p)
                        @php
                          $bool = 1;
                        @endphp
                      @endforeach
                      @if ($bool == 0)
                        <input type="text" name="student" id="student" value='{{$item->id_user}} {{$item->name}} {{$item->surname}}' disabled>
                        <input type="checkbox" name='{{$item->id_user}}'><br><br>
                      @else
                        <input type="text" name="student" id="student" value='{{$item->id_user}} {{$item->name}} {{$item->surname}}' disabled>
                        <input type="checkbox" name='{{$item->id_user}}' checked><br><br>
                      @endif
                    @endforeach
                  </div>
                </div>
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
