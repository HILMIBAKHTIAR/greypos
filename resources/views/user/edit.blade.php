@extends('layout.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data User</h5>
                <a href="{{ route('user') }}" class="btn btn-primary btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" value="{{ $user->name }}" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                        <div class="col-sm-10">
                            <input name="email" value="{{ $user->email }}" type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">username</label>
                        <div class="col-sm-10">
                            <input name="username" value="{{ $user->username }}" type="text"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">gaji</label>
                        <div class="col-sm-10">
                            <input name="gaji" value="{{ $user->gaji }}" type="number"
                                class="form-control @error('gaji') is-invalid @enderror"
                                value="{{ old('gaji') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Password</label>
                        <div class="col-sm-10">
                            <input name="password" value="{{ $user->password }}" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
                        <div class="col-sm-10">
                            <select name="{{ $user->role }}" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="kasir">kasir</option>
                              </select>
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
