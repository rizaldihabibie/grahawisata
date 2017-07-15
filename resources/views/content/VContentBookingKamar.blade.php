@extends('layouts.MasterAdm')
@section('content')

    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$FormTitle or ''}}</strong> </h3>
                    <ul class="panel-controls">
                    </ul>
                </div>
                <div class="panel-body">  

                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-default"> 
                        <div class="panel-body panel-body-image">
                            <a href="#" class="panel-body-inform">
                                <span class="fa  fa-building-o"></span>
                            </a>
                        </div>

                        <div class="panel-body">                                                                      
                            <div class="col-md-4">
                                <div class="panel panel-info push-up-20">
                                    <div class="panel-body">
                                        <h2><span class="fa fa-file-text-o"></span> Data Pesanan</h2>
                                        <small class="text-danger">
                                           * Pastikan Data Pesanan Telah Sesuai
                                        </small>
                                    </div>                            
                                    <div class="panel-body list-group">
                                        <div class="list-group-item">
                                            {{ session('waktu') }} &nbsp;sampai&nbsp;
                                            <?php echo date('d-m-Y',strtotime(session('waktu').' + '.session('durasi').' days'));?>
                                             <br/>
                                            <span class="text-muted">Waktu Inap</span>
                                        </div>
                                        <div class="list-group-item">
                                            {{ session('nama_kelas') }}<br/>
                                            <span class="text-muted">Tipe Kamar</span>
                                        </div>
                                        <div class="list-group-item">
                                            {{ session('durasi') }} Hari<br/>
                                            <span class="text-muted">Durasi Menginap</span>
                                        </div>
                                        <div class="list-group-item">
                                            {{ session('jml_kamar') }} Kamar <br/>
                                            <span class="text-muted">Jumlah Kamar</span>
                                        </div>
                                        <div class="list-group-item">
                                            {{  session('jml_pengunjung') }}  Orang<br/>
                                            <span class="text-muted">Jumlah Orang</span>
                                        </div>
                                        <div class="list-group-item">
                                            <?php if(!empty( session('kode_disc'))){echo session('kode_disc'); }else{ echo "tidak ada"; } ?>  <br/>
                                            <span class="text-muted">Kode Voucher</span>
                                        </div>
                                        <div class="list-group-item">
                                            <?php echo  "Rp ". number_format(session('total_harga'),2,",","."); ?><br/>
                                            <?php if(!empty(session('disc')) ){     $field_diskon = "readonly"; $kode_diskon = session('kode_disc');
                                                                                     echo "<i> Harga menjadi ".number_format(session('harga_promo'),2,",",".").
                                                                                     " dengan discount sebesar Rp". number_format(session('disc'),2,",",".")."</i></br>";
                                                                                        }else{
                                                                                    $field_diskon = "";   $kode_diskon=""; 
                                                                              } ?>
                                            <span class="text-muted">Total Harga</span>
                                        </div>                                 
                                    </div>
                                </div>                                                           
                            </div>

                            <div class="col-md-7 col-md-offset-1">
                                <div class="panel panel-colorful push-up-20">
                                    <div class="panel-body">
                                        <h2><i class="glyphicon glyphicon-user"></i> Data Pemesan</h2> 
                                        <small class="text-danger">
                                            <?php if(!empty(session('time_book_expired'))){ echo " * pengisian data harus dilakukan sebelum "."<strong>".session('time_book_expired')."</strong>";}?>
                                        </small>
                                    </div>
                                    <div class="panel-body list-group">
                                        <div class="list-group-item">
                                        <form method="POST" action="{{ url('/add_order') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">      
                                                        <label class="control-label">Nama Pelanggan</label> </br>                                      
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="nama" placeholder="nama"  required/>
                                                    </div>                                            
                                                    <span class="help-block">*isi nama pelanggan</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">      
                                                        <label class="control-label">No Identitas</label> </br>                                      
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="number" class="form-control" name="id_pengunjung" placeholder="nama"  required/>
                                                    </div>                                            
                                                    <span class="help-block">*isi no identitas ( bisa berupa ktp, sim, ataupun tanda pengenal)</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">      
                                                        <label class="control-label">No Telepon</label> </br>                                      
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="number" class="form-control" name="telepon" placeholder="telepon"  required/>
                                                    </div>                                            
                                                    <span class="help-block">*isi no telepon</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">      
                                                        <label class="control-label">Email</label> </br>                                      
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="email" class="form-control" name="email" placeholder="email"  required/>
                                                    </div>                                            
                                                    <span class="help-block">*isi email</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">
                                                    <label class="control-label">Alamat</label> </br>                                            
                                                    <textarea class="form-control" rows="8" name="alamat"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">  
                                                    <div class="col-md-8 col-xs-8">
                                                            <label class="control-label">Kode Promo</label> </br>                                      
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                            <input type="text" class="form-control" name="kode_promo" id="kode_promo" value="{{$kode_diskon}}" placeholder="kode promo"/>
                                                        </div>                                            
                                                        <span class="help-block">isi promo jika ada </span> </br>
                                                        <text style="color:red;" id="report_info_kode"></text>
                                                     </div> 

                                                     <div class="col-md-4 col-xs-4">
                                                        <div class="pull-right push-up-25">
                                                         <button type="button" onclick="cek_kode_promo()" class="btn btn-info">Cek Kode</button>
                                                        </div>
                                                     </div>   
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-7 col-xs-offset-7">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>   
                                        </form>
                                        </div> 
                                    </div>
                                </div>   
                            </div>


                        </div>
                    </div>
                </div>  
            </div>
            </div>
            
        </div>
    </div>     

       
    
@stop


@section('supportcontent')
    <?=$ContentSupport?>
@stop

@section('pluginjs')
    <?=$PluginJS?>
@stop

@section('supportjs')
    <?=$SupportJS?>   
    <script>
        function cek_kode_promo(){
            var kode = $("#kode_promo").val();
            if(kode!=""){
                generate_promo(kode);
            }
        }

        function generate_promo(promo){
          url_post =  '{{ url("ajax_check_promo") }}';
          url_refresh =  '{{ url("home/pesan_kamar/booking") }}';
          $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="my_token"]').attr('content')},
                type:'POST',
                cache:'false',
                dataType: 'json',
                url : url_post,
                data: {'kode_promo': promo},
                success: function(data){
                         if(data['boolean'] == true){
                            $("#report_info_kode").text("");
                            window.location = url_refresh;
                        }else{
                            $("#report_info_kode").text("( "+" "+data['report']+" )");
                        }
                },
                error: function(data) {
                  console.log(data);
                }

          });
        }

    </script>
@stop