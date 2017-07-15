@extends('layouts.MasterAdm')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$FormTitle or ''}}</strong> </h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                    <!-- <div class="row"> -->
                    <?php if(count($maindata)<1) { ?>
                         <label class="text-center"> tidak ada data </label> 
                    <?php }else{ ?>
                            <div class="row">
                                <?php foreach($maindata as $hasil){ ?>


                                <div class="col-md-offset-2 col-md-8 col-md-offset-2 col-xs-12">
                                    <div class="panel panel-success">
                                        <div class="panel-body profile">
                                            <div class="profile-image">
                                                <?php if(Auth::user()->foto == ""){ $foto = 'profile_default.jpg'; }else{ $foto = Auth::user()->foto; } ?>
                                                <img src="<?php echo URL::asset('../storage/app/image/profile_picture/')."/".$foto;?>" alt=""/>
                                            </div>
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_foto_profile">Ganti Foto Profile</button>
                                            </div>
                                        </div>
                                        <div class="panel-body panel-body-pricing">
                                            <h4><strong>Privilege as {{$hasil->toArray()['role']['privilege']}} </strong></h4>  
                                        </div>
                                        <div class="panel-body list-group">
                                            <div class="list-group-item">
                                               Nama<br/>
                                                <i class="fa fa-user"></i><span class="text-muted">{{$hasil->name or 'tidak ada data'}}</span>
                                            </div>
                                            <div class="list-group-item">
                                               Email<br/>
                                                <i>@</i><span class="text-muted"> &nbsp; {{$hasil->email or 'tidak ada data'}}</span>
                                            </div>
                                            <div class="list-group-item">
                                                Pendapatan<br/>
                                                <i class="fa fa-money"></i><span class="text-muted"><?php if(empty($hasil->toArray()['role']['gaji'])){echo "tidak ada data pendapatan";}else{echo "Rp ". number_format(($hasil->toArray()['role']['gaji']),2,",",".");} ?><br/></span>
                                            </div>
                                            <div class="list-group-item">
                                                Alamat<br/>
                                                <i class="fa fa-home"></i><span class="text-muted"><?php if(empty($hasil->alamat)){echo "tidak ada data alamat";}else{echo $hasil->alamat;} ?><br/></span>
                                            </div>
                                            <div class="list-group-item">
                                                Telepon</br>
                                                <i class="fa fa-phone"></i> <span class="text-muted"><?php if(empty($hasil->telepon)){echo "tidak ada data telepon";}else{echo $hasil->telepon;} ?><br/></span>
                                            </div>                          
                                        </div>                                
                                        <div class="panel-footer"> 
                                            <a href="{{'edit_pengguna'}}" style="text-decoration:none;"><button class="btn btn-success btn-block"><i class="fa fa-edit"></i> Edit Pengguna</button></a>
                                        </div>
                                    </div>
                                </div>                                      
                                <?php } ?>

                            </div>         
                    <?php } ?> 
                    <!-- </div>  -->
                    </br>
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
@stop