<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


trait ActionController{

    public  function validate_auth_privilege(Request $request){
        $actions = $request->route()->getAction();
        return $actions;
    }

}
