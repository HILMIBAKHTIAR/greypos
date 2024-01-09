@extends('layout.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
  @if (session()->has('deleted'))
  <div class="alert alert-danger">
      {{ session()->get('deleted') }}
  </div>
    
  @endif
  @endif
  <h4 class="fw-bold py-3 mb-4">Table Perusahaan</h4>

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Perusahaan</h5>

    <div class="card-body">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcreate">
        Tambah Perusahaan
      </button>
  </div>
 @include('perusahaan.create')
      <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Perusahaan</th>
            <th>PIC</th>
            <th>Email</th>
            <th>No telp</th>
            <th>alamat</th>
            <th>kota</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($data as $i=>$row)
            <tr>
              <td>{{ ++$i}}</td>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->pic }}</td>
              <td>{{ $row->email }}</td>
              <td>{{ $row->no_telp }}</td>
              <td>{{ $row->alamat }}</td>
              <td>{{ $row->kota }}</td>
              <td>
                <form action="{{ route('perusahaan.destroy', $row->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <a href="{{ route('perusahaan.edit', $row->id) }}" class="btn btn-success">Edit</a>
              </td>
            </tr>
            @endforeach
            
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->

  <hr class="my-5" />
  <!--/ Responsive Table -->
</div>



@endsection