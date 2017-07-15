<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_detail_reservasi extends Model
{
    //
    use SoftDeletes;
    protected $table = 'detail_reservasi';
    protected $primaryKey= 'id_detail_rsv';
    protected $fillable = ['id_detail_rsv','id_pesanan','id_kamar','tanggal','deleted_at'];
    public $timestamps = false;
    protected $dates = ['deleted_at'];


    public function order(){
        return $this->belongsTo('App\Model\M_order','id_pesanan');
    }
    
    protected function madd(array $parameter){
        // $hasil = $this::create($parameter);
        $hasil = $this::insert($parameter);
        return $hasil;
    }
}
