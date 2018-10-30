<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;

#贾东杰做通讯录
class CommunicateController extends Controller
{
    #通讯录首页
   public function communicate(Request $request){
       $obj = new User();
       $where = [
           'status'=>1
       ];
      $arr = $obj->getSel($where);
       $count=$obj -> count($where);
       return view('crm.communicate',['arr'=>$arr,'count'=>$count]);
   }

    #查询
    public function page(Request $request){
      $name = $request -> input('name');
        $obj=new User();
        $arr=$obj->like($name);
        return $arr;
    }
    #分页
    public function sear(Request $request){
        $p = $request -> input('p');
        $name = $request -> input('name');
        $obj = new User();

        if(empty($name)){
            $where = [
                'status'=>1
            ];
        }else{
            $where = [
                'real_name'=>$name,
                'status'=>1
            ];
        }
        $arr=$obj->getAdminList($p,$where);

        return $arr;
    }

}
