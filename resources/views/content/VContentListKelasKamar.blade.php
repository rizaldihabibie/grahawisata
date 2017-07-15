@extends('layouts.MasterAdm')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$FormTitle or ''}}</strong> </h3>

                    <ul class="panel-controls">
                        <li><a href="#"  data-toggle="tooltip" data-placement="up" title="jumlah kamar adalah {{$jumlah_kamar}}"><span class="fa fa-info"></span></a></li> &nbsp;
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <a href="{{'tambah_kelas'}}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-plus"></span> Tambah Kelas </a>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <form action="{{ url('home/daftar_kelas') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">                      
                                        <input class="form-control" type="text" name="search_kelas" placeholder="keyword"/>
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
                            <a href="{{url('home/daftar_kelas')}}" class="close"> <span class="fa fa-minus-circle"></span> </a>
                             Pencarian <mark><strong>  {{$keyword}} </strong></mark>
                             <?php if(count($maindata)>0) {  echo "ditemukan";  }else{ echo "tidak ditemukan"; } ?>
                        </div>
                    </div>
                    </br>
                    @endif

                    <div class="table-responsive">
                        <table id="table-leviauto" class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th class="text-center"> No </th>
                                    <th class="text-center"> Nama Kelas</th>
                                    <th class="text-center"> Deskripsi</th>
                                    <th class="text-center"> Fasilitas</th>
                                    <th class="text-center"> Jumlah Kamar </th>
                                    <th class="text-center"> Action </th>
                                </tr>
                            </thead>
                            <tbody> 

                            <?php if(count($maindata)<1) { ?>
                                <tr> <td colspan="6" class="text-center"> tidak ada data </td> </tr>
                            <?php }else{ ?>
                                <?php $i = 0; ?>
                                @foreach($maindata as $hasil) <?php $i++; ?>
                                <tr>
                                    <td class="text-center">{{$maindata->perPage() * ($maindata->currentPage()-1)+$i}}</td>
                                    <td class="text-center" data-toggle="collapse" data-target="#accord_kelas_{{$hasil->id_kelas}}" class="clickable">
                                        <p data-toggle="tooltip" data-placement="top" title="click untuk detail">    
                                            <strong>{{$hasil->nama}}</strong>
                                        </p>
                                    </td>
                                    <td class="text-center">{{$hasil->deskripsi or 'tidak ada data'}}</td>
                                    <td class="text-center">
                                        @foreach($hasil->fasilitas as $fasilitas)
                                            <span class="label label-info">{{$fasilitas->nama_fasilitas}}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center"><?php if(count($hasil->kamar)>0){
                                        echo count($hasil->kamar);}else{echo "-";}?>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ 'edit_kelas/'.$hasil->id_kelas  }}" class="btn btn-primary btn-sm"> <span class="fa fa-edit"></span> Edit </a>
                                      <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" onclick="call_modal_edit_kelas('{{$hasil->id_kelas}}')"><span class="fa fa-edit"></span> Edit</button> &nbsp;
                                      <button class="btn btn-danger btn-sm" data-toggle="modal" onclick="call_modal_del_kelas('{{$hasil->id_kelas}}')"><span class="fa fa-minus-square"></span> Hapus</button> -->
                                    </td>
                                </tr>   

                                <tr>
                                    <td colspan="6">
                                        <div id="accord_kelas_{{$hasil->id_kelas}}" class="collapse">
                                            <h5 class="text-center"><strong>Detail Kamar</strong> <h5> 
                                            <a class="btn btn-success btn-sm" data-toggle="modal" onclick="call_modal_add_kamar('{{$hasil->id_kelas}}','{{$hasil->nama}}')"><span class="fa fa-plus"></span> Tambah Kamar </a>
                                            </br></br>
                                            <blockquote class="blockquote-primary">
                                            <?php if(count($hasil->kamar)>0){ ?>
                                                <?php $b = 0; ?>
                                                @foreach($hasil->kamar as $kamar) <?php $b++; ?>
                                                <!-- <?php echo json_encode($kamar);?> -->
                                                   <label>  {{$hasil->nama}}{{$kamar->no_kamar}} </label>
                                                   @if($kamar->status == "kosong")
                                                    <?php $status_label = 'label-info'; ?>
                                                   @else
                                                    <?php $status_label = 'label-danger'; ?>
                                                   @endif
                                                   <!-- <span class="label {{$status_label}}"> {{$kamar->status}} </span> -->
                                                   &nbsp;&nbsp;&nbsp;
                                                    @if($b%8 == 0)
                                                        </br></br></br>
                                                    @endif
                                                @endforeach
                                            <?php }else{ ?>
                                                <div class="text-center"> <label> tidak ada data kamar </label> </div>
                                            <?php } ?>
                                            </blockquote>
                                        </div>
                                    </td>
                                </tr>                                 

                                @endforeach           
                            <?php } ?>   

                            </tbody>
                        </table>
                        <!--  <?php if(count($maindata)>0) { ?> {{ $maindata->links() }} <?php } ?> -->
                         <?php if(count($maindata)>0) { ?> {{  $maindata->appends(request()->input())->links() }} <?php } ?>
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
@stop