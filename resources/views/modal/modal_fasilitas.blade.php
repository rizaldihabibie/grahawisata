
  <!-- Modal Add -->
  <div class="modal fade" id="modal_add_fasilitas" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Fasilitas</h4>
        </div>
          <form method="POST" action="{{ url('add_fasilitas') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}
                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Nama Fasilitas</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="nama_fasilitas" value="" required/>
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

  <!-- Modal Edit -->
  <div class="modal fade" id="modal_edit_fasilitas" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Fasilitas</h4>
        </div>
          <form method="POST" action="{{ url('update_fasilitas') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Id Fasilitas</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="id_fasilitas" id="edt_id_fasilitas" value="" readonly required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Nama Fasilitas</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="nama_fasilitas" id="edt_nama_fasilitas" value="" required/>
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


  <!-- Modal Delete -->
  <div class="modal fade" id="modal_delete_fasilitas" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Fasilitas</h4>
        </div>
          <form method="POST" action="{{ url('delete_fasilitas') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}
                  <input type="hidden" class="form-control" name="id_fasilitas" id="del_id_fasilitas" readonly required/>
                  <h5> Apakah anda yakin ingin menghapus <label id="del_nama_fasilitas"><strong> </strong></label> dari daftar fasilitas? </h5>
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