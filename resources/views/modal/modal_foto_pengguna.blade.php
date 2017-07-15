  <!-- Modal Foto Profile -->
  <div class="modal fade" id="modal_foto_profile" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ganti Foto Profile</h4>
        </div>
          <form method="POST" action="{{ url('upload_photo') }}" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}
                  <input type="hidden" class="form-control" name="id_profile" id="foto_id_profile" readonly required/>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Foto</label>
                    <input type="file" class="form-control-file" name="photo">
                    <small id="fileHelp" class="form-text text-muted">* Ukuran foto tidak boleh lebih dari 1mb </small>
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