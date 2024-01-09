@extends('layout.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data perusahaan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Perusahaan</label>
                        <div class="col-sm-10">
                            <input name="nama" value="{{ $perusahaan->nama }}" type="text"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">PIC</label>
                        <div class="col-sm-10">
                            <input name="pic" value="{{ $perusahaan->pic }}" type="text"
                                class="form-control @error('pic') is-invalid @enderror"
                                value="{{ old('pic') }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">No Telp</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input name="no_telp" value="{{ $perusahaan->no_telp }}" type="number"
                                    class="form-control @error('no_telp') is-invalid @enderror"
                                    value="{{ old('no_telp') }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input name="email" value="{{ $perusahaan->email }}" type="text  "
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat</label>
                        <div class="col-sm-10">
                            <input name="alamat" value="{{ $perusahaan->alamat }}" type="text"
                                class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Kota</label>
                        <div class="col-sm-10">
                            <input name="kota" value="{{ $perusahaan->kota }}" type="text"
                                class="form-control @error('kota') is-invalid @enderror" value="{{ old('kota') }}" />
                        </div>
                    </div>

                    <div class="col text-center">

                        <button type="submit" class="btn btn-success btn-lg">Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr class="my-5" />
    <!--/ Responsive Table -->
</div>
@endsection
