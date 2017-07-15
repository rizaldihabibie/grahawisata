    <!-- META SECTION -->
    <title>{{$MainTitle}}</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="my_token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    
    <!-- CSS INCLUDE -->    
    <?php if($Theme != null || !empty($Theme)) { $tema = $Theme; }else{ $tema = 'theme-default.css';}
    ?>
    <link href="{{ asset("css/$tema") }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" >
    <!-- <link href="{{ asset('css/chartist/chartist.min.css') }}" rel="stylesheet" type="text/css" > -->
    <link href="{{ asset('css/chartist/chartist.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/chartist/chartist-plugin-tooltip.css') }}" rel="stylesheet" type="text/css" >
   
    <!-- EOF CSS INCLUDE --> 