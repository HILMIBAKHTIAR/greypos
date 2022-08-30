  <!-- Modal -->
  <div class="modal fade" id="modalcreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Form Input Data Pengeluaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="alert alert-danger" style="display:none"></div>
                  <form class="image-upload" method="post" action="{{ route('outflow.store') }}"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="basic-default-company">Tanggal Pembelian</label>
                                  <input class="form-control" type="date" value="{{Carbon\Carbon::now()->format('d-m-Y')."T".Carbon\Carbon::now()->format('H:i')}}" name="tanggal_pembelian" />
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="basic-default-company">Keterangan</label>
                                  <input name="keterangan" type="text" class="form-control" placeholder="Input pembelian" />
                              </div>
                          </div>

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="basic-default-company">Jumlah Pembelian</label>
                                    <input name="jumlah_pembelian" type="number" class="form-control" placeholder="Rp.." id="dengan_rupiah"/>
                                </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">invoice</label>
                                <input name="invoice" type="file" class="form-control" placeholder="Rp.." id="dengan_rupiah"/>
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
