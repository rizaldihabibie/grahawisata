<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_kelas_kamar extends Model
{
    //
    use SoftDeletes;
    protected $table = 'kelas_kamar';
    protected $fillable = ['id_kelas','nama','deskripsi','harga','deleted_at' ];
    protected $primaryKey= 'id_kelas';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    protected function kamar(){
    	return $this->hasMany('App\Model\M_kamar','id_kelas');
    }

    public function fasilitas(){
        return $this->belongsToMany('App\Model\M_fasilitas','relasi_fasilitas','id_kelas','id_fasilitas')->withPivot('id_kelas','id_fasilitas');
    }

    protected function relasi_fasilitas(){
        return $this->hasMany('App\Model\M_relasi_fasilitas','id_kelas');
    }

     //default fungsi model
    protected function madd(Request $parameter){
        $hasil = $this::insert($parameter->except(['_token','id_fasilitas']));
        return $hasil;
    }

    protected function mupdate(Request $parameter){
        // $hasil = $this::where('id_kelas',$parameter->id_kelas)->update($parameter->except(['_token','id_fasilitas']));
        $data = $this::where('id_kelas',$parameter->id_kelas)->first();
        $data->nama = $parameter->nama;
        $data->deskripsi = $parameter->deskripsi;
        $data->harga = $parameter->harga;
        $hasil = $data->save();
        return $hasil;
    }

    protected function mdelt(){

    } 

    protected function mlast_id(){
    	$last = $this::withTrashed()->orderBy('id_kelas', 'desc')->take(1)->get();
    	foreach($last as $hasil){
    		return $hasil->id_kelas;
    	}
    }


    protected function mtotal(){
    	$count = $this::withTrashed()->count();
    	return $count;
    }

    protected function mgenerate_id(){
    	$count = $this::mtotal();
    	if($count<1){
    		$id = "kelas_0001";
    	}else{
    		$last = $this::mlast_id();
    		$akumulasi = sprintf("%04s", ((substr($last,6)+1)));
    		$id = "kelas_".$akumulasi;
    	}
    	return $id;
    }
     //default fungsi model

     //custom fungsi model
    protected function mget_id_kelas_by_name($param){
       $kelas = $this::where('nama', $param)->get();
       foreach($kelas as $hasil){
            return $hasil->id_kelas;
       }
    }

     //custom fungsi model

}
