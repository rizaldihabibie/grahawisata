<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\M_kelas_kamar;
use App\Model\M_relasi_fasilitas;
use Illuminate\Support\Facades\Validator;

class C_Kelas extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    protected function validator(array $data,$action)
    {	   
    	$attributeNames = array('id_kelas' => 'id kelas',
								'nama' => 'nama kamar',
								'harga' => 'harga kamar',
								'id_fasilitas' => 'fasilitas kamar');

    	if($action == "add"){
    		$rules = array( 'id_kelas'=> 'required|unique:kelas_kamar,id_kelas',
	            			'nama'=> 'required|unique:kelas_kamar,nama|min:2|alpha',
	            			'harga'=> 'required|numeric|digits_between:2,10',
	            			'id_fasilitas'=> 'required|distinct');
        }else if($action == "edit"){
    		$rules = array( 'id_kelas'=> 'required','unique:kelas_kamar,id_kelas'.$data['id_kelas'],
	            			'nama'=> 'required',
	            			'harga'=> 'required|numeric|digits_between:2,10',
	            			'id_fasilitas'=> 'required');
        }else if($action == "delete"){
    		$rules = array( 'id_kelas'=> 'required');
        }

        $messages = [
        'alpha'=> 'kolom :attribute harus berupa text',
        'distinct'=> 'kolom :attribute tidak boleh sama',
        'required' => 'kolom :attribute harus diisi',
        'unique' => 'kolom :attribute telah digunakan',
        'min' => 'kolom :attribute minimal terdiri dari :min karakter',
        'numeric'=> 'kolom :attribute harus berisi angka',
        'digits_between'=> 'kolom :attribute harus terdiri :min sampai :max karakter'
		];
		
         $validator = Validator::make($data,$rules,$messages);
         return $validator->setAttributeNames($attributeNames);
    }

    protected function add(Request $request){
			//add some attribute for data
	    	$data = array('id_kelas'=>M_kelas_kamar::mgenerate_id());
	    	$request->request->add($data);
			
			//validasi
	    	$this->validator($request->all(),"add")->validate();
	   		
	   		// insert

	   		//insert kelas
	    	$insert = M_kelas_kamar::madd($request);
	    	if($insert){
		   		//insert relasi fasilitas
		   		for($i=0; $i<count($request->id_fasilitas); $i++){
		   			$relasi_fasilitas = new M_relasi_fasilitas;
		   			$relasi_fasilitas->id_kelas = $request->id_kelas;
		   			$relasi_fasilitas->id_fasilitas = $request->id_fasilitas[$i];
		   			$hasil[] = $relasi_fasilitas->save();
		   		}

		   		if(in_array(false,$hasil,true)){
					return redirect('/home/tambah_kelas')->with('error_notif', "Terjadi kesalahan dalam data fasilitas");
		   		}else{
	    			return redirect('/home/tambah_kelas')->with('success', "Data Kelas Kamar Berhasil Ditambahkan");
		   		}

	    	}else{
	    		return redirect('/home/tambah_kelas')->with('error_notif', "Data Kelas Kamar Gagal Ditambahkan");
	    	}

    } 

    protected function update(Request $request,$id_kelas){
			//add some attribute for data
	    	$data = array('id_kelas'=>$id_kelas);
	    	$request->request->add($data);

			//validasi
	    	$this->validator($request->all(),"edit")->validate();


	   		// update
	   		$update = M_kelas_kamar::mupdate($request);
	   		if($update){
		   		//update relasi fasilitas
		   		$kelas_kamar = M_kelas_kamar::find($id_kelas);
		   		for($i=0; $i<count($request->id_fasilitas); $i++){
		   			$facility[] = $request->id_fasilitas[$i];
		   		}

		   		$hasil = $kelas_kamar->fasilitas()->sync($facility);
	    		return redirect('/home/daftar_kelas')->with('success', "Data Kelas Kamar Berhasil Diubah");				

	   		}else{
				return redirect('/home/edit_kelas/'.$id_kelas)->with('error_notif', "Data Kelas Kamar Gagal Diubah");	   			
	   		}
    }   

    protected function delete(Request $request){
			//validasi
	    	$this->validator($request->all(),"delete")->validate();

	    	// delete 	
    }
}
