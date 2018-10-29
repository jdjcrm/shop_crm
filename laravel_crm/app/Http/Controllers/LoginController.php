<?php

namespace App\Http\Controllers;


use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;





class LoginController extends Controller
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
            'u_name'=>$name,
            'status'=>1
        ];
        $res=$obj->getSel($where);
        if(!$res){
            return ['msg'=>'此用户不存在','icon'=>5,'status'=>2];
        }else {
            foreach ($res as $k => $v) {
                $arr = $v;
            }
            $salt=$arr['salt'];
            $new_pwd=md5(md5($pwd).$salt);
//            echo $new_pwd;exit;
            if ($new_pwd == $arr['u_pwd']) {

                //算出还有多长时间登录
                $minutes = ceil((3600 - (time() - $arr['u_clear'])) / 60);
                if ($arr['u_error'] >= 5 && (time() - $arr['u_clear'] < 3600)) {
                    return ['msg' => '已锁定,还有' . $minutes . '分钟', 'code' => 5];
                }else{
                    //加盐值
                    $str = "qwertyuiopasdfghjklzxcvbnm;@%+-*/1234567890";
                    //截取盐值
                    $salt = substr(str_shuffle($str), rand(0, 30), 5);
                    $pwds=md5(md5($pwd).$salt);
                    $data=[
                        'u_error'=>0,
                        'u_clear'=>0,
                        'salt'=>$salt,
                        'ctime'=>time(),
                        'u_pwd'=>$pwds
                    ];
                    $obj->getUpdate($arr['u_id'],$data);
                        return ['msg'=>'登录成功','icon'=>1,'status'=>1];

                }
            }else{
                echo '密码不正确';

            }
//            return ['msg'=>'登录成功','icon'=>1,'status'=>1];
        }



    }
}
