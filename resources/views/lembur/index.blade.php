@extends('layout.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
  @endif
  <h4 class="fw-bold py-3 mb-4">Table lembur</h4>

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">lembur</h5>

    <div class="card-body">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah lembur
      </button>
  </div>

        <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input lembur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form class="image-upload" method="post" action="{{ route('lembur.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                                <label class="form-label" for="basic-default-company">Karyawan</label>
                                <select name="karyawan_id"
                                    class="form-control @error('karyawan_id') is-invalid @enderror">
                                    @foreach ($karyawan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('karyawan_id') == $item->id ? 'selected' : null }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-fullname">Tanggal</label>
                          <input name="tanggal_lembur" type="date" class="form-control" placeholder="Tanggal lembur" />
                        </div>  
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-fullname">Jam Mulai</label>
                          <input name="jam_selesai" type="time" class="form-control" placeholder="Jam Mulai"/>
                        </div>  
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-fullname">Jam Mulai</label>
                          <input name="jam_mulai" type="time" class="form-control" placeholder="Jam Mulai"/>
                        </div>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-fullname">Hasil Lembur</label>
                          <input name="hasil_lembur" type="number" class="form-control" placeholder="Hasil Lembur"/>
                        </div>  
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-success btn-lg" name="simpan" id="simpan" value="simpan"
                      style="padding: 5px 50px; margin-top: 10px;">
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>

      <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Karyawan</th>
            <th>tanggal</th>
            <th>jam mulai</th>
            <th>jam selesai</th>
            <th>Hasil Lembur</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($data as $i=>$row)
            <tr>
              <td>{{++$i}}</td>
              <td>{{ $row->karyawan->name }}</td>
              <td>{{ $row->tanggal_lembur }}</td>
              <td>{{ $row->jam_mulai }}</td>
              <td>{{ $row->jam_selesai }}</td>
              <td>{{ $row->hasil_lembur }}</td>
              <td>
                <form action="{{ route('lembur.destroy', $row->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
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

{{-- <script>
  function timeid() {
    reformatDate('11/12/2001 22:23', {timeOnly: true})
  }
</script> --}}