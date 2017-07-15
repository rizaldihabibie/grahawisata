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
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <button class="btn btn-success btn-rounded btn-sm" data-toggle="modal" data-target="#modal_add_fasilitas"><span class="fa fa-plus"></span> Tambah Fasilitas </button> &nbsp;
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <form action="{{ url('home/daftar_fasilitas') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">                      
                                        <input class="form-control" type="text" name="search_fasilitas" placeholder="keyword"/>
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
                            <a href="{{url('home/daftar_fasilitas')}}" class="close"> <span class="fa fa-minus-circle"></span> </a>
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
                                    <th class="text-center"> Nama Fasilitas</th>
                                    <th class="text-center"> Action </th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php if(count($maindata)<1) { ?>
                                <tr> <td colspan="3" class="text-center"> tidak ada data </td> </tr>
                            <?php }else{ ?>
                                <?php $i = 0; ?>
                                @foreach($maindata as $hasil) <?php $i++; ?>
                                <tr>
                                    <td class="text-center">{{$maindata->perPage() * ($maindata->currentPage()-1)+$i}}</td>
                                    <td class="text-center">{{$hasil->nama_fasilitas}}</td>
                                    <td class="text-center">
                                      <button class="btn btn-primary btn-sm" data-toggle="modal" onclick="call_modal_edit_fasilitas('{{$hasil->id_fasilitas}}')"><span class="fa fa-edit"></span> Edit</button> &nbsp;
                                      <button class="btn btn-danger btn-sm" data-toggle="modal" onclick="call_modal_del_fasilitas('{{$hasil->id_fasilitas}}')"><span class="fa fa-minus-square"></span> Hapus</button>
                                    </td>
                                </tr> 
                                @endforeach
                            <?php } ?>                   
                            </tbody>
                        </table>
                        <!--  <?php if(count($maindata)>0) { ?> {{ $maindata->links() }} <?php } ?> -->
                        <?php if(count($maindata)>0) { ?> {{ $maindata->appends(request()->input())->links() }} <?php } ?>
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