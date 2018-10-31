<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Client;

#贾东杰做回收站
class RecycleController extends Controller
{
    #回收站首页
   public function recycle(Request $request){
        $obj=new User();
       $res=$obj->Select();
       $obj = new Client();
       $where= [
           'status'=>2
       ];
       $arr= $obj->selDel($where);

       $where2 = [
           'status'=>2
       ];


       foreach($res as $k=>$v){
           foreach($arr as $key=>$val){
               if($val['u_id'] == $v['u_id']){
                   $arr[$key]['u_id']=$v['real_name'];
               }
           }
       }
       $sel=new Client();
       $count=$sel -> count($where2);
       return view('crm.recyle',['res'=>$res,'arr'=>$arr,'count'=>$count]);
   }

    public function recycle_do(Request $request){
       $gid = $request->input('gid');
        # 0是全部删除，1是今天删除，2是一周删除，3是一个月删除
        $time = time();
        $obj = new Client();
            $where= [
                'status'=>2
            ];
        $arr= $obj->selDel($where);
        $user=new User();
        foreach($arr as $k=>$v){
            $id[]=$v['u_id'];

        }
        $res=$user->where_sel($id);
        foreach($res as $k=>$v){
            foreach($arr as $key=>$val){
                if($val['u_id'] == $v['u_id']){
                    $arr[$key]['u_id']=$v['real_name'];
                }

            }
        }

        if($gid == 0){
            $data = $arr;
            foreach($data as $k=>$v){
            $data[$k]['utime']=date('Y-m-d H:i:s',$v['utime']);
        }
            return $data;
        }

        $data = [];
        if($gid == 1){
            foreach($arr as $k=>$v){
               if($time - $v['utime'] < 86400){
                   $data[]= $v;
                }

            }
        }


        if($gid == 2){
            foreach($arr as $k=>$v){
                if($time - $v['utime'] < 604800){
                    $data[]= $v;

                }
            }
        }

        if($gid == 3){
            foreach($arr as $k=>$v){
                if($time - $v['utime'] < 2592000){
                    $data[]= $v;

                }
            }
        }
        foreach($data as $k=>$v){
            $data[$k]['utime']=date('Y-m-d H:i:s',$v['utime']);
        }
        return $data;

    }

    #修改
    public function recycle_update(Request $request){
        $id=$request -> input('id');
        $obj = new Client();
        $where = [
            'status'=>1
        ];
        $res=$obj ->getupdate($id,$where);
        if($res){
            return ['msg'=>'还原成功','code'=>1,'status'=>1];
        }else{
            return ['msg'=>'还原失败','code'=>2,'status'=>2];
        }
    }
    #删除
    public function recycle_del(Request $request){
      $id = $request -> input('id');
        $obj = new Client();
        $where = [
            'status'=>3
        ];
        $res=$obj ->getupdate($id,$where);
        if($res){
            return ['msg'=>'删除成功','code'=>1,'status'=>1];
        }else{
            return ['msg'=>'删除失败','code'=>2,'status'=>2];
        }
    }

    #分页
    public function recycle_page(Request $request){
      $p = $request ->input('p');
        $obj=new Client();

        $where = [
            'status'=>2
        ];
        $arr=$obj->getAdminList($p,$where);
        foreach($arr as $k=>$v){

            $arr[$k]['utime']=date('Y-m-d H:i:s',$v['utime']);
        }

        $user_boj=new User();
        $res=$user_boj->Select();

        foreach($res as $k=>$v){
            foreach($arr as $key=>$val){
                if($val['u_id'] == $v['u_id']){
                    $arr[$key]['u_id']=$v['real_name'];
                }
            }
        }
      return $arr;
    }

    #搜索
    public function recycle_show(Request $request){
       $tex = $request -> input('tex');
       $leixing = $request -> input('leixing');
       $jibie = $request -> input('jibie');
       $yewu = $request -> input('yewu');
       /* if($tex == ''){
            $where= ['c_name'=>1];
        }else{
            $where= [
                'c_name'=>$tex
            ];
        }


            $where2 = ['c_industry'=>$leixing];



            $where3 = [
                'c_rank'=>$jibie
            ];



            $where4 = ['u_id'=>$yewu];*/

        $obj = new Client();
        $arr=$obj->client_like($tex,$leixing,$jibie,$yewu);
        $user_obj=new User();
        $res=$user_obj->Select();
        foreach($res as $k=>$v){
            foreach($arr as $key=>$val){
                if($val['u_id'] == $v['u_id']){
                    $arr[$key]['u_id']= $v['real_name'];
                }
            }
        }


        foreach($arr as $k=>$v){
            $arr[$k]['utime']=date('Y-m-d H:i:s',$v['utime']);
        }
        return $arr;

    }

}





