  <!-- Modal Add -->
  <div class="modal fade" id="modal_edit_privilege" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Privilege <span id="nama_pengguna"></span></h4>
        </div>
          <form method="POST" action="{{ url('/edit_privilege') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Nama</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="name" id="modal_name" placeholder="nama"  required/>  
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-8 col-xs-12"> 
                              <label class="control-label">Pilih Privilege</label> </br>                                                                                           
                              <select class="form-control" name="privilege" required>
                                  <option  selected="true" disabled="disabled">Pilih Privilege</option>
                                  <?php foreach($data_roles as $roles){?>
                                  <option value="{{$roles->id_role}}">{{$roles->privilege}}</option>
                                  <?php } ?>
                              </select>  
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