
    @if (Auth::check())
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">

                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <?php if(Auth::user()->foto == ""){ $foto = 'profile_default.jpg'; }else{ $foto = Auth::user()->foto; } ?>
                            <img src="<?php echo URL::asset('../storage/app/image/profile_picture/')."/".$foto;?>" alt=""/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <?php if(Auth::user()->foto == ""){ $foto = 'profile_default.jpg'; }else{ $foto = Auth::user()->foto; } ?>
                                <img src="<?php echo URL::asset('../storage/app/image/profile_picture/')."/".$foto;?>" alt=""/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><p>username as {{Auth::user()->username}}</p></div>
                            </div>
                        </div>                                                                        
                    </li>

                @if (Auth::user()->role == 1)
                    <li class="xn-title"> Halaman Utama</li>          
                    <li class="">
                        <a href="{{ url('home') }}"><span class="fa fa-home"></span> <span class="xn-text">Dashboard</span></a> 
                    </li>

                    <li class="xn-title">Kepegawaian</li>          
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Kelola Pegawai</span></a>
                        <ul>
                            <li><a href="{{ url('home/daftar_pengguna') }}"><span class="fa fa-user"></span>Data Pegawai</a></li>
                         <!--    <li><a href="#"><span class="fa fa-image"></span>Data Pegawai</a></li>
                            <li><a href="#"><span class="fa fa-desktop"></span> Log User</a> </li>    -->   
                        </ul>   
                    </li>


                    <li class="xn-title">Keuangan</li>     
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Detail Pesanan</span></a>
                        <ul>
                            <li><a href="{{ url('home/pemasukan/all') }}">Data Pemasukan</a></li>
                        </ul>
                    </li>          
                   <!--  <li class="xn-openable">
                        <a href="#"><span class="fa fa-edit"></span> <span class="xn-text">Pengeluaran</span></a>
                        <ul>
                            <li><a href="#">Tambah Pengeluaran</a></li>
                            <li><a href="">Data Pembelian</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-desktop"></span> <span class="xn-text">Neraca Keuangan</span></a>                        
                    </li>   -->

                    <li class="xn-title">Fasilitas</li> 
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-edit"></span> <span class="xn-text">Kelola Fasilitas</span></a>
                        <ul>
                            <li><a href="{{ url('home/daftar_fasilitas') }}"> Daftar Fasilitas</span></a></li>    
                        </ul>
                    </li>  


                    <li class="xn-title">Layanan</li>          
                    <li>
                        <a href="{{ url('/home/pesan_kamar') }}"><span class="fa fa-files-o"></span> <span class="xn-text">Pesan Kamar</span></a>
                    </li>          
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-edit"></span> <span class="xn-text">Kelola Layanan</span></a>
                        <ul>
                            <li><a href="{{ url('home/daftar_kelas') }}"> Daftar Kelas Kamar</span></a></li>  
                            <!-- <li><a href="{{ url('home/daftar_fasilitas') }}"> Daftar Fasilitas</span></a></li>   -->
                            <li><a href="{{ url('home/daftar_promo') }}"> Daftar Promo</span></a></li>  
                        </ul>
                    </li>  

                    
                @else
                    <li>
                        <a href=""><span class="fa fa-files-o"></span> <span class="xn-text">Logout</span></a>
                    </li>         
                @endif
                

                </ul>
                <!-- END X-NAVIGATION -->
            </div>
    @endif