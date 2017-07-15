<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\M_kelas_kamar;
use App\Model\M_kamar;
use Illuminate\Support\Facades\Validator;


class C_Kamar extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function act_add_kelas(KelasKamarRequest $request){
    	$id_kelas = M_kelas_kamar::mgenerate_id();
    }


    protected function validator(array $data,$action)
    {	   
    	if($action == "add"){
    		  $rules = array('jumlah_kamar'=> 'required|digits_between:1,2|numeric',
	            			'id_kelas'=> 'required');
        }else if($action == "edit"){
    		  $rules = array( 'id_kamar'=> 'required','unique:kamar,id_kamar'.$data['id_kelas'],
	            			  'id_kelas'=> 'required');
        }else if($action == "delete"){
			     $rules = array( 'id_kamar'=> 'required');  
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

    protected function add(Request $request){
			
			//validasi
	    	$this->validator($request->all(),"add")->validate(); 

	    	//insert kamar
	        $total = M_kamar::mtotal_by_kelas($request->id_kelas);
	        if($total < 1){
	            $start = 0;
	        }else{
	            $start = M_kamar::mlast_no_kamar_by_kelas($request->id_kelas);
	        }

	        for($i=($start+1); $i<=(($request->jumlah_kamar)+$start); $i++){
	            //insert to db
	            $data_no = array('id_kamar'=>M_kamar::mgenerate_id(),
	            				 'no_kamar'=>$i);
	            $request->request->add($data_no);
	            $hasil[] = M_kamar::madd($request);
	        }	 

	   		if(in_array(false,$hasil,true)){
				return redirect('/home/daftar_kelas')->with('error_notif', "Terjadi kesalahan Dalam Data Kamar");
	   		}else{
    			return redirect('/home/daftar_kelas')->with('success', "Data Kamar Berhasil Ditambahkan");
	   		}

    }  
}
