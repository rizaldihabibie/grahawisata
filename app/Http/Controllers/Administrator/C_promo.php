<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\M_promo;

class C_promo extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    protected function validator(array $data,$action)
    {	   
    	if($action == "add"){

			  if($data['promo_setting'] == "by_percent"){
				$rules_val = 'required|between:0,100|numeric';
				$rules_max = 'required|numeric';
			  }else{
				$rules_val = 'required|digits_between:1,6';
				$rules_max = 'required|numeric|same:promo_value';
			  }

    		  $rules = array( 'kode_promo'=> 'required|unique:promo,kode_promo|min:4',
	            			  'promo_setting'=> 'required',
	            			  'promo_value'=>$rules_val,
	            			  'discount_max'=>$rules_max,
	            			  'price_min'=>'required|numeric',
	            			  'start'=>'required|date',
	            			  'end'=>'required|date');

        }else if($action == "edit"){

			  if($data['promo_setting'] == "by_percent"){
				$rules_val = 'required|between:0,100|numeric';
			  }else{
				$rules_val = 'required|digits_between:1,6';
			  }

    		  $rules = array( 'kode_promo'=> 'required|between:4,25','unique:promo,kode_promo'.$data['kode_promo'],
	            			  'promo_setting'=> 'required',
	            			  'promo_value'=>$rules_val,
	            			  'discount_max'=>'required|numeric',
	            			  'price_min'=>'required|numeric',
	            			  'start'=>'required|date',
	            			  'end'=>'required|date');

        }else if($action == "delete"){
			     $rules = array( 'kode_promo'=> 'required');  
        }

        $messages = [
        'required' => 'kolom :attribute harus diisi',
        'alpha'=> 'kolom :attribute harus berupa text',
        'alpha-numeric'=> 'kolom :attribute harus berupa text dan angka',
        'unique' => 'kolom :attribute telah digunakan',
        'min' => 'kolom :attribute minimal terdiri dari :min karakter',
        'numeric'=> 'kolom :attribute harus berisi angka',
        'between'=> 'kolom :attribute harus berisii :min sampai :max',
        'date'=> 'kolom :attribute harus berisi tanggal',
        'digits_between'=> 'kolom :attribute harus terdiri :min sampai :max karakter',
        'same'=> 'kolom :attribute harus sama dengan kolom :other',
        ];

        return Validator::make($data,$rules,$messages);
    }

    protected function tas_promo(){
    	return "ini tes promo";
    }

    protected function add(Request $request){
			//validasi
	    	$this->validator($request->all(),"add")->validate();
	   		
	   		// insert

	   		//insert promo
	    	$insert = M_promo::madd($request);
	    	if($insert){
	    		return redirect('/home/daftar_promo')->with('success', "Data Promo Berhasil Ditambahkan");
	    	}else{
	    		return redirect('/home/daftar_promo')->with('error_notif', "Data Promo Gagal Ditambahkan");
	    	}
    } 

    protected function update(Request $request){
			//validasi
	    	$this->validator($request->all(),"edit")->validate();
	   		
	   		// update

	   		//update promo
	    	$update = M_promo::mupdate($request);
    }

    protected function delete(Request $request){
			//validasi
	    	$this->validator($request->all(),"delete")->validate();
	        $delete = M_promo::mdelt($request); 
	        if($delete){
	          return redirect('/home/daftar_promo')->with('success', "Data Promo Berhasil Dihapus");
	        }else{
	          return redirect('/home/daftar_promo')->with('error_notif', "Data Promo Gagal Dihapus");
	        }  
    }

}
