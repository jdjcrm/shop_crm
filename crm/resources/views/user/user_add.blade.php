<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="./js/app.js"></script>
    <script src="./layui/layui.js"></script>
    <link rel="stylesheet" href="./layui/css/layui.css"  media="all">
</head>
<body>
<ul class="layui-nav layui-bg-cyan">
    <li class="layui-nav-item"><a href="./user_add">用户添加</a></li>
    <li class="layui-nav-item"><a href="./userShow">用户展示</a></li>

</ul>


<form class="layui-form" action="">

    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" id="u_name" lay-verify="required" autocomplete="off" placeholder="请输入用户名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">真实用户名</label>
        <div class="layui-input-block">
            <input type="text" id="real_name" lay-verify="required" autocomplete="off" placeholder="请输入真实用户名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" id="pwd1" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" id="pwd2" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号</label>
        <div class="layui-input-block">
            <input type="text" id="tel" lay-verify="required" autocomplete="off" placeholder="请输入手机号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">邮箱</label>
        <div class="layui-input-block">
            <input type="text" id="email" lay-verify="required" autocomplete="off" placeholder="请输入邮箱号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">部门</label>
        <div class="layui-input-block">
            <select id="u_section" lay-verify="">
                <option value="">请选择</option>
                <option value="1">工程部门</option>
                <option value="2">设计部</option>
                <option value="3">行政部门</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn"  id="btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>



<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'layedit', 'laydate','layer'], function() {
        var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate;
        var layer = layui.layer;

        //验证名字
        $("#u_name").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写名字");
            }
        });

        //验证真实名字
        $("#real_name").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写名字");
            }
        });

        //验证密码
        $("#pwd1").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写密码");
            }
        });

        //验证密码
        $("#pwd2").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写密码");
            }
        });

        //验证手机号
        $("#tel").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写手机号");
            }
        });

        //验证手机号
        $("#email").blur(function(){
            var u_name = $(this).val();
            if(u_name == ''){
                layer.msg("请填写邮箱");
            }
        });

        //提交
        $("#btn").click(function(){
            var u_name = $("#u_name").val();
            var real_name = $("#real_name").val();
            var pwd  = $("#pwd1").val();
            var tel = $("#tel").val();
            var email = $("#email").val();
            var u_section = $("#u_section").val();

            var dome = true;

            if(u_name == ''){
                layer.msg("请填写名字");
                dome = false;
            }

            if(real_name == ''){
                layer.msg("请填写名字");
                dome = false;
            }

            if(pwd == ''){
                layer.msg("请填写密码");
                dome = false;
            }

            if(tel == ''){
                layer.msg("请填写手机号");
                dome = false;
            }
            if(email == ''){
                layer.msg("请填写邮箱");
                dome = false;
            }


            if(dome == true){


                $.post("user_add_do",{'_token':'{{csrf_token()}}',u_name:u_name,real_name:real_name,pwd:pwd,tel:tel,email:email,u_section:u_section},function(res){
                    if(res){
                        layer.msg("添加成功");
                    }else{
                        layer.msg("添加失败");
                    }
                })
            }



        })
    })


</script>
</body>
</html>