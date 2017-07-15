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
                            <button class="btn btn-success btn-rounded btn-sm" data-toggle="modal" data-target="#call_modal_promo"><span class="fa fa-plus"></span> Tambah Promo </button> &nbsp;
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <form action="{{ url('home/daftar_promo') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">                      
                                        <input class="form-control" type="text" name="search_promo" placeholder="keyword"/>
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
                            <a href="{{url('home/daftar_promo')}}" class="close"> <span class="fa fa-minus-circle"></span> </a>
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
                                    <th class="text-center"> Kode Promo</th>
                                    <th class="text-center"> Durasi</th>
                                    <th class="text-center"> Syarat Minumum</th>
                                    <th class="text-center"> Diskon Maksimum</th>
                                    <th class="text-center"> Deskripsi</th>
                                    <th class="text-center"> Action </th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php if(count($maindata)<1) { ?>
                                <tr> <td colspan="7" class="text-center"> tidak ada data </td> </tr>
                            <?php }else{ ?>
                                <?php $i = 0; ?>

                                @foreach($maindata as $hasil) <?php $i++; ?>
                                <tr>
                                    <td class="text-center">{{$maindata->perPage() * ($maindata->currentPage()-1)+$i}}</td>
                                    <td class="text-center">{{$hasil->kode_promo}}</td>
                                    <td class="text-center">{{$hasil->start}} - {{$hasil->end}}</td>
                                    <td class="text-center"> <?php echo  "Rp ". number_format(($hasil->price_min),2,",","."); ?></td>
                                    <td class="text-center">
                                    @if ($hasil->promo_setting == 'by_percent')
                                        {{$hasil->promo_value}} <label>%</label> <label> ( maksimum sebesar <?php echo  "Rp ". number_format(($hasil->discount_max),2,",","."); ?> )</label>
                                    @elseif ($hasil->promo_setting == 'by_money')
                                        <?php echo  "Rp ". number_format(($hasil->promo_value),2,",","."); ?>
                                        <!-- <?php echo  "Rp ". number_format(($hasil->discount_max),2,",","."); ?> -->
                                    @endif
                                    </td>
                                    <td class="text-center">{{$hasil->keterangan or 'tidak ada data'}}</td>
                                    <td> 
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" onclick="call_modal_del_promo('{{$hasil->kode_promo}}')"><span class="fa fa-minus-square"></span> Hapus</button>
                                    </td>
                                </tr> 
                                @endforeach
                            <?php } ?>                   
                            </tbody>
                        </table>
                        <!-- <?php if(count($maindata)>0) { ?> {{ $maindata->links() }} <?php } ?> -->
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