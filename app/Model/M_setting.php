<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class M_setting extends Model
{
    //
    protected $table = 'setting';
    protected $primaryKey= 'id_setting';
    protected $fillable = ['id_setting','app_theme','app_layout'];
    public $timestamps = false;
    // protected $dates = ['deleted_at'];

    public function pengguna(){
    	return $this->belongsTo('App\Model\M_pengguna','id_setting');
    }


    protected function mupdate(Request $parameter){
    	$hasil = $this::where('id_setting',$parameter->id_setting)->update($parameter->except(['_token','id_setting']));
    	return $hasil;
    }
}
