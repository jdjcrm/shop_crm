<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientController
 *  编写人：贾海洋
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{

    /**
     * 客户添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function client_add(){
        $province = DB::table("shop_area")->where(['area_parent_id'=>0])->select()->get();

        return view("client.client_add",['province'=>$province]);
    }

    /**
     * 执行客户添加
     * @param Request $request
     * @return int  返回的结果集
     */
    public function client_add_do(Request $request){

        //获取值
        $data["c_name"] = $request ->post('c_name');
        $data["c_province"] = $request ->post('c_province');
        $data["c_city"] = $request ->post('c_city');
        $data["c_area"] = $request ->post('c_area');
        $data["c_site"] = $request ->post('c_site');
        $data["c_tel"] = $request ->post('c_tel');
        $data["c_industry"] = $request ->post('c_industry');
        $data["c_rank"] = $request ->post('c_rank');
        $data["c_source"] = $request ->post('c_source');
        $data["c_post"] = $request ->post('c_post');
        $data["c_linkman"] = $request ->post('c_linkman');
        $data["c_ltel"] = $request ->post('c_ltel');

        $data["c_salesman"] = $request ->session()->get('name');

        $data['ctime'] =time();
        $data['status'] = 1;

        if($data['c_salesman'] ){
            $res = DB::table("crm_client")->insertGetId($data);
        }else{
            $res = '';
        }

        if($res){
            return  1;
        }else{
            return  2;
        }

    }

    /**
     * 订单展示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function client_show(Request $request)
    {
        //接收时间的类型   1:所有的时间 2:一天  3：一个星期  4 ：一个月
        $type = $request->input('type');

        if ($type == 2) {
            $c_time = 60 * 60 * 24;
        } else if ($type == 3) {
            $c_time = 60 * 60 * 24 * 7;
        } else if ($type == 4) {
            $c_time = 60 * 60 * 24 * 30;
        } else {
            $c_time = 99999999999;
        }

        //查找总条数
        $count = DB::table('crm_client')->where('ctime', '<', $c_time)->count();

        //查找订单数据
        $data = DB::table('crm_client')->where('ctime', '<', $c_time)->paginate(3);

        return view("client.client_show", ['count' => $count, 'data' => $data, 'new_type' => $type]);
    }

    /**
     * 客户分页
     * @param Request $request
     * @return string
     */
    public function clientList(Request $request)
    {
        //获取当前页
        $p = $request->post("p");

        $type = $request->post("type");

        if ($type == 2) {
            $c_time = 60 * 60 * 24;
        } else if ($type == 3) {
            $c_time = 60 * 60 * 24 * 7;
        } else if ($type == 4) {
            $c_time = 60 * 60 * 24 * 30;
        } else {
            $c_time = 99999999999;
        }

        $arr = $this->getClientList($p, $c_time);

        return json_encode($arr->toArray(), true);

    }

    /**
     * 客户分页的方法
     * @param int $p
     * @param $c_time
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getClientList($p = 1, $c_time)
    {
        $pageName = 'page';

        $data = DB::table("crm_client")->where('ctime', '<', $c_time)->paginate(3, ["*"], $pageName, $p);

        return $data;
    }

    /**
     * 删除客户
     * @param Request $request
     */
    public function client_dele(Request $request)
    {
        $c_id = $request->post('c_id');

        $data = [
            'status' => 2
        ];
        $res = DB::table('crm_client')->where(['c_id' => $c_id])->update($data);
        echo $res;
    }

    /**
     * @param Request $request
     */
    public function client_update(Request $request){
        $c_id = $request -> post('c_id');
        echo $c_id;
    }
}
