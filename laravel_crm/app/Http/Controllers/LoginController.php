<?php

namespace App\Http\Controllers;


use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;





class LoginController extends Controller
{
   public function login(Request $request){
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
//                $minutes = ceil((3600 - (time() - $arr['u_clear'])) / 60);
                if ($arr['u_error'] >= 5 ) {
                    return ['msg' => '已锁定,请找管理员解锁','code' => 5];
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
                        $id=$arr['u_id'];
                        $name=$arr['u_name'];
                    session('id',$id);
                    session('name',$name);
//                    $request->session()->put('id',$id);
//                    $request->session()->put('name',$name);
                        return ['msg'=>'登录成功','icon'=>1,'status'=>1];

                }
            }else{
               #密码错误
               #判断当前最后一次输入错误时间大约一个小时就不累加，否则就继续累加
               #当前时间
                $time = time();
                #错误次数
                $u_error = $arr['u_error'];


                #错误时间大于一个小时就把次数改成一
                if($time-$arr['u_clear']>3600){
                    $data=[
                        'u_error'=>1,
                        'u_clear'=>$time,
                        'utime'=>$time,
                    ];
                    $res1=$obj->getUpdate($arr['u_id'],$data);
                    if($res1){
                        return ['msg'=>'您还可以输入4次','icon'=>2,'status'=>2];
                    }
                }else{

                    if($u_error>=5){
                        $data = [
                            'u_error'=>0,
                            'u_clear'=>0,
                            'utime'=>$time,
                            'status'=>3
                        ];
                        $obj ->getUpdate($arr['u_id'],$data);
                        return ['msg'=>'您的账号已经被锁定，请找管理员解开','icon'=>2,'status'=>2];
                    }else{
                        $u_error++;
                        $data=[
                            'u_error'=>$u_error,
                            'u_clear'=>$time,
                            'utime'=>$time,
                        ];
                        $res2=$obj->getUpdate($arr['u_id'],$data);
                        if($res2){
                            return ['msg'=>'您还可以输入'.(5-$u_error).'次','icon'=>2,'status'=>2];
                        }
                    }




                }

            }

        }



    }
}
