<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>table模块快速使用</title>
    <link rel="stylesheet" href="./layui/css/layui.css" media="all">
    <script src="./js/jquery.min.js"></script>
    <script src="./layui/layui.js"></script>
</head>
<body>
<table class="layui-table">
    关键字：<input type="text" id="tex" style="width:200px;height:30px;"><input type="button" value="搜索" id="butt" style="width:50px; height:30px;">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>编号</th>
        <th>真实姓名</th>
        <th>手机号码</th>
        <th>部门</th>
        <th>入司时间</th>
    </tr>
    </thead>
    <input type="hidden" id="count" count="{{$count}}">
    <tbody id="show">
    @foreach($arr as $k=>$v)
    <tr>
        <td>{{$v['u_id']}}</td>
        <td>{{$v['real_name']}}</td>
        <td>{{$v['u_tel']}}</td>
        <td>{{$v['u_section']}}</td>
        <td>{{$v['ctime']}}</td>
    </tr>
    @endforeach
    </tbody>

</table>

<div id="page">
</div>

</body>
</html>
<script>
    $(function(){
        var count = $('#count').attr('count');
        layui.use('laypage', function(){
            var laypage = layui.laypage;

            laypage.render({
                elem: 'page'
                ,limit:3
                ,count:count //数据总数，从服务端得到
                ,jump: function(obj, first){
                    //obj包含了当前分页的所有参数，比如：
                    console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
                    console.log(obj.limit); //得到每页显示的条数
                    var p = obj.curr;
                    var name=$('#tex').val();

                    $.ajax({
                        url:'Sear',
                        data:{'p':p,'name':name,'_token':'{{csrf_token()}}'},
                        type:'post',
                        dataType:'json',
                        success:function(json_msg){
                            var _tr = '';
                            var info=json_msg.data;
                            for(var i in info){
                                _tr+="<tr>" +
                                        "<td>"+info[i]['u_id']+"</td>" +
                                        "<td>"+info[i]['real_name']+"</td>" +
                                        "<td>"+info[i]['u_tel']+"</td>" +
                                        "<td>"+info[i]['u_section']+"</td>" +
                                        "<td>"+info[i]['ctime']+"</td>" +
                                        "</tr>";
                            }
                            $('#show').html(_tr);
                        }

                    })
                }
            })
        });
        $('#butt').click(function(){
            var name=$('#tex').val();
            $.ajax({
                url:'Page',
                data:{'name':name,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function(json_msg){
                    var _tr = '';
                    var info=json_msg.data;
                    for(var i in info){
                        _tr+="<tr>" +
                                "<td>"+info[i]['u_id']+"</td>" +
                                "<td>"+info[i]['real_name']+"</td>" +
                                "<td>"+info[i]['u_tel']+"</td>" +
                                "<td>"+info[i]['u_section']+"</td>" +
                                "<td>"+info[i]['ctime']+"</td>" +
                                "</tr>";
                    }
                $('#show').html(_tr);
                }

            })
        });

    })
</script>