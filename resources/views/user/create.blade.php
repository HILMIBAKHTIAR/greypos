  <!-- Modal -->
  <div class="modal fade" id="modalcreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form class="image-upload" method="post" action="{{ route('user.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-company">Nama</label>
                          <input name="name" type="text" class="form-control"  placeholder="Masukan Nama" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <input
                              name="email"
                              type="text"
                              class="form-control"
                              placeholder="Masukan Email"
                              aria-describedby="basic-default-email2"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-company">Password</label>
                          <input name="password" type="password" class="form-control"  placeholder="Masukan Password" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-message">username</label>
                          <input name="username" type="text" class="form-control"  placeholder="Masukan usernane" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-company">Role</label>
                          <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="kasir">kasir</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-message">Foto</label>
                          <input name="foto" type="file" class="form-control"  placeholder="Masukan Foto" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="basic-default-message">Gaji</label>
                          <input name="gaji" type="number" class="form-control"  placeholder="Masukan gaji" />
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