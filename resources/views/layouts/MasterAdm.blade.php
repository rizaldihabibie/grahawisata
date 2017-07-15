<!doctype html>
<html>
    <head>
        @include('header_footer.HeaderAdm')
        @yield('supportcss')
    </head>

    <body class="{{$LayoutType or ''}}">
         <div class="page-container">

                <!-- menu side navigasi is here -->
                @include('navbar.navside')
            <div class="page-content">

                <!-- menu top navigasi is here -->
                 @include('navbar.navtop')

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="" class="active">Dashboard</a></li>  
                </ul>
                <!-- END BREADCRUMB --> 

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <!-- report / notif success or not -->
                        @include('notification.NotificationReport')
                    <!-- main content -->                    
                         @yield('content')
                    <!-- support content -->
                        @yield('supportcontent')
                </div>

                <!-- END PAGE CONTENT WRAPPER -->    

            </div>

         </div>    
    </body>

       @include('header_footer.FooterAdm')
       
       @yield('pluginjs')
       @yield('supportjs')
</html>