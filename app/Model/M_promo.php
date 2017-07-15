<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_promo extends Model
{
    use SoftDeletes;
    protected $table = 'promo';
    protected $fillable = ['kode_promo', 'promo_value','promo_setting','discount_max','price_min','keterangan','start',
    					   'end','deleted_at'];
    protected $primaryKey= 'kode_promo';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

     //default fungsi model
    protected function madd(Request $parameter){
    	$hasil = $this::insert($parameter->except(['_token']));
    	return $hasil;
    }

    protected function mupdate(Request $parameter){
    	$hasil;
    	return $hasil;
    }

    protected function mdelt(Request $parameter){
        $hasil = $this::where('kode_promo',$parameter->kode_promo)->delete();
        return $hasil;
    } 


}
