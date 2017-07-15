<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\M_pengguna;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('revalidate');
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index(){

         $data_array = array('MainTitle'=>"Halaman Login",
                             'FormTitle'=>" System GrahaWisata");

        $exist =  M_pengguna::user_exist();
        if($exist){
            if(auth::check()){
                return redirect()->intended('/home');
            }else{
                // return view('auth/login',$data_array);
                // echo bcrypt("qwertyuiop12345");
                return view('content/VContentLogin',$data_array);
            }
        }else{
            //do autoregister
            $autoregister = M_pengguna::autoregister();
            if($autoregister){
                return redirect('/formlogin');
            }else{
                echo "autoregister failed";
            }
        }
    }
}
