@extends('layouts.MasterAdm')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
            <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$FormTitle or ''}}</strong> </h3>
                </div>
                <form method="POST" action="{{ url('/ubah_password') }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5 col-xs-12">
                                <div class="form-group">     
                                    <label class="control-label">Password Lama</label> </br>                                      
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                        <input type="password" class="form-control" name="password_lama" placeholder="password lama"  required/>
                                    </div>                                            
                                    <span class="help-block">*wajib diisi</span>
                                </div>
                            </div>

                            <div class="col-md-offset-1 col-md-5 col-xs-12">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">     
                                        <label class="control-label">Password Baru</label> </br>                                      
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                            <input type="password" class="form-control" name="password" placeholder="password baru"  required/>
                                        </div>                                            
                                        <span class="help-block">*wajib diisi</span>
                                    </div>    
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">     
                                        <label class="control-label">Ulangi Password Baru</label> </br>                                      
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                            <input type="password" class="form-control" name="password_konfirmasi" placeholder="ulangi password baru"  required/>
                                        </div>                                            
                                        <span class="help-block">*wajib diisi</span>
                                    </div>  
                                </div>
                            </div>

                        </div>

                        <div class="row">             
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </div>                    
                </form>
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