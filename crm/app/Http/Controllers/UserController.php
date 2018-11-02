<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use think\console\input;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * 编写人 ：  贾海洋
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * 用户添加  user_add
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function user_add()
    {
        return view('user.user_add');
    }

    /**
     * 执行添加
     * @param Request $request
     * @return bool|\Illuminate\Database\Eloquent\Model|int|null|object|static
     */
    public function user_add_do(Request $request)
    {
        //接收用户添加的值
        $u_name = $request->post("u_name");

        $where = [
            'u_name' => $u_name
        ];

        $id = DB::table("crm_user")->where($where)->first();

        //判断是否存在
        if($id){

            return false;

        }else{

            $real_name = $request->post("real_name");
            $pwd1 = $request->post("pwd");
            $tel = $request->post("tel");
            $email = $request->post("email");
            $u_section = $request->post("u_section");
            $str="1234567890qwertyuiopasdfghjklzxcvbnm";
            $salt=substr(str_shuffle($str),rand(0,20),4);
            $pwd = md5(md5($pwd1).$salt);

            $data = [
                'u_name' => $u_name,
                'real_name' => $real_name,
                'u_pwd' => $pwd,
                'ctime'=>time(),
                'status'=> 1,
                'u_tel' => $tel,
                'salt' => $salt,
                'u_email' => $email,
                'u_section'=>$u_section,

            ];

            $id = DB::table('crm_user')->insertGetId($data);
            return $id;
        }




    }

    /**
     * 用户展示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function userShow(Request $request)
    {
        $p= 1;

        $where = [
            'status'=>1
        ];

        $count = DB::table("crm_user")->count();

        $data = $this->getUserList($p,$where);

        return view("user.userShow",['data'=>$data,'count'=>$count]);

    }

    /**
     *  用户展示分页
     * @param Request $request
     * @return string
     */
    public function user_show_page(Request $request){
        $p = $request -> get('p');

        $where = [
            'status'=>1
        ];

        $data = $this -> getUserList($p,$where);

        return json_encode($data->toArray(),true);
    }


    /**
     * 用户分页的方法
     * @param int $p
     * @param $where
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserList($p=1,$where){
        $pageName='page';

        $data = DB::table("crm_user")->where($where)->paginate(3,["*"],$pageName,$p);

        return $data;
    }



    /**
     * 用户修改
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function userUpdate(Request $request)
    {
        $u_id = $request ->get("u_id");

        $data = DB::table("crm_user") -> where(['u_id'=>$u_id]) -> first();

        return view("user.userUpdate",['data'=>$data]);
    }

    /**
     * 执行修改
     * @param Request $request
     * @return bool
     */
    public function user_update_do(Request $request){

        $u_id = $request ->post('u_id');
        $u_name = $request->post("u_name");
        $real_name = $request->post("real_name");
        $tel = $request->post("tel");
        $email = $request->post("email");
        $u_section = $request->post("u_section");

        $data= [
            'u_name'=>$u_name,
            'real_name'=>$real_name,
            'u_tel'=>$tel,
            'u_email'=>$email,
            'u_section'=>$u_section,
            'utime'=>time()
        ];

        $res  = DB::table("crm_user") -> where(['u_id'=>$u_id]) -> update($data);
        if($res){
            return 1;
        }else{
            return false;
        }
    }

    /**
     * 用户删除
     * @param Request $request
     * @return bool|int
     */
     public function userDelete(Request $request)
    {
        $u_id = $request -> post("u_id");
        if($u_id){
            $res = DB::table('crm_user')
                ->where(['u_id'=> $u_id])
                ->update(['status' => 2]);
            if($res == ''){
                $res = false;
            }
            return $res;
        }else{
            return false;
        }

    }

}
