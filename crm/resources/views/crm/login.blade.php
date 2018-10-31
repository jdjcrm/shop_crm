<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>示例登陆页</title>
    <style>
        #win10-login {
            background: url('./win10/img/wallpapers/login.jpg') no-repeat fixed;
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            position: fixed;
            z-index: -1;
            top: 0;
            left: 0;
        }

        #win10-login-box {
            width: 300px;
            overflow: hidden;
            margin: 0 auto;
        }

        .win10-login-box-square {
            width: 105px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: darkgray;
            position: relative;
            overflow: hidden;
        }

        .win10-login-box-square::after {
            content: "";
            display: block;
            padding-bottom: 100%;
        }

        .win10-login-box-square .content {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        input {
            width: 90%;
            display: block;
            border: 0;
            margin: 0 auto;
            line-height: 36px;
            font-size: 20px;
            padding: 0 1em;
            border-radius: 5px;
            margin-bottom: 11px;
        }

        .login-username, .login-password {
            width: 91%;
            font-size: 13px;
            color: #999;
        }

        .login-password {
            width: calc(91% - 54px);
            -webkit-border-radius: 2px 0 0 2px;
            -moz-border-radius: 2px 0 0 2px;
            border-radius: 5px 0 0 5px;
            margin: 0px;
            float: left;
        }

        .login-submit {
            margin: 0px;
            float: left;
            -webkit-border-radius: 0 5px 5px 0;
            -moz-border-radius: 0 5px 5px 0;
            border-radius: 0 5px 5px 0;
            background-color: #009688;
            width: 54px;
            display: inline-block;
            height: 36px;
            line-height: 36px;
            padding: 0 auto;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            cursor: pointer;
            opacity: .9;
            filter: alpha(opacity=90);

        }
    </style>
    <script src="./js/app.js"></script>
    <script src="./layui/layui.js"></script>
</head>
<body>
<div id="win10-login">
    <div style="height: 10%;min-height: 120px"></div>
    <div id="win10-login-box">
        <div class="win10-login-box-square">
            <img src="./win10/img/avatar.jpg" class="content"/>
        </div>
        <p style="font-size: 24px;color: white;text-align: center">欢迎登录</p>
        <form target="_self" method="get" action="#">
            <!--用户名-->
            <input type="text" placeholder="请输入登录名" class="login-username" id="name">
            <!--密码-->
            <input type="password" placeholder="请输入密码" class="login-password" id="pwd">
            <!--登陆按钮-->
            <input type="submit"  value="登录" id="btn-login" class="login-submit"/>
        </form>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        layui.use('layer', function(){
            var layer = layui.layer;
            $('#btn-login').click(function(){
                var name = $('#name').val();
                var pwd = $('#pwd').val();
               /* if(name == ''){
                    layer.msg('账号不能为空',{icon:5});
                    return false;
                }*/
               /* if(pwd == ''){
                    layer.msg('密码不能为空',{icon:5});
                    return false;
                }*/
                $.ajax({
                    url:'LoginDo',
                    data:{'name':name,'pwd':pwd,'_token':'{{csrf_token()}}'},
                    type:'post',
                    dataType:'json',
                    success:function(json_msg){
                        if(json_msg['status'] == 2){
                            layer.msg(json_msg['msg'],{icon:json_msg['icon']});
                        }else{
                            layer.msg(json_msg['msg'],{icon:json_msg['icon'],time:2000},function(){
                                window.location.href="Home";
                            });
                        }
                    }
                });
            });
        });

    })
</script>