<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./win10/component/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="./win10/css/default.css" rel="stylesheet">
    <script src="./js/app.js"></script>
    <script src="./layui/layui.js"></script>
    <link rel="stylesheet" href="./layui/css/layui.css"  media="all">
</head>
<body>
<from class="layui-form" action="">
    <table>
        <tr>
            <td>客户名</td>
            <td><input type="text" id="c_name"></td>
        </tr>
        <tr>
            <td>地址</td>
            <td>
                 省：<input type="text" id="c_province" >
                市: <input type="text" id="c_city">
                县: <input type="text" id="c_area">
            </td>
        </tr>
        <tr>
            <td> 地址详情</td>
            <td><input type="text" id="c_site"></td>
        </tr>
        <tr>
            <td> 客户手机号</td>
            <td><input type="text" id="c_tel"></td>
        </tr>
        <tr>
            <td>所属行业</td>
            <td><input type="text" id="c_industry"></td>
        </tr>
        <tr>
            <td>用户级别</td>
            <td>
                <select  id="c_rank">
                    <option value="4">☆☆☆☆</option>
                    <option value="3">☆☆☆</option>
                    <option value="2">☆☆</option>
                    <option value="1">☆</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> 用户来源</td>
            <td>
                <input type="text" id="c_source">
            </td>
        </tr>
        <tr>
            <td>联系人</td>
            <td><input type="text" id="c_linkman"></td>
        </tr>
        <tr>
            <td> 职位</td>
            <td><input type="text" id="c_post"></td>
        </tr>
        <tr>
            <td>联系人手机号</td>
            <td><input type="text" id="c_ltel"></td>
        </tr>

        <tr>
            <td><button id="button">添加</button></td>
        </tr>
    </table>
</from>
</body>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate','layer'], function() {
        var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate;
        $(function () {
            $("#button").click(function () {

                //获取文本框值
                var c_name = $("#c_name").val();
                var c_province = $("#c_province").val();
                var c_city = $("#c_city").val();
                var c_area = $("#c_area").val();
                var c_site = $("#c_site").val();
                var c_tel = $("#c_tel").val();
                var c_industry = $("#c_industry").val();
                var c_rank = $("#c_rank :checked").val();
                var c_source = $("#c_source").val();
                var c_post = $("#c_post").val();
                var c_linkman = $("#c_linkman").val();
                var c_ltel = $("#c_ltel").val();

                //判断值是否存在
                var dome = true;
                if (c_name == '') {
                    dome =false;
                    layer.msg("客户名称不能为空");
                }

                if(c_province == ''){
                    dome =false;
                    layer.msg("省名称不能为空");
                }
                if(c_city == '' ){
                    dome =false;
                    layer.msg("市名称不能为空");
                }
                if(c_area == ''){
                    dome =false;
                    layer.msg("区名称不能为空");
                }
                if(c_site == ''){
                    dome =false;
                    layer.msg("地址详情不能为空");
                }
                if(c_tel == ''){
                    dome =false;
                    layer.msg("客户手机号不能为空");
                }
                if(c_industry == ''){
                    dome =false;
                    layer.msg("所属行业不能为空");
                }
                if(c_rank == ''){
                    dome =false;
                    layer.msg("客户级别不能为空");
                }
                if(c_source == ''){
                    dome =false;
                    layer.msg("客户名称不能为空");
                }
                if(c_post == ''){
                    dome =false;
                    layer.msg("职位不能为空");
                }
                if(c_linkman == ''){
                    dome =false;
                    layer.msg("联系人不能为空");
                }
                if(c_ltel == ''){
                    dome =false;
                    layer.msg("联系人电话不能为空");
                }


                if(dome == true){
                    $.post("client_add_do",
                            {c_name:c_name,c_province:c_province,c_city:c_city,
                                c_area:c_area,c_site:c_site,c_tel:c_tel,c_industry:c_industry,
                                c_rank:c_rank,c_source:c_source,c_post:c_post,c_linkman:c_linkman,
                                c_ltel:c_ltel, '_token':'{{csrf_token()}}'
                            },
                            function(res){
                                if(res == 1){
                                    layer.msg("添加成功");
                                }else{
                                    layer.msg("添加失败");
                                }
                    })
                }

            })
        })
    })
</script>