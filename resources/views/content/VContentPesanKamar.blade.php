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
                            <div class="col-md-7">
                                <h3 class="text-center"><strong> Data Kamar</strong> <small>- {{count($maindata['avail_kelas'])}} Kelas Kamar Tersedia </small> </h3> </br>
                                @if(count($maindata['avail_kelas'])>0)
                                    <?php $index=0; foreach($maindata['avail_kelas'] as $hasil){ $index++;?>

                                        <?php 
                                        $data_reservasi = Crypt::encrypt(array('waktu'=>Request::get('waktu'),
                                                                               'durasi'=>Request::get('durasi'),
                                                                               'jml_kamar'=> Request::get('kamar'),
                                                                               'jml_pengunjung'=> Request::get('guest'),
                                                                               'data_kamar'=>$maindata['available_kamar'][$hasil->id_kelas]
                                                                               ));
                                        // echo json_encode($maindata['available_kamar'][$hasil->id_kelas]);
                                        ?> 

                                    <form  method="POST" action="{{ url('pesan_step1/'.$hasil->id_kelas.'/'.$hasil->nama.'/'.$data_reservasi) }}">
                                    {{ csrf_field() }}
                                            <!-- <?php echo json_encode($maindata['available_kamar'][$hasil->id_kelas])."</br>";?> -->
                                       

                                    <div class="panel panel-success push-up-20">
                                        <div class="panel-body panel-body-pricing">
                                            <h2>{{$hasil->nama}} 
                                                <small>
                                                <span class="label label-info">
                                                    <i class="fa fa-check"></i>
                                                    {{$maindata['jml_avail_kamar_bykelas'][$hasil->id_kelas]}} kamar tersedia
                                                </span> 
                                                </small>
                                            </h2>
                                            <br/>
                                            <h5><?php echo  "Rp ". number_format(($hasil->harga),2,",","."); ?> / Per Hari</h5>
                                            <br/>
                                            @foreach($hasil->fasilitas as $data_fasilitas)
                                            <p><span class="fa fa-check-circle"></span> {{$data_fasilitas->nama_fasilitas}}</p>
                                            @endforeach
                                        </div>
                                        <div class="panel-footer">                                 
                                            <button class="btn btn-success btn-block">Pesan</button>
                                        </div>
                                    </div>
                                    </form>
                                    <?php } ?>
                                @else
                                    <h5 class="text-center"><strong> Pencarian Kelas Kamar Tidak Ditemukan </strong></h5></br>
                                @endif
                            </div>

                            <div class="col-md-4 col-md-offset-1">

                                <h3><strong> <a style="text-decoration:none; color:black;">Pencarian Kamar</a> &nbsp; </strong>
                                    <i class="fa fa-sort" data-toggle="collapse" data-target="#accrd_pencarian_kamar"></i>
                                </h3> 
                                    <small> klik tombol <i class="fa fa-sort"> </i> untuk pencarian</small>
                                </br>
                                <div id="accrd_pencarian_kamar" class="collapse">
                                    </br></br>
                                    <form  method="GET" action="{{ url('home/pesan_kamar/search') }}">
                                        <div class="form-group">
                                        <div class="col-md-12 col-xs-12"> 
                                            <h6><strong>1 Waktu Menginap</strong></h6>  
                                            <label class="text-info">  * Pilih Tanggal </label><br>                                     
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                <input type="text" class="form-control flat-datepicker" name="waktu" value="{{ Request::get('waktu') }}" />
                                            </div>  
                                            </br>
                                            <h6><strong>2 Durasi Menginap </strong></h6>
                                            <label class="text-info"> * Pilih Durasi </label><br>                                  
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                <select class="form-control" name="durasi">
                                                    <?php $durasi = Request::get('durasi'); for($j=1; $j<=15; $j++){ if($durasi == $j){ $select_d = "selected"; }else{$select_d="";} ?>
                                                        <option <?php echo $select_d; ?> value="<?php echo $j; ?>"><?php echo $j; ?> hari</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            </br>
                                            <h6> <strong>3 Jumlah Tamu & kamar</strong></h6> 
                                            <label class="text-info"> * Jumlah kamar harus lebih sedikit dari jumlah tamu </label></br>
                                            <div class="col-md-6 col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
<!--                                                     <select class="form-control" name="guest">
                                                        <?php $guest = Request::get('guest'); for($i=1; $i<=10; $i++){ if($guest == $i){ $select_g = "selected"; }else{$select_g="";} ?>
                                                            <option <?php echo $select_g; ?> value="<?php echo $i; ?>"><?php echo $i; ?> orang</option>
                                                        <?php } ?>
                                                    </select> -->
                                                    <?php $guest = Request::get('guest'); ?>
                                                    <input type="number" class="form-control" name="guest" placeholder="jumlah pengunjung" value="<?php echo $guest; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                                    <select class="form-control" name="kamar">
                                                        <?php $kamar = Request::get('kamar'); for($j=1; $j<=8; $j++){ if($kamar == $j){ $select_k = "selected"; }else{$select_k="";}?>
                                                            <option <?php echo $select_k; ?> value="<?php echo $j; ?>"><?php echo $j; ?> kamar </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            </br>
                                            </br>
                                            </br>
                                            <h6><strong>4 Cari</strong></h6> 
                                            <div class="form-group">                                        
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                                                </div>
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
            var optional_config = {//enableTime: true,
                                   // mode: "range",
                                   minDate: "today",
                                   maxDate: new Date().fp_incr(500),
                                   dateFormat: 'd-m-Y'}
            flatpickr(".flat-datepicker", optional_config);
        </script>
@stop