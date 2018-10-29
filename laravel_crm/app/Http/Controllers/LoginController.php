<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;

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
        $obj=new User();
        $where = [
            'u_name'=>$name
        ];
        $res=$obj->gitSel($where);
        print_r($res);exit;
        if(!$res){
            return ['msg'=>'此用户不存在','icon'=>5,'status'=>2];
        }
        return ['msg'=>'登录成功','icon'=>1,'status'=>1];
    }
}
