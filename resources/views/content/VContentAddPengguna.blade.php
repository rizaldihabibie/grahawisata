
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
                <form  method="POST" action="{{ url('/add_pengguna') }}">
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
                                <label class="control-label">Password</label> </br> 
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" class="form-control" name="password" placeholder="password" required/>
                            </div>            
                            <span class="help-block">*isi Password</span>
                        </div>
                    </div>

                    
                    <div class="form-group">                                        
                        <div class="col-md-offset-1 col-md-11 col-xs-12">
                                <label class="control-label">Ulangi Password</label> </br> 
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" class="form-control" name="ulangi_password" placeholder="ulangi password" required/>
                            </div>            
                            <span class="help-block">*isi Password</span>
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
                   
<!--                         <div class="form-group">
                            <div class="col-md-offset-1 col-md-11 col-xs-12">      
                                    <label class="control-label">Tanggal Lahir</label> </br>   
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" class="form-control datepicker" name=""> value="<?php echo date('Y-m-d');?>">                                            
                                    </div>                                          
                                <span class="help-block">*isi Tanggal Lahir</span>
                            </div>
                        </div>  -->  

                        <div class="form-group">
                            <div class="col-md-offset-1 col-md-11 col-xs-12">      
                                    <label class="control-label">Privilege</label> </br> 
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control" name="role" required>
                                            <option  selected="true" disabled="disabled">Pilih Privilege</option>
                                            <?php foreach($data_roles as $roles) { ?>
                                            <option value="{{$roles->id_role}}">{{$roles->privilege}}</option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block">*isi Privilege</span>
                                    </div>      
                            </div>
                        </div> 
                        
                                                
                    
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


                        <div class="form-group">                                        
                            <div class="col-md-offset-1 col-md-11 col-xs-12">
                                    <label class="control-label">Pertanyaan Pemulih</label> </br> 
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="pertanyaan_pemulih" placeholder="pertanyaan pemulih" required/>
                                </div>            
                                <span class="help-block">*isi Pertanyaan Pemulih</span>
                            </div>
                        </div>


                        <div class="form-group">                                        
                            <div class="col-md-offset-1 col-md-11 col-xs-12">
                                    <label class="control-label">Jawaban Pemulih</label> </br> 
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="jawaban_pemulih" placeholder="jawaban pemulih" required/>
                                </div>            
                                <span class="help-block">*isi Jawaban Pemulih</span>
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