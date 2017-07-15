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
                    <form  method="POST" action="{{ url('/edit_tampilan') }}">
                    <div class="row">
                        {{ csrf_field() }}
                        @foreach ($maindata as $hasil)
                        <div class="form-group">                                        
                            <div class="col-md-offset-1 col-md-8 col-xs-12">
                                    <label class="control-label">Tema</label> </br> 
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                    <select class="form-control" name="app_theme">
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-dark.css' ) echo 'selected' ; ?> value="theme-dark.css">Tema 1 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-dark-head-light.css' ) echo 'selected' ; ?> value="theme-dark-head-light.css">Tema 2 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-default.css' ) echo 'selected' ; ?> value="theme-default.css">Tema 3 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-default-head-light.css' ) echo 'selected' ; ?> value="theme-default-head-light.css">Tema 4 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-forest.css' ) echo 'selected' ; ?> value="theme-forest.css">Tema 5 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-forest-head-light.css' ) echo 'selected' ; ?> value="theme-forest-head-light.css">Tema 6 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-light.css' ) echo 'selected' ; ?> value="theme-light.css">Tema 7 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-night.css' ) echo 'selected' ; ?> value="theme-night.css">Tema 8 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-night-head-light.css' ) echo 'selected' ; ?> value="theme-night-head-light.css">Tema 9 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-serenity.css' ) echo 'selected' ; ?> value="theme-serenity.css">Tema 10 </option>
                                        <option <?php if ($hasil['setting']['app_theme'] == 'theme-serenity-head-light.css' ) echo 'selected' ; ?> value="theme-serenity-head-light.css">Tema 11 </option>
                                    </select>
                                </div> 
                                <span class="help-block">*Pilih Tema</span>
                            </div>
                        </div>

                        <div class="form-group">                                        
                            <div class="col-md-offset-1 col-md-8 col-xs-12">
                                    <label class="control-label">Layout</label> </br> 
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                    <select class="form-control" name="app_layout"> 
                                            <option <?php if ($hasil['setting']['app_layout'] == '' ||  $hasil['setting']['app_layout'] ==null) echo 'selected' ; ?> value="">Full Width</option>
                                            <option <?php if ($hasil['setting']['app_layout'] == 'page-container-boxed' ) echo 'selected' ; ?> value="page-container-boxed">Boxed</option>
                                    </select>
                                </div> 
                                <span class="help-block">*Pilih Layout</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">             
                        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
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