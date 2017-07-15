<!doctype html>
<html>
    <head>
        @include('header_footer.HeaderLogin')
        @yield('supportcss')
    </head>

    <body>
        <div class="login-container">
            @yield('content')
            @include('notification.NotificationReportLogin')
            @yield('supportcontent')
        </div>
    <!-- report / notif success or not -->
    </body>

       @include('header_footer.FooterLogin')
       @yield('supportjs')
</html>