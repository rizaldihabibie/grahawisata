<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\M_fasilitas;
// use App\Http\Requests\KelasKamarRequest; 
use Illuminate\Support\Facades\Validator;

class C_Fasilitas extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    protected function validator(array $data,$action)
    {	   
    	if($action == "add"){
    		  $rules = array( 'id_fasilitas'=> 'required|unique:fasilitas,id_fasilitas',
	            			'nama_fasilitas'=> 'required|unique:fasilitas,nama_fasilitas|min:2',
	            			'is_delete'=> 'required');
        }else if($action == "edit"){
    		  $rules = array( 'id_fasilitas'=> 'required','unique:fasilitas,id_fasilitas'.$data['id_fasilitas'],
	            			'nama_fasilitas'=> 'required|min:2','unique:fasilitas,nama_fasilitas'.$data['id_fasilitas']);
        }else if($action == "delete"){
			     $rules = array( 'id_fasilitas'=> 'required');  
        }

        $messages = [
        'required' => 'kolom :attribute harus diisi',
        'alpha'=> 'kolom :attribute harus berupa text',
        'unique' => 'kolom :attribute telah digunakan',
        'min' => 'kolom :attribute minimal terdiri dari :min karakter',
        'numeric'=> 'kolom :attribute harus berisi angka',
        'digits_between'=> 'kolom :attribute harus terdiri :min sampai :max karakter'
        ];

        return Validator::make($data,$rules,$messages);
    }

    protected function ajax_get_fasilitas_by_id(Request $request){ 	
           if($request->ajax()){
           		$hasil = $this->fasilitas_by_id($request);
           		if($hasil){
           			$hasil['mssg_report'] = "sukses";
           			return response()->json($hasil,200);
           		}else{
           			$hasil['mssg_report'] = "error on return data fasilitas";
           			return response()->json($hasil,200);
           		}
            }
			    // $msg = false;
			    // return response()->json(array('msg'=> $msg), 200); 

            return redirect('/home');

    }

    protected function fasilitas_by_id(Request $request){    	
    	$hasil = M_fasilitas::where('id_fasilitas', $request->id)->get();
    	return $hasil;	
    }

    protected function add(Request $request){
			//add some attribute for data
	    	$data = array('id_fasilitas'=>M_Fasilitas::mgenerate_id(),'is_delete'=>'no');
	    	$request->request->add($data);
			
			//validasi
	    	$this->validator($request->all(),"add")->validate();
	   		
	   		// insert
	    	$insert = M_Fasilitas::madd($request);
	    	if($insert){
	    		return redirect('/home/daftar_fasilitas')->with('success', "Data Fasilitas Berhasil Ditambahkan");
	    	}else{
	    		return redirect('/home/daftar_fasilitas')->with('error_notif', "Data Fasilitas Gagal Ditambahkan");
	    	}
    } 

    protected function update(Request $request){
			//validasi
	    	$this->validator($request->all(),"edit")->validate();	   		
	   		// update
	    	$update = M_Fasilitas::mupdate($request);
	    	if($update){
	    		return redirect('/home/daftar_fasilitas')->with('success', "Data Fasilitas Berhasil Diupdate");
	    	}else{
	    		return redirect('/home/daftar_fasilitas')->with('error_notif', "Data Fasilitas Gagal Diupdate");
	    	}


    }   

    protected function delete(Request $request){
			//validasi
	    	$this->validator($request->all(),"delete")->validate(); 
        $delete = M_fasilitas::mdelt($request); 
        if($delete){
          return redirect('/home/daftar_fasilitas')->with('success', "Data Fasilitas Berhasil Dihapus");
        }else{
          return redirect('/home/daftar_fasilitas')->with('error_notif', "Data Fasilitas Gagal Dihapus");
        }  	
    }
}
