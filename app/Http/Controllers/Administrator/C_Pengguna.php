<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash ;
use App\Model\M_pengunjung;
use App\Model\M_pengguna;
use App\Model\M_setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use session;
use Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\ActionController;
class C_Pengguna extends Controller
{



    use RegistersUsers,ActionController;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('auth');
    }




    protected function validator(array $data,$action){	   
    	if($action == "add"){
    		 	$rules = array( // data personal pengguna
    		 					'name'=> 'required|min:5|unique:pengguna,name',
    		 					'username'=>'required|min:5|unique:pengguna,username',
    		 					'email'=>'required|email|unique:pengguna,email',
    		 					'role'=>'required',
    		 					'telepon'=>'numeric|min:7',
    		 					'password'=> 'required|min:8',
    		 					'ulangi_password'=> 'required|min:8|same:password');
        }else if($action == "edit"){
    		  	$rules = null;
        }else if($action == "edit_privilege"){
        		$rules = array('name'=> 'required',
    		 				  'privilege'=>'required');
        }else if($action == "ubah_password"){
                $rules = array('password_lama'=> 'required',
                               'password'=>'required|min:5',
                               'password_konfirmasi'=>'required|min:5|same:password');
    	}else if($action == "upload_profile_pic"){
    			$rules = array('photo' => ['mimes:jpg,jpeg,JPEG,png,gif,bmp', 'max:1024']);
    	}elseif($action == "edit_tampilan"){
                $rules = array('app_theme'=> 'required');
        }else if($action == "delete"){
			    $rules = null;  
        }

        $messages = [
        'required' => 'kolom :attribute harus diisi',
        'alpha'=> 'kolom :attribute harus berupa text',
        'unique' => 'kolom :attribute telah digunakan',
        'min' => 'kolom :attribute minimal terdiri dari :min karakter',
        'numeric'=> 'kolom :attribute harus berisi angka',
        'digits_between'=> 'kolom :attribute harus terdiri :min sampai :max karakter',
        'digits'=>'kolom :attribute harus terdiri dari :value karakter',
        'date_format'=>'periksa format tanggal kolom :attribute',
        'same'=>'format kolom ulangi password harus sama dengan kolom password'
        ];

        return Validator::make($data,$rules,$messages);
    } 

    protected function create(array $data){
        return M_pengguna::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role'=> $data['role'],
            'telepon'=> $data['telepon'],
            'setting'=> $data['setting']
        ]);
    }

    protected function create_setting(Request $request){
        if($request->role == '3' || $request->role == '4'){
            $layout = "page-container-boxed";
        }else{
             $layout = null;
        }

        return M_setting::create([
        	'app_layout'=>$layout
        ]);
    }

    protected function upload_photo(Request $request){
    	if($request->hasFile('photo')){
    		$this->validator($request->all(),"upload_profile_pic")->validate();

    		//destinasi path
    		$destinasi = base_path().'\public\image\profile_picture';
    		//proses upload
    		$file_extension = $request->file('photo')->guessExtension();
    		$filename = 'profile_pic_'.Auth::user()->id.".".$file_extension;
    		$upload = $request->file('photo')->storeAs('image/profile_picture',$filename);
    		if($upload){
    			//save to db
    			M_pengguna::mupdate_photo(Auth::user()->id,$filename);
    			// unset(Auth::user()->foto);
    			return redirect('/home/profile')->with('success', "Foto Profile Berhasil Diperbaharui");
    		}else{
    			return redirect('/home/profile')->with('error_notif', "Terjadi kesalahan saat upload foto upload");
    		}

    	}else{
    		return redirect('/home/profile')->with('error_notif', "Tidak ada file foto yang akan di upload");
    	}
    }

	
	protected function edit_privilege(Request $request){

	        $method_alias = $this->validate_auth_privilege($request);
	        if (Gate::denies($method_alias['as'], $request)) {
	            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
	        }

			//validasi
	    	$this->validator($request->all(),"edit_privilege")->validate();

	    	$data_pengguna = M_pengguna::with('role')->where('name',$request->name);
	    	// echo json_encode($request->all());
	    	if($data_pengguna->get()->count()==1){
	    		foreach($data_pengguna->get() as $hasil){
	    			$data_user = $hasil->toArray();
	    			if($data_user['role']['privilege'] != "admin"){
	    				$hasil = $data_pengguna->update(['role' => $request->privilege]);
	    				if($hasil){
	    					return redirect('/home/daftar_pengguna')->with('success', "privilege user sukses diubah");
	    				}else{
	    					$report = "privilege user gagal diubah";
	    				}
	    			}else{
	    				$report = "tidak bisa mengubah privilege admin";
	    			}
	    		}
	    	}else{
	    		$report = "terjadi kesalahan pada data user - multiple user found / user not found";
	    	}

	    	return redirect('/home/daftar_pengguna')->with('error_notif', $report);

	}

    protected function edit_tampilan(Request $request){
            //validasi
            $this->validator($request->all(),"edit_tampilan")->validate();


            //add some attribute for data
            $data = array('id_setting'=>Auth::user()->setting);
            $request->request->add($data);

            //update
            $hasil = M_setting::mupdate($request);
            if($hasil){
                return redirect('/home/tampilan')->with('success', "Setting tampilan sukses diubah");
            }else{
                return redirect('/home/tampilan')->with('error_notif', "Setting tampilan gagal diubah");
            }
    }

    protected function ubah_password(Request $request){
            //validasi
            $this->validator($request->all(),"ubah_password")->validate();

            //check password lama benar apa salah
            $old_pass = $request->password_lama;
            if(Hash::check($old_pass, Auth::user()->password)){
                $new_pass = Hash::make($request->password);
                $hasil = M_pengguna::mupdate_pass(Auth::user()->id,$new_pass);
                if($hasil){
                    return redirect('/home/ganti_password')->with('success', "Password sukses diubah");
                }else{
                    return redirect('/home/ganti_password')->with('error_notif', "Terjadi kesalahan password gagal diubah");
                }
            }else{
                return redirect('/home/ganti_password')->with('error_notif', "Password salah");
            }

    }

    protected function ubah_profile(Request $request){
            //validasi
            // $this->validator($request->all(),"ubah_profile")->validate();

            //check password lama benar apa salah
            $name       = $request->name;
            $username   = $request->username;
            $email      = $request->email;
            $alamat     = $request->alamat;
            $telepon    = $request->telepon;
            $data = array( 'name'=>$name,
                           'username'=>$username,
                           'email'=>$email,
                           'alamat'=>$alamat,
                           'telepon'=>$telepon
                        );

                // $new_pass = Hash::make($request->password);
                $hasil = M_pengguna::mupdate_profile(Auth::user()->id,$data);
                if($hasil){
                    return redirect('/home/edit_pengguna')->with('success', "data sukses diubah");
                }else{
                    return redirect('/home/editpengguna')->with('error_notif', "Terjadi kesalahan data gagal diubah");
                }

    }

}
