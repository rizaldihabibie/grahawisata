<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_fasilitas extends Model
{
    use SoftDeletes;
    protected $table = 'fasilitas';
    protected $fillable = ['id_fasilitas','nama_fasilitas','deleted_at' ];
    protected $primaryKey= 'id_fasilitas';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    protected function relasi_fasilitas(){
        return $this->hasMany('App\Model\M_relasi_fasilitas','id_fasilitas');
    }

    public function kelas_kamar(){
    	return $this->hasMany('App\Model\M_kelas_kamar');
    }

     //default fungsi model
    protected function madd(Request $parameter){
    	$hasil = $this::insert($parameter->except(['_token']));
    	return $hasil;
    }

    protected function mupdate(Request $parameter){
    	$hasil = $this::where('id_fasilitas',$parameter->id_fasilitas)->update($parameter->except(['_token','id_fasilitas']));
    	return $hasil;
    }

    protected function mdelt(Request $parameter){
        $hasil = $this::where('id_fasilitas',$parameter->id_fasilitas)->delete();
        return $hasil;
    } 

    protected function mlast_id(){
    	$last = $this::orderBy('id_fasilitas', 'desc')->take(1)->get();
    	foreach($last as $hasil){
    		return $hasil->id_fasilitas;
    	}
    }


    protected function mtotal(){
        $count = $this::withTrashed()->count();
        return $count;
    }

    protected function mgenerate_id(){
    	$count = $this::mtotal();
    	if($count<1){
    		$id = "fasilitas_0001";
    	}else{
    		$last = $this::mlast_id();
    		$akumulasi = sprintf("%04s", ((substr($last,10)+1)));
    		$id = "fasilitas_".$akumulasi;
    	}
    	return $id;
    }


}
