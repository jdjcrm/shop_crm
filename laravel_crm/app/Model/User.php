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
        return $this->where($where)->get()->toArray();
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
}
