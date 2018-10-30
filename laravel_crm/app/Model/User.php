<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'crm_user';
    public $timestamps = false;//禁止自动生成时间字段

    /**
     * 查询一条数据
     */
    public function getFind($where1,$where2,$where3){
        return $this->where($where1)->orWhere($where2)->orWhere($where3)->first();
    }

    /**
     * 查询数据
     */
    public function getSel($where){
        return $this->where($where)->paginate(3);
    }

    /**
     * 添加用户
     */
    public function getInsert($arr){
        return $this->insertGetId($arr);
    }

    /**
     * 根据条件修改盐字段
     */
    public function getUpdate($id,$where){
        return $this->where('u_id', $id)
            ->update($where);
    }
    #查询总条数
    public function count($where){
        return $this->where($where)->count();
    }

    #模糊查询
    public function like($name){
       return  $admin_list=$this->where('real_name', 'like', '%'.$name.'%')->paginate(3);
    }
    #分页
    public function getAdminList($currentPage=1,$where){
        $perPage = 3;
        $columns = ['*'];
        $pageName = 'page';



        $admin_list=$this->where($where)->  paginate($perPage, $columns, $pageName, $currentPage);
        foreach($admin_list as $k=>$v){
            $admin_list[$k]['ctime']=date('Y-m-d H:i:s',$v['ctime']);
        }
        return $admin_list;
    }
}
