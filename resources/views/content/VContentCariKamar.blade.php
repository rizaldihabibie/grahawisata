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
                            <form  method="GET" action="{{ url('home/pesan_kamar/search') }}">
                                
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12" style="border-right: solid #87cefa;"> 
                                         <h5><strong>1 Waktu Menginap</strong></h5>  
                                        <label class="text-info">  * Pilih Tanggal </label><br>                                     
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" class="form-control flat-datepicker" name="waktu" value="<?php echo date('d-m-Y'); ?>" />
                                        </div>  
                                        </br>
                                        <h5><strong>2 Durasi Menginap</strong></h5>
                                        <label class="text-info"> * Pilih Durasi </label><br>

                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                            <select class="form-control" name="durasi">
                                                <?php for($j=1; $j<=15; $j++){ ?>
                                                    <option value="<?php echo $j; ?>"><?php echo $j; ?> hari</option>
                                                <?php } ?>
                                            </select>
                                        </div>  
                                    </div>
                                    <div class="col-md-6 col-xs-12" style="border-left: solid #87cefa;">   
                                        <h5> <strong>3 Jumlah Tamu & kamar</strong></h5> 
                                        <label class="text-info"> * Jumlah kamar harus lebih sedikit dari jumlah tamu </label></br>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
<!--                                                 <select class="form-control" name="guest">
                                                    <?php for($i=1; $i<=10; $i++){ ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?> orang</option>
                                                    <?php } ?>
                                                </select> -->               
                                            <input type="number" class="form-control" name="guest" placeholder="jumlah pengunjung" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                                <select class="form-control" name="kamar">
                                                    <?php for($j=1; $j<=8; $j++){ ?>
                                                        <option value="<?php echo $j; ?>"><?php echo $j; ?> kamar </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        </br>
                                        </br>
                                        </br>
                                        </br>
                                        <h5><strong>4 Cari</strong></h5> 
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