<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'crm_client';
    public $timestamps = false;//禁止自动生成时间字段
    #查询删除数据
    public function selDel($where){
        return $this->where($where)->paginate(3);
    }
    #查询总条数
    public function count($where){
        return $this->where($where)->count();
    }

    #模糊查询
    public function client_like($where,$where1,$where2,$where3){
       return  $admin_list=$this->where(
                function ($query) use ($where) {
                    if (isset($where)) {
                        $query->where("c_name", "like", "%" . $where . "%");
                    }
                }
            )
            ->where(function ($query) use ($where1) {
                if ($where1 != '') {
                    $query->where('c_industry', '=', $where1);
                }
            })
           ->where(function($query) use ($where2){
               if($where2 != ''){
                   $query->where('c_rank' , '=' ,$where2);
               }
           })
           ->where(function($query) use ($where3){
               if($where3 != ''){
                   $query->where('u_id' , '=' ,$where3);
               }
           })
            ->paginate(3);
//        ->where('real_name', 'like', '%'.$name.'%')->paginate(3);
    }
    #分页
    public function getAdminList($currentPage=1,$where){
        $perPage = 3;
        $columns = ['*'];
        $pageName = 'page';



        $admin_list=$this->where($where)->  paginate($perPage, $columns, $pageName, $currentPage);

        return $admin_list;
    }

    #修改
    public function getupdate($id,$data){

         return $this->where('c_id',$id )
            ->update($data);
    }
}
