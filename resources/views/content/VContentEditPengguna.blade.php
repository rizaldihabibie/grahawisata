
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
                <form  method="POST" action="{{ url('/ubah_profile') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="col-md-offset-1 col-md-11 col-xs-12">      
                                <label class="control-label">Nama Lengkap</label> </br>                                      
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="name" placeholder="nama"  required/>
                            </div>                                            
                            <span class="help-block">*isi nama</span>
                        </div>
                    </div>

                    
                    <div class="form-group">                                        
                        <div class="col-md-offset-1 col-md-11 col-xs-12">
                                <label class="control-label">Username</label> </br> 
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="username" placeholder="username" required/>
                            </div>            
                            <span class="help-block">*isi username</span>
                        </div>
                    </div>

                    
                    <div class="form-group">                                        
                        <div class="col-md-offset-1 col-md-11 col-xs-12">
                                <label class="control-label">Email</label> </br> 
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="email" class="form-control" name="email" placeholder="email" required/>
                            </div>            
                            <span class="help-block">*isi email</span>
                        </div>
                    </div>

                    
                    <div class="form-group">                                        
                        <div class="col-md-offset-1 col-md-11 col-xs-12">
                                <label class="control-label">Alamat</label> </br>      
                                <textarea class="form-control" rows="5" name="alamat"></textarea>
                                <span class="help-block">Data Alamat</span>
                        </div>
                    </div>

                    </div>

                    <div class="col-md-6 col-xs-12">
                                    
                    
                        <div class="form-group">                                        
                            <div class="col-md-offset-1 col-md-11 col-xs-12">
                                    <label class="control-label">Telepon</label> </br> 
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="number" class="form-control" name="telepon" placeholder="telepon" required/>
                                </div>            
                                <span class="help-block">*isi telepon</span>
                            </div>
                        </div>
                  
                    </div>

                    <div class="col-md-12 col-xs-12">

                         <div class="col-md-12 col-xs-12">  
                            </br>     
                            <label style="color:red;"class="control-label">
                                <strong>field bertanda * wajib diisi</strong>
                           </label>  
                            </br> 
                        </div>
                        
                        </br></br></br>

                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
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