@extends('layouts.print')

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12 text-center">
        <h4 class="font-weight-bold">Pengumuman</h4>
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
              <th scope="col" class="table-dark">Judul</th>
              <th scope="col" class="table-dark">Deskripsi</th>
              <th scope="col" class="table-dark">Lampiran</th>
              <th scope="col" class="table-dark">Dibuat Oleh</th>
              <th scope="col" class="table-dark">Untuk</th>
              <th scope="col" class="table-dark">Waktu Dibuat</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($announcements as $announcement)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td class="w-25">{{ $announcement->title }}</td>
              <td class="w-25">{{ $announcement->description }}</td>
              <td><a href="#">{{ $announcement->attachment }}</a></td>
              <td>{{ $announcement->creator->name }}</td>
              <td>{{ $announcement->department_id ? $announcement->department->name : 'ALL' }}</td>
              <td>{{ $announcement->created_at }}</td>
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
