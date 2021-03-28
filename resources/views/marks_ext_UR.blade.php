@extends('layouts.desktop_UR')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-4 mx-auto">
            {{-- <h1 class="m-0 mx-auto"></h1><br> --}}
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-book"></i></span>
              <div class="info-box-content">
              <span class="info-box-text">
                {{-- Klasa: {{session('n_class')}}
                <br> --}}
                Przedmiot: {{session('n_subject')}}
              </span>
              <span class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Uczeń</th>
                @foreach ($marks_types as $item)
                  <th>{{$item->name}} ({{$item->weight}})</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if (count($students) == 0)
                <tr>
                  <td><input type="text" name='brak' id="student" value='Brak uczniów' disabled></td>
                  @foreach ($marks_types as $item)
                    <td></td>
                  @endforeach
                </tr>
              @else
                <form>
                  {{-- loop at students --}}
                  @foreach ($students as $item)
                    <tr>
                      <td><input type="text" name='{{$item->id_user}}' id="student" value='{{$item->id_user}} {{$item->name}} {{$item->surname}}' disabled></td>
                      {{-- loop at marks types --}}
                      @foreach ($marks_types as $item_m)
                        {{-- loop at marks --}}
                        @php
                          $value = null;  
                        @endphp
                        @foreach (session('marks')->where('id_user', $item->id_user)->where('id_marks_types', $item_m->id_marks_types) as $item2)
                          @php
                            $value = $item2->value;  
                          @endphp
                        @endforeach
                        <td><input name="{{$item->id_user}}_{{$item_m->id_marks_types}}" type="number" min="1" max="6" maxlength=1 value='{{$value}}' disabled></td>
                      @endforeach
                    </tr>
                  @endforeach
                </form>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection