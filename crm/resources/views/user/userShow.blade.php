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


</head>
<body>
<ul class="layui-nav layui-bg-cyan">
    <li class="layui-nav-item"><a href="./user_add">用户添加</a></li>
    <li class="layui-nav-item"><a href="./userShow">用户展示</a></li>

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
            <th>编辑</th>
            <th>用户名</th>
            <th>真实姓名</th>
            <th>添加时间</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>部门</th>
            <th>操作</th>
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
<script>
    layui.use('layer', function () {
        var layer = layui.layer;

        //用户删除
        $(document).on('click', ".del", function () {
            var _this = $(this);
            var u_id = $(this).parents('.tr').children().first().html();
            if (u_id) {
                $.post("user_dele", {u_id: u_id, '_token': '{{csrf_token()}}'}, function (res) {
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
            var u_id = $(this).parents('.tr').children().first().html();
            if (u_id) {
                layer.open({
                    type: 2,
                    title: '用户修改修改',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['450px', '270px'],
                    content: 'user_update?u_id=' + u_id
                });
            }

        })
    })
</script>


</html>