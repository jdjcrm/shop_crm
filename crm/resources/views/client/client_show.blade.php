<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./win10/component/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="./win10/css/default.css" rel="stylesheet">
    <script src="./js/app.js"></script>
    <script src="./js/jquery1.7.min.js"></script>
    <script src="./layui/layui.js"></script>
    <link rel="stylesheet" href="./layui/css/layui.css" media="all">
    <script src="/layui/layui.all.js"></script>
    <style>
        li{
            margin-left:20px;
        }
    </style>

</head>
<body>

<ul class="layui-nav layui-bg-cyan">
    <li class="layui-nav-item"><a href="client_show?type=0">客户列表</a></li>
    <li class="layui-nav-item"><a href="client_show?type=2">今日新增</a></li>
    <li class="layui-nav-item"><a href="client_show?type=3">近七天新增</a></li>
    <li class="layui-nav-item"><a href="client_show?type=4">本月新增</a></li>
    <li class="layui-nav-item" id="client_new">新增订单</li>
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
            <th>地址</th>
            <th>地址详情</th>
            <th>客户手机号</th>
            <th>所属行业</th>
            <th>客户级别</th>
            <th>客户来源</th>
            <th>联系人</th>
            <th>职位</th>
            <th>联系人手机号</th>
            <th>录入时间</th>
            <th>业务员</th>
            <th>状态</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>

        <input type="hidden" id="count" count="{{$count}}">
        <input type="hidden" id="type" value="{{ $new_type }}">
        <tbody id="show">
        @foreach($data as $k=>$v)
            <tr class="tr">
                <th>{{ $v->c_id }}</th>
                <th>{{ $v->c_name }}</th>
                <th>{{ $v->c_province }}</th>
                <th>{{ $v->c_site }}</th>
                <th>{{ $v->c_tel }}</th>
                <th>{{ $v->c_industry }}</th>
                <th>{{ $v->c_rank }}</th>
                <th>{{ $v->c_source  }}</th>
                <th>{{ $v->c_linkman }}</th>
                <th>{{ $v->c_post }}</th>
                <th>{{ $v->c_ltel }}</th>
                <th>{{ $v->ctime }}</th>
                <th>{{ $v->c_salesman }}</th>
                <th>{{ $v->status }}</th>
                <th>{{ $v->utime }}</th>
                <th>
                    <button class='del'>删除</button>
                    <button class='udpate'>修改</button>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page"></div>
</div>
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
                    var type = $("#type").val();
                    $.ajax({
                        url: 'clientList',
                        data: {'type':type,'p': p, '_token': '{{csrf_token()}}'},
                        type: 'post',
                        dataType: 'json',
                        success: function (json_msg) {

                            var _tr = '';
                            var info = json_msg.data;
                            for (var i in info) {
                                _tr += "<tr class='tr'>" +
                                        "<td>" + info[i]['c_id'] + "</td>" +
                                        "<td>" + info[i]['c_name'] + "</td>" +
                                        "<td>" + info[i]['c_province'] + "</td>" +
                                        "<td>" + info[i]['c_site'] + "</td>" +
                                        "<td>" + info[i]['c_tel'] + "</td>" +
                                        "<td>" + info[i]['c_industry'] + "</td>" +
                                        "<td>" + info[i]['c_rank'] + "</td>" +
                                        "<td>" + info[i]['c_source'] + "</td>" +
                                        "<td>" + info[i]['c_linkman'] + "</td>" +
                                        "<td>" + info[i]['c_post'] + "</td>" +
                                        "<td>" + info[i]['c_ltel'] + "</td>" +
                                        "<td>" + info[i]['ctime'] + "</td>" +
                                        "<td>" + info[i]['c_salesman'] + "</td>" +
                                        "<td>" + info[i]['status'] + "</td>" +
                                        "<td>" + info[i]['utime'] + "</td>" +
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
<script>
    layui.use('layer', function () {
        var layer = layui.layer;

        //客户删除
        $(document).on('click', ".del", function () {
            var _this = $(this);
            var c_id = $(this).parents('.tr').children().first().html();
            if (c_id) {
                $.post("client_dele", {c_id: c_id, '_token': '{{csrf_token()}}'}, function (res) {
                    if (res) {
                        _this.parents(".tr").remove();
                        layer.msg("删除成功");
                    } else {
                        layer.msg("删除失败");
                    }

                })

            }
        })

        //用户修改
        $(document).on("click", '.udpate', function () {
            var c_id = $(this).parents('.tr').children().first().html();
            if (c_id) {
                layer.open({
                    type: 2,
                    title: '用户修改修改',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['450px', '270px'],
                    content: 'client_update?c_id=' + c_id
                });
            }
        })

        //用户新增
        $(document).on("click",'#client_new',function(){
            layer.open({
                type: 2,
                title: '客户添加',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['450px', '270px'],
                content: 'client_add'
            });
        })

    })
</script>
</body>
</html>