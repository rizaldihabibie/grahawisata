
  <!-- Modal Add -->
  <div class="modal fade" id="call_modal_promo" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Promo</h4>
        </div>
          <form method="POST" action="{{ url('home/tambah_promo') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Kode Promo</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="text" class="form-control" name="kode_promo" required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Promo Setting</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <select class="form-control" name="promo_setting" required>
                                  <option value="" selected disabled>silahkan pilih</option>
                                  <option value="by_percent">berdasarkan persen</option>
                                  <option value="by_money">berdasarkan harga</option>
                                </select>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Nilai Promo</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="number" class="form-control" name="promo_value"  required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Potongan Promo Maks</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="number" class="form-control" name="discount_max"  required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Harga Minumum</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                              <input type="number" class="form-control" name="price_min"  required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Keterangan</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"></span>
                              <textarea class="form-control" rows="5" name="keterangan"></textarea>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Periode Mulai</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="date" name="start" min="<?php date("m-d-Y") ?>" id="dp-3" class="form-control datepicker" 
                              data-date-format="mm-dd-yyyy" data-date-viewmode="years" required/>
                          </div>      
                          <span class="help-block"> </br></span>                                          
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-offset-1 col-md-10 col-xs-12"> 
                              <label class="control-label">Periode Selesai</label> </br>                                             
                          <div class="input-group">
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input type="date" name="end" id="dp-4" class="form-control datepicker" 
                              data-date-format="mm-dd-yyyy" data-date-viewmode="years" required/>
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
  <div class="modal fade" id="modal_del_promo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Promo</h4>
        </div>
          <form method="POST" action="{{ url('delete_promo') }}">
              <div class="modal-body">
                <div class="panel-body">
                  {{ csrf_field() }}
                  <input type="hidden" class="form-control" name="kode_promo" id="del_kd_promo" readonly required/>
                  <h5> Apakah anda yakin ingin menghapus promo? </h5>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
              </div>
          </form>
      </div>
      
    </div>
  </div>  