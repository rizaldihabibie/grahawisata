@extends('layouts.MasterAdm')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$FormTitle or ''}}</strong> </h3>

                    <ul class="panel-controls">
                        <li><a href="#"  data-toggle="tooltip" data-placement="up" title="jumlah pengguna sistem adalah {{$jumlah_pengguna}}"><span class="fa fa-info"></span></a></li> &nbsp;
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <a href="{{'tambah_pengguna'}}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-plus"></span> Tambah Pengguna </a>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <form action="{{ url('home/daftar_pengguna') }}" method="get" class="form-inline">
                                <div class="form-group">
                                    <div class="input-group">                      
                                        <input class="form-control" type="text" name="key_pegawai" placeholder="keyword"/>
                                    </div>
                                </div>                                  
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i></button>
                            </form>  
                        </div>
                    </div> 
                    </br>


                    @if($keyword)
                    <div class="row">
                        <div class="alert alert-info" role="alert">
                            <a href="{{url('home/daftar_pengguna')}}" class="close"> <span class="fa fa-minus-circle"></span> </a>
                             Pencarian <mark><strong>  {{$keyword}} </strong></mark>
                             <?php if(count($maindata)>0) {  echo "ditemukan";  }else{ echo "tidak ditemukan"; } ?>
                        </div>
                    </div>
                    </br>
                    @endif

                    <?php if(count($maindata)<1) { ?>
                         <label class="text-center"> tidak ada data </label> 
                    <?php }else{ ?>
                            <div class="row">
                        <?php $i = 0; ?>
                        @foreach($maindata as $hasil) <?php $i++; ?>

                                <div class="col-md-4">
                                    <div class="panel panel-success mypanel">
                                        <div class="panel-body profile">
                                            <div class="profile-image">
                                                <img src="{{ URL::asset('image/profile_picture/profile_default.jpg') }}" alt=""/>
                                            </div>
                                            <div class="profile-data">
                                                <h5 style="color: #FFFFFF;"> 
                                                    <?php echo $maindata->perPage() * ($maindata->currentPage()-1)+$i.". ".$hasil->username;?>
                                                </h5>
                                                <div class="profile-data-title">{{$hasil->email or 'tidak ada data email'}}</div>                                            
                                            </div>
                                        </div>
                                        <div class="panel-body panel-body-pricing">
                                            <h4><strong>Privilege as {{$hasil->toArray()['role']['privilege']}} </strong>
                                            &nbsp;<small><a onclick="call_modal_edit_privilege('{{$hasil->id}}','{{$hasil->name}}')" style="text-decoration:none;"> <strong> </strong>edit </a> </small></h4>                                
                                            <label><i class="fa fa-file-text-o"></i> Deskripsi</label>
                                            <p>&nbsp;&nbsp;<small>{{$hasil->toArray()['role']['deskripsi'] or 'tidak ada deskripsi'}}</small></p>  
                                         
                                        </div>
                                        <div class="panel-body list-group">
                                            <div class="list-group-item">
                                                <?php if(empty($hasil->toArray()['role']['gaji'])){echo "tidak ada data pendapatan";}else{echo "Rp ". number_format(($hasil->toArray()['role']['gaji']),2,",",".");} ?><br/>
                                                <i class="fa fa-money"></i><span class="text-muted">Pendapatan</span>
                                            </div>
                                            <div class="list-group-item">
                                                <?php if(empty($hasil->alamat)){echo "tidak ada data alamat";}else{echo $hasil->alamat;} ?><br/>
                                                <i class="fa fa-home"></i><span class="text-muted">Alamat</span>
                                            </div>
                                            <div class="list-group-item">
                                                <?php if(empty($hasil->telepon)){echo "tidak ada data telepon";}else{echo $hasil->telepon;} ?><br/>
                                                <i class="fa fa-phone"></i> <span class="text-muted">Telepon</span>
                                            </div>                          
                                        </div>                                
                                        <div class="panel-footer"> 
                                            <button class="btn btn-success btn-block"><i class="fa fa-edit"></i> Edit Pengguna</button>
                                        </div>
                                    </div>
                                </div>  

                        @endforeach           
                    <?php } ?>                         
                            </div>

                 <?php if(count($maindata)>0) { ?> {{  $maindata->appends(request()->input())->links() }} <?php } ?>
                  
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
@stop