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
                <form  method="POST" action="{{ url('home/edit_kelas/'.$key) }}">
                    {{ csrf_field() }}
                @foreach($maindata as $hasil)


                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-8 col-xs-12">      
                            	<label class="control-label">Nama Kelas</label> </br>                                      
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="nama" placeholder="nama" value="{{$hasil->nama}}" required/>
                            </div>                                            
                            <span class="help-block">*isi nama kelas</span>
                        </div>
                    </div>

                    
                    <div class="form-group">                                        
                        <div class="col-md-offset-1 col-md-8 col-xs-12">
                            	<label class="control-label">Harga</label> </br> 
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="number" class="form-control" name="harga" placeholder="harga" value="{{$hasil->harga}}" required/>
                            </div>            
                            <span class="help-block">*isi harga</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-8 col-xs-12">
                            <label class="control-label">Deskripsi</label> </br>                                            
                            <textarea class="form-control" rows="8" name="deskripsi">{{$hasil->deskripsi}}</textarea>
                            <span class="help-block">isi deskripsi</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-8 col-xs-12">
                            <label class="control-label">fasilitas</label> </br>
                                <div class="panel-body"> 
                                    @for($i=0; $i < count($fasilitas); $i++)
                                    <div class="col-md-4 col-xs-4">                            
                                        <label class="check">
                                            <?php if($fasilitas[$i]['hasil'] == true){ $status = "checked";}else{ $status="";} ?>
                                            <input type="checkbox" name="id_fasilitas[]" value="{{$fasilitas[$i]['id_fasilitas']}}" class="icheckbox" <?php echo $status; ?>/>
                                            {{$fasilitas[$i]['nama_fasilitas']}}  
                                        </label>
                                    </div>
                                    @endfor
                                </div>                          
                            <span class="help-block">*isi fasilitas</span>
                        </div>
                    </div>
                @endforeach    
                 <div class="col-md-offset-1 col-md-8 col-xs-12">      
                    <label class="control-label">
                   		<strong>field bertanda * wajib diisi</strong>
                   </label>
                </div>
                    
                    </br></br></br>
                    <button class="btn btn-default">Clear Form</button>                                    
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </form>

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