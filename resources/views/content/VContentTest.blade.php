    <!DOCTYPE html>
    <html lang="en">
        <head>        
            <!-- META SECTION -->
            <title>TITLE</title>            
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            
            <!-- END META SECTION -->
            
            <!-- CSS INCLUDE -->        
            <link href="{{ asset('css/theme-default.css') }}" rel="stylesheet" type="text/css" >
            <link href="{{ asset('css/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" >
            <!-- EOF CSS INCLUDE -->
        </head>
        <body>
                <div class="panel-body">  

                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-default">
     

                        <div class="panel-body panel-body-image">
                            <a href="#" class="panel-body-inform">
                                <span class="fa fa-heart-o"></span>
                            </a>
                        </div>

                        <div class="panel-body">                                                                      
                            <form  method="POST" action="{{ url('home/#') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12" style="border-right: solid #87cefa;"> 
                                        <h5><strong>1 Waktu Menginap</strong></h5>                                       
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control"/>
                                        </div>  
                                        </br>
                                        <h5><strong>2 Durasi Menginap</strong></h5>                                   
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" class="form-control flat-datepicker" data-enable-time="true"/>
                                        </div>  
                                    </div>
                                    <div class="col-md-6 col-xs-12" style="border-left: solid #87cefa;">   
                                        <h5> <strong>3 Jumlah Tamu & kamar</strong></h5>  
                                        <div class="col-md-6 col-xs-6">
                                            <select class="form-control select">
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                                <option>Option 4</option>
                                                <option>Option 5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <select class="form-control select">
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                                <option>Option 4</option>
                                                <option>Option 5</option>
                                            </select>
                                        </div>
                                        </br>
                                        </br>
                                        </br>
                                        <h5><strong>4 Cari</strong></h5> 
                                        <div class="form-group">                                        
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-block">Cari</button>
                                            </div>
                                        </div>    

                                    </div>
                                </div>                               
                            </form>
                        </div>
                    </div>
                </div>            
        </body>

        
    <!-- START SCRIPTS -->
    
        <!-- DEFAULT JS -->
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{ asset('themeforest/audio/alert.mp3') }}" preload="auto"></audio>
        <audio id="audio-fail" src="{{ asset('themeforest/audio/fail.mp3') }}" preload="auto"></audio>
        <!-- END PRELOADS -->    
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <!-- DEFAULT JS -->  

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/icheck/icheck.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/scrolltotop/scrolltopcontrol.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/morris/raphael-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/morris/morris.min.js') }}"></script>       
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/rickshaw/d3.v3.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/rickshaw/rickshaw.min.js') }}"></script>
        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>     
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/bootstrap/bootstrap-timepicker.min.js') }}"></script>            
        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>  
        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/flatpickr/flatpickr.js') }}"></script>                  
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/owl/owl.carousel.min.js') }}"></script>                 
        
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins/daterangepicker/daterangepicker.js') }}"></script>            
        <!-- END THIS PAGE PLUGINS-->        

        
        <script type="text/javascript" src="{{ asset('themeforest/js/plugins.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('themeforest/js/actions.js') }}"></script>

        
        <script type="text/javascript" src="{{ asset('themeforest/js/demo_dashboard.js') }}"></script>
    <!-- START SCRIPTS -->

        <script type='text/javascript' src="{{ asset('themeforest/js/plugins/flatpickr/flatpickr.js') }}"></script>         
            <script>
                var optional_config = {enableTime: true}
                flatpickr(".flat-datepicker", optional_config);
            </script>
    </html>






