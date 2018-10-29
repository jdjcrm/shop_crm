<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
   public function login(){
       return view('crm.login');
   }

    public function login_do(Request $request){
        $name = $request -> input('name');
        $pwd = $request -> input('pwd');

        if(empty($name)){
            return ['msg'=>'名字不能为空','icon'=>5,'status'=>2];
        }
        if(empty($pwd)){
            return ['msg'=>'密码不能为空','icon'=>5,'status'=>2];
        }

        return ['msg'=>'登录成功','icon'=>1,'status'=>1];
    }
}
