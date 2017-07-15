
  <!-- Modal Add -->
  <div class="modal fade" id="call_modal_add_kamar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Kamar</h4>
        </div>
          <form method="POST" action="{{ url('add_kamar') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}

                  <div class="form-group">          
                      <input type="hidden" class="form-control" name="id_kelas" id="add_id_kelas"  readonly required/>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Nama Kamar</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="nama_kamar" id="add_nama_kelas" readonly required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Jumlah Kamar</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="number" class="form-control" name="jumlah_kamar"  required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
      </div>
      
    </div>
  </div>