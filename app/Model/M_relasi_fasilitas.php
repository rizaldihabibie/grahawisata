<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_relasi_fasilitas extends Model
{
    //
    protected $table = 'relasi_fasilitas';
    protected $fillable = ['id_kelas','id_fasilitas'];
    protected $primaryKey= 'id_relasi_fasilitas';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
    //public $incrementing = false;

    // public function kelas_kamar(){
    //     return $this->belongsToMany('App\Model\M_kelas_kamar','id_kelas');
    // }


    // public function fasilitas(){
    //     return $this->belongsToMany('App\Model\M_fasilitas','id_fasilitas');
    // }

    // public function relation_kamar_fasilitas(){

    // }
    
     //default fungsi model
    protected function madd(Request $parameter){
        // $hasil = $this::insert($parameter->except(['_token','nama','harga']));
        $hasil;
        return $hasil;
    }

    protected function mupdate(Request $parameter){

    }

    protected function mdelt(){

    }   

}
