@extends('layouts.print')

@section('_content')

<div class="container-fluid mt-2 p-4">
  <div class="row">
    <div class="col-12 text-center">
        <h4 class="font-weight-bold">Data Karyawan</h4>
        <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-3 overflow-auto">
        <table class="table table-light table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th scope="col" class="table-dark">#</th>
              <th scope="col" class="table-dark">Nama</th>
              <th scope="col" class="table-dark">Posisi</th>
              <th scope="col" class="table-dark">Divisi</th>
              <th scope="col" class="table-dark">Dimulainya Kontrak</th>
              <th scope="col" class="table-dark">Berakhirnya Kontrak</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employees as $employee)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $employee->name }}</td>
              <td>{{ $employee->position->name }}</td>
              <td>{{ $employee->department->name }}</td>
              <td>{{ $employee->start_of_contract }}</td>
              <td>{{ $employee->end_of_contract }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('_script')
    <script>
      window.onload = function () {
        window.print();
      }
    </script>
@endsection
