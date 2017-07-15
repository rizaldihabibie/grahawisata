<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class M_roles extends Model
{
    //
    //
    use SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey= 'id_role';
    protected $fillable = ['id_role','privilege','deskripsi','gaji','deleted_at'];
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function pengguna(){
        return $this->belongsTo('App\Model\M_pengguna','id_role');
    }
}
