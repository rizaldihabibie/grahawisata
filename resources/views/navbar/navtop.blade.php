
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
<!--                     <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>    -->
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-gear"></span></a>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Setting</h3>  
                            </div>
                            <div class="panel-body list-group list-group-contacts">
                                <a href="{{url('home/profile')}}" class="list-group-item">
                                    <div class="pull-left"><span class="fa fa-user"></span></div>
                                    <span class="contacts-title">User</span>
                                    <p>Profile Data User</p>
                                </a>
                                <a href="{{url('home/ganti_password')}}" class="list-group-item">
                                    <div class="pull-left"><span class="fa fa-desktop"></span></div>
                                    <span class="contacts-title">Account</span>
                                    <p>Ganti Password</p>
                                </a>
                                <a href="{{url('home/tampilan')}}" class="list-group-item">
                                    <div class="pull-left"><span class="fa fa-desktop"></span></div>
                                    <span class="contacts-title">Tampilan</span>
                                    <p>Setting Tampilan Program</p>
                                </a>
                            </div>     
<!--                             <div class="panel-footer text-center">
                                <a href="#">Setting Menu</a>
                            </div>  -->                           
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                   
                </ul>
                
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('home/logout') }}" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>