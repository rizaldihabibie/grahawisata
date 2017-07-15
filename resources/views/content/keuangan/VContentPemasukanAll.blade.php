<div class="col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body panel-body-image">
            <a href="#" class="panel-body-inform">
                <span class="fa fa-money"></span>
            </a>
        </div>
        </br>
        </br>
        <div class="row">
            <div class="col-md-4">

                <div class="widget widget-primary">
                    <div class="widget-title">{{$title_widget}}</div>
                    <div class="widget-subtitle"><?php echo date("d/m/Y");?></div>
                    <div class="widget-int"><small><?php echo "Rp ". number_format(($total_pemasukan),0,",","."); ?></small></div>
                    <div class="widget-controls">
                        <!-- <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a> -->
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="widget widget-success widget-no-subtitle">
                    <div class="widget-big-int"><small><span class="fa fa-users"></span> <?php echo $total_transaksi; ?></small></div>                            
                    <div class="widget-title">Total Transaksi</div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>                            
                </div>                        

            </div>
            <div class="col-md-4">

                <div class="widget widget-danger widget-padding-sm">
                    <div class="widget-big-int plugin-clock">00:00</div>                            
                    <div class="widget-subtitle plugin-date">Loading...</div>
                    <div class="widget-controls">                                
                        <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                    </div>                            
                    <div class="widget-buttons widget-c3">
                        <div class="col">
                            <a href="#"><span class="fa fa-clock-o"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-bell"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-calendar"></span></a>
                        </div>
                    </div>                            
                </div>                        

            </div>

        </div>

        <div class="panel-body">    
            <form class="form-horizontal" role="form">
                <div class="form-group">
                                                            
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
                            <input type="text" class="form-control" name="key_pemasukan" value="<?php if(!empty(Request::get('key_pemasukan'))){echo Request::get('key_pemasukan');} ?>" placeholder="Keyword Pencarian"/>
                        </div>
                    </div>    
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group">
                            <?php if(Request::segment(3)=="tahunan"){ ?>  
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <?php $tahun = date("Y"); ?>
                                <input type="number" class="form-control flat-datepicker" name="tahun" value="<?php if(!empty(Request::get('tahun'))){echo Request::get('tahun');}else{ echo $tahun; } ?>" />
                            <?php }else if(Request::segment(3)=="bulanan"){ ?>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"> </span></span>
                                <select class="form-control" name="bulan">
                                    <option value="01" <?php if(Request::get('bulan')=="01" or date("m") =="01" ){echo "selected";} ?> >Januari</option>
                                    <option value="02" <?php if(Request::get('bulan')=="02" or date("m") =="02" ){echo "selected";} ?> >Februari</option>
                                    <option value="03" <?php if(Request::get('bulan')=="03" or date("m") =="03" ){echo "selected";} ?> >Maret</option>
                                    <option value="04" <?php if(Request::get('bulan')=="04" or date("m") =="04" ){echo "selected";} ?> >April</option>
                                    <option value="05" <?php if(Request::get('bulan')=="05" or date("m") =="05" ){echo "selected";} ?> >Mei</option>
                                    <option value="06" <?php if(Request::get('bulan')=="06" or date("m") =="06" ){echo "selected";} ?> >Juni</option>
                                    <option value="07" <?php if(Request::get('bulan')=="07" or date("m") =="07" ){echo "selected";} ?> >Juli</option>
                                    <option value="08" <?php if(Request::get('bulan')=="08" or date("m") =="08" ){echo "selected";} ?> >Agustus</option>
                                    <option value="09" <?php if(Request::get('bulan')=="09" or date("m") =="09" ){echo "selected";} ?> >September</option>
                                    <option value="10" <?php if(Request::get('bulan')=="10" or date("m") =="10" ){echo "selected";} ?> >Oktober</option>
                                    <option value="11" <?php if(Request::get('bulan')=="11" or date("m") =="11" ){echo "selected";} ?> >November</option>
                                    <option value="12" <?php if(Request::get('bulan')=="12" or date("m") =="12" ){echo "selected";} ?> >Desember</option>                                
                                </select>
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <?php $tahun = date("Y"); ?>
                                <input type="number" class="form-control flat-datepicker" name="tahun" value="<?php if(!empty(Request::get('tahun'))){echo Request::get('tahun');}else{ echo $tahun; } ?>" />
                            <?php }else if(Request::segment(3)=="harian"){ ?>
                                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                                <input type="text" class="form-control datepicker" name="hari" value="<?php if(!empty(Request::get('hari'))){echo Request::get('hari');}else{ echo date("Y-m-d"); } ?>"/>           
                            <?php } else if(Request::segment(3)=="all"){ ?>
                                <span class="input-group-addon">dari</span>
                                <input type="text" class="form-control datepicker" placeholder="Tanggal" name="tanggal_between[]" />
                                <span class="input-group-addon">sampai</span>
                                <input type="text" class="form-control datepicker" placeholder="Tanggal" name="tanggal_between[]" />
                             <?php } else { ?>
<!--                                             <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <input type="text" class="form-control datepicker" value=" <?php echo date("Y-m-d");?>"/>   -->                                              
                            <?php } ?>
                        </div>                                            
                    </div>
                    <div class="col-md-4">
                            <button class="btn  btn-primary btn-block"><span class="fa fa-search"></span> Cari</button>
                    </div>   
                    
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="btn-group btn-group-justified">  
                            <a href="{{ url('home/pemasukan/all ') }}" class="btn btn-primary <?php if(Request::segment(3)=="all"){ echo 'active'; } ?> ">Semua</a>
                            <a href="{{ url('home/pemasukan/tahunan') }}" class="btn btn-primary <?php if(Request::segment(3)=="tahunan"){ echo 'active'; } ?>">Tahun</a>
                            <a href="{{ url('home/pemasukan/bulanan') }}" class="btn btn-primary <?php if(Request::segment(3)=="bulanan"){ echo 'active'; } ?>">Bulan</a>
                            <a href="{{ url('home/pemasukan/harian') }}" class="btn btn-primary <?php if(Request::segment(3)=="harian"){ echo 'active'; } ?>">Hari</a>
                        </div>                                         
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-danger btn-block dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="#" onClick ="$('#table-grahawisata').tableExport({type:'excel',escape:'false'});"><img src="{{ URL::asset('image/icons/xls.png') }}" width="24"/> XLS</a></li>
                            <li><a href="#" onClick ="$('#table-grahawisata').tableExport({type:'pdf',escape:'false'});"><img src="{{ URL::asset('image/icons/pdf.png') }}" width="24"/> PDF</a></li>
                        </ul>
                    </div>
                </div>
            </form>                            
        </div>

        <div class="panel-body">                                                                      
            <div class="col-md-12 col-xs-12">
                <?php if(count($maindata)>0){?>
                        <div class="table-responsive">
                            <table id="table-grahawisata" class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th class="text-center"> No </th>
                                        <th class="text-center"> Nama </th>
                                        <th class="text-center"> Id Pesanan</th>
                                        <th class="text-center"> Tanggal Pemesanan</th>
                                        <th class="text-center">Durasi</th>
                                        <th class="text-center"> Kode Promo</th>
                                        <th class="text-center"> Tamu </th>
                                        <th class="text-center"> Total Harga </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                <?php if(count($maindata)<1) { ?>
                                    <tr> <td colspan="7" class="text-center"> tidak ada data </td> </tr>
                                <?php }else{ ?>
                                    <?php $i = 0; ?>
                                    @foreach($maindata as $hasil) <?php $i++; ?>
                                        <tr>
                                            <td class="text-center"><strong>{{$maindata->perPage() * ($maindata->currentPage()-1)+$i}}</strong></td>
                                            <td class="text-center">{{$hasil->pengunjung->nama}}</td>
                                            <td class="text-center">{{$hasil->id_pesanan}}</td>
                                            <!-- <td class="text-center">{{$hasil->day_start}}</td> -->
                                            <td class="text-center"><?php  echo date('d-M-Y', strtotime($hasil->day_start)); ?></td>
                                           
                                            <td class="text-center">{{$hasil->jumlah_hari}} hari</td>
                                            <td class="text-center">{{$hasil->kode_promo or 'tidak ada'}}</td>
                                            <td class="text-center">{{$hasil->jumlah_tamu}}</td>
                                            <td class="text-center"><?php echo  "Rp ". number_format(($hasil->total_harga),2,",","."); ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="col-md-6 col-xs-12">
                                                    <a style="text-decoration:none;"  data-toggle="collapse"  data-target="#accord_detail_pengunjung{{$hasil->id_pesanan}}">
                                                        <button class="btn  btn-info btn-block"><span class="fa fa-user"></span> Data Pengunjung</button>
                                                    </a>
                                                </div> 
                                                <div class="col-md-6 col-xs-12">
                                                    <a style="text-decoration:none;"  data-toggle="collapse"  data-target="#accord_detail_reservasi{{$hasil->id_pesanan}}">
                                                        <button class="btn  btn-info btn-block"><span class="fa fa-file-text-o"></span> Data Pemesanan</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="8">
                                                <div id="accord_detail_pengunjung{{$hasil->id_pesanan}}" class="collapse">
                                                    <!-- CONTACT ITEM -->
                                                    <div class="panel panel-danger">
                                                        <div class="panel-body profile">
                                                            <div class="profile-image">
                                                                <img src="{{ URL::asset('image/profile_picture/profile_default.jpg') }}" />
                                                            </div>
                                                            <div class="profile-data">
                                                                <div class="profile-data-name">{{$hasil->pengunjung->nama}}</div>
                                                                <div class="profile-data-title">{{$hasil->pengunjung->id_pengunjung}}</div>
                                                            </div>
                                                        </div>                                
                                                        <div class="panel-body">                                    
                                                            <div class="contact-info">
                                                                <p><small>Mobile</small><br/>{{$hasil->pengunjung->telepon}}</p>
                                                                <p><small>Address</small><br/>{{$hasil->pengunjung->alamat}}</p>                                   
                                                            </div>
                                                        </div>                                
                                                    </div>
                                                    <!-- END CONTACT ITEM -->                                
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="8">
                                                <div id="accord_detail_reservasi{{$hasil->id_pesanan}}" class="collapse">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <h2><span class="fa fa-file-text-o"></span> Detail Pemesanan</h2>
                                                            <div class="user">
                                                                <a href="#" class="name">{{$hasil->pengunjung->nama}}</a>
                                                            </div>                           
                                                            <div class="contact-info">
                                                                <p><strong>Jumlah Hari</strong><br/>{{$hasil->jumlah_hari}} Hari </p>
                                                                <p><strong>Jumlah Tamu</strong><br/>{{$hasil->jumlah_tamu}} Orang </p>
                                                                <p><strong>Durasi Inap</strong><br/>{{$hasil->day_start}} sampai dengan {{$hasil->day_end}} </p>                                 
                                                            </div>
                                                        </div>                 
                                                        <?php   if(count($hasil->kamar)>0){ $kamar_pesanan= array(); ?>       
                                                            <div class="panel-body list-group">
                                                                <div class="col-md-6 col-xs-6">
                                                                @foreach($hasil->kamar as $data_kamar) 
                                                                    <div class="list-group-item">
                                                                        <?php 
                                                                        if(!in_array($data_kamar->no_kamar, $kamar_pesanan)){
                                                                            array_push($kamar_pesanan, $data_kamar->no_kamar); } ?>
                                                                        kamar no {{$data_kamar->no_kamar}}<br/>
                                                                    </div>   
                                                                @endforeach 
                                                                </div>
                                                                <div class="col-md-6 col-xs-6">
                                                                @foreach($hasil->detail_reservasi as $data_detail_reservasi) 
                                                                    <div class="list-group-item">
                                                                         {{$data_detail_reservasi->tanggal}}<br/>
                                                                    </div>  
                                                                @endforeach
                                                                </div>                           
                                                            </div>
                                                        <?php }else{ ?>   
                                                        <div class="panel-body list-group">
                                                            <div class="list-group-item">
                                                                Data Pesanan Tidak Ditemukan<br/>
                                                            </div>                               
                                                        </div>
                                                        <?php } ?>   
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                <?php } ?>                   
                                </tbody>
                            </table>
                        </div>                                 
                <?php }else{?>
                         <tr>
                                <td colspan="8" class="text-center" > <h3> tidak ada data </h3>  </td>
                        </tr>
                <?php } ?>

                <?php if(count($maindata)>0) { ?> {{ $maindata->appends(request()->input())->links() }} <?php } ?>
            </div>

            
        </div> 

        <div class="panel-body">
            <div class="block-full-width">
                <div class="ct-series-pemasukan ct-golden-section" id="chart-pemasukan"></div>                                               
            </div>
        </div>   
    </div>
</div>