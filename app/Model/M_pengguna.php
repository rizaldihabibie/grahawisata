<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class M_pengguna extends Model
{
    // use Notifiable;
    protected $table = 'pengguna';
    protected $fillable = ['id','name','email','username', 'privilege','role',
    					   'password','alamat','telepon','foto',
    					   'pertanyaan_pemulih','jawaban_pemulih','setting','remember_token',
    					   'created_at','updated_at','activated','is_delete'];
    //protected $hidden = ['password','token'];
    // public $timestamps = false;
    
    public function role(){
        return $this->belongsTo('App\Model\M_roles','role','id_role');
    }

    public function has_role($role){
      if($this->role()->where('privilege',$role)->first()){
        return true;
      }
      return false;
    }

    public function setting(){
      return $this->hasOne('App\Model\M_setting','id_setting','setting');
    }

    protected function user_exist(){
    	$number_user = $this::count();
    	if($number_user < 1 ){
    		return false;
    	}else{
    		return true;
    	}
    }

    protected function autoregister(){
    	$exist = $this::user_exist();
    	if(!$exist){
    		$user = array('id'=>'1',
    					  'username'=>"admin",
                'name'=>"admin",
    					  'email'=>"manggalaraka@gmail.com",
                'privilege'=>"admin",
    					  'id_role'=>"1",
    					  'password'=>bcrypt("12345"),
                'alamat'=>"",
                'telepon'=>"",
                'foto'=>"",
                'pertanyaan_pemulih'=>"",
                'jawaban_pemulih'=>"",
                'remember_token'=>"",
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'activated'=>"yes",
                'is_delete'=>"no");
            $hasil = $this::add_user($user);
            return $hasil;
    	}else{
    		return false;
    	}
    }

    public function add_user(array $parameter){
            $hasil = $this::insert($parameter);
            return $hasil;        
    }

    protected function mupdate_photo($id,$filename){
        $hasil = $this::where('id',$id)->update(['foto'=>$filename]);
        return $hasil;
    }
    protected function mupdate_pass($id,$pass){
        $hasil = $this::where('id',$id)->update(['password'=>$pass]);
        return $hasil;
    }
    protected function mupdate_profile($id,$profile){
        $hasil = $this::where('id',$id)->update($profile);
        return $hasil;
    }
}
