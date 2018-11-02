<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>展示</title>
    <script src="./js/app.js"></script>
    <script src="./layui/layui.js"></script>
    <link rel="stylesheet" href="./layui/css/layui.css"  media="all">
</head>
<style>
    li{
        margin-left:20px;
    }
</style>
<body>
<ul class="layui-nav layui-bg-cyan">
    <li class="layui-nav-item">订单列表</li>
    <li class="layui-nav-item">今日新增</li>
    <li class="layui-nav-item">本月新增</li>
    <li class="layui-nav-item">近七天新增</li>
    <li class="layui-nav-item">新增订单</li>
</ul>


<div class="layui-form">
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>编号</th>
            <th>客户名称</th>
            <th>联系人</th>
            <th>下单时间</th>
            <th>交单时间</th>
            <th>订单金额</th>
            <th>状态</th>
            <th>管理</th>
        </tr>
        </thead>
        <input type="hidden" id="count" count="{{$count}}">


        <tbody id="show">
        @foreach($data as $k=>$v)
            <tr class="tr">
                <th>{{ $v->u_id }}</th>
                <th>{{ $v->u_name }}</th>
                <th>{{ $v->real_name }}</th>
                <th>{{ $v->ctime }}</th>
                <th>{{ $v->u_tel }}</th>
                <th>{{ $v->u_email }}</th>
                <th>{{ $v->u_section }}</th>
                <th>
                    <button class="del">删除</button>
                    <button bgcolor="green"
                            onclick="Win10.openUrl('./orderpeople','<img class=\'icon\' src=\'./img/icon/blogger.png\'/>修改')">
                        修改
                    </button>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page"></div>
</div>
</body>
<script>
    $(function () {
        var count = $('#count').attr('count');
        layui.use('laypage', function () {
            var laypage = layui.laypage;

            laypage.render({
                elem: 'page'
                , limit: 3
                , count: count //数据总数，从服务端得到
                , jump: function (obj, first) {
                    //obj包含了当前分页的所有参数，比如：
                    //console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
                    //console.log(obj.limit); //得到每页显示的条数
                    var p = obj.curr;
                    $.ajax({
                        url: 'user_show_page',
                        data: {'p': p, '_token': '{{csrf_token()}}'},
                        type: 'post',
                        dataType: 'json',
                        success: function (json_msg) {

                            var _tr = '';
                            var info = json_msg.data;
                            for (var i in info) {
                                _tr += "<tr class='tr'>" +
                                        "<td>" + info[i]['u_id'] + "</td>" +
                                        "<td>" + info[i]['u_name'] + "</td>" +
                                        "<td>" + info[i]['real_name'] + "</td>" +
                                        "<td>" + info[i]['ctime'] + "</td>" +
                                        "<td>" + info[i]['u_tel'] + "</td>" +
                                        "<td>" + info[i]['u_email'] + "</td>" +
                                        "<td>" + info[i]['u_section'] + "</td>" +
                                        "<td><button class='del'>删除</button> <button class='udpate'>修改</button></td>" +
                                        "</tr>";
                            }
                            $('#show').html(_tr);
                        }

                    })
                }
            })
        })
    })
</script>

</html>