<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_pengunjung extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pengunjung';
    protected $fillable = ['id_pengunjung','nama','telepon',
    					   'alamat','deleted_at'];
    protected $primaryKey= 'id_pengunjung';
    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    protected function madd(Request $request){
        $add = $this->updateOrCreate(array('id_pengunjung'=>$request->id_pengunjung),array('nama'=>$request->nama,
                                                                                'telepon'=>$request->telepon,
                                                                                'alamat'=>$request->alamat));
        if($this->find($request->id_pengunjung)){
        		return true;
        }else{
        		return false;
        }

        // return $this->find($request->id_pengunjung);
    }
}
