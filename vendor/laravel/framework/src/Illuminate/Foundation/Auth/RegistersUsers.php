<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all(),"add")->validate();
        //create setting user
        $setting = $this->create_setting($request);
        $id_setting = $setting->id_setting;
        if(!empty($id_setting) || $id_setting!= null){
            $request->request->add(['setting' => $id_setting]);
            event(new Registered($user = $this->create($request->all())));
            return $this->registered($request, $user)
                            ?: redirect('/home/daftar_pengguna')->with('success', "Data Pengguna Sukses Ditambahkan");
            
        }else{
            return redirect('/home/profile')->with('error_notif', "Terjadi kesalahan pada setting user");
        }
        // $register = event(new Registered($user = $this->create($request->all())));
        // $userid = $user->id;
        // // $this->guard()->login($user);

        // return $this->registered($request, $user)
        //                 ?: redirect('/home/daftar_pengguna')->with('success', "Data Pengguna Sukses Ditambahkan");
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
