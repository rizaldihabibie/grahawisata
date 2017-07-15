<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_kamar extends Model
{
    use SoftDeletes;
    //
    protected $table = 'kamar';
    protected $fillable = ['id_kamar','id_kelas','no_kamar','deleted_at' ];
    protected $primaryKey= 'id_kamar';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function kelas_kamar(){
        return $this->belongsTo('App\Model\M_kelas_kamar','id_kelas');
    }

    //default fungsi model
    protected function madd(Request $parameter){
        $hasil = $this::insert($parameter->except(['_token','jumlah_kamar','nama_kamar']));
        return $hasil;
    }

    protected function medit(){

    }

    protected function mdelt(){

    } 

    protected function mlast_id(){
    	$last = $this::withTrashed()->orderBy('id_kamar', 'desc')->take(1)->get();
    	foreach($last as $hasil){
    		return $hasil->id_kamar;
    	}
    }


    protected function mtotal(){
        $count = $this::withTrashed()->count();
        return $count;
    }

    protected function mgenerate_id(){
        //max kamar adalah xxxxx atau 5 digit
    	$count = $this::mtotal();
    	if($count<1){
    		$id = "kamar_00001";
    	}else{
    		$last = $this::mlast_id();
    		$akumulasi = sprintf("%05s", ((substr($last,6)+1)));
    		$id = "kamar_".$akumulasi;
    	}
    	return $id;
    }
    //default fungsi model

    //custom fungsi model

    protected function mtotal_by_kelas($param){
        $count = $this::where('id_kelas', $param)->count();
        return $count;
    }    

    protected function mlast_no_kamar_by_kelas($param){
        $last = $this::withTrashed()->where('id_kelas', $param)->orderBy('id_kamar', 'desc')->take(1)->get();
        foreach($last as $hasil){
            return $hasil->no_kamar;
        }
    }

}
