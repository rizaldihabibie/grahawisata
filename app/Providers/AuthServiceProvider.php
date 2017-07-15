<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Model\M_roles;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
 
        Gate::define('daftar_pengguna', function () {
            $hasil = $this->cek_user();
            return $hasil;
        }); 

        Gate::define('tambah_pengguna', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('edit_pengguna', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('edit_privilege', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('daftar_fasilitas', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('daftar_kelas', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });


        Gate::define('tambah_kelas', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('edit_kelas', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });

        Gate::define('daftar_promo', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });      
          
        Gate::define('pesan_kamar', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });
          
        Gate::define('search_kamar', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });
          
        Gate::define('booking', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });        
          
        Gate::define('pemasukan', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });  
          
        Gate::define('pengeluaran', function () {
            $hasil = $this->cek_user();
            return $hasil;
        });       

        // daftar_fasilitas
        // daftar_kelas
        // tambah_kelas
        // edit_kelas
        // daftar_promo
        // pesan_kamar
        // search_kamar
        // booking
        // pemasukan


    }

    protected function cek_user(){
            $data_route = Route::getCurrentRoute()->action;
            if(!array_key_exists('roles', $data_route)){
                return false;
            }

            if(count($data_route['roles']>0)){
                $role = M_roles::where('id_role',Auth::user()->role)->get()->pluck('privilege');
                for($i=0; $i<count($data_route['roles']); $i++){
                    // if(Auth::user()->privilege == $data_route['roles'][$i]){
                    if($role[0] == $data_route['roles'][$i]){
                        return true;
                        break;
                    }
                }
            }else{
                return false;
            }
    }
}
