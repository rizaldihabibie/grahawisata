<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_order extends Model
{
    //
    use SoftDeletes;
    protected $table = 'order';
    protected $fillable = ['id_pesanan','id_pengunjung','id_kamar','day_start','day_end',
    					   'checkin','checkout','kode_promo','jumlah_hari','jumlah_tamu',
    					   'total_harga','deleted_at' ];
    protected $primaryKey= 'id_pesanan';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    protected function madd(Request $parameter){
        $hasil = $this::insert($parameter->except(['_token','nama','telepon','alamat','email','id_kamar','jumlah_kamar','kode_promo']));
        return $hasil;
    }


    // public function fasilitas(){
    //     return $this->belongsToMany('App\Model\M_fasilitas','relasi_fasilitas','id_kelas','id_fasilitas')->withPivot('id_kelas','id_fasilitas');
    // }
    // public function pengguna(){
    //     return $this->hasManyThrough('App\Model\M_pengguna', 'App\Model\M_pengunjung');
    // }

    public function pengunjung(){
    	return $this->belongsTo('App\Model\M_pengunjung','id_pengunjung');
    }

    public function detail_reservasi(){
    	return $this->hasMany('App\Model\M_detail_reservasi','id_pesanan');
    }

    public function kamar(){
		return $this->belongsToMany('App\Model\M_kamar','detail_reservasi','id_pesanan','id_kamar');
    }

    protected function mlast_id(){
    	$last = $this::orderBy('id_pesanan', 'desc')->take(1)->get();
    	foreach($last as $hasil){
    		return $hasil->id_pesanan;
    	}
    }


    protected function mtotal(){
        $count = $this::withTrashed()->count();
        return $count;
    }

    protected function mgenerate_id(){
    	$count = $this::mtotal();
    	if($count<1){
    		$id = "order_000001";
    	}else{
    		$last = $this::mlast_id();
    		$akumulasi = sprintf("%06s", ((substr($last,6)+1)));
    		$id = "order_".$akumulasi;
    	}
    	return $id;
    }

}
