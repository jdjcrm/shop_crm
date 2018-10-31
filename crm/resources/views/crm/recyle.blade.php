<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="./layui/css/layui.css"  media="all">
    <script src="./js/jquery.min.js"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this li" gid="0">已删除列表</li>
            <li gid="1" class="li">今日删除</li>
            <li gid="2" class="li">近7天删除</li>
            <li gid="3" class="li">本月删除</li>
        </ul>
        <div>
            关键字：<input type="text" id="tex" style="width:150px; height:30px;">
            <select name="" id="leixing">
                <option value="">客户类型</option>
                <option value="1">已成交</option>
                <option value="2">未成交</option>
                <option value="3">跟进中</option>
                <option value="4">有意向</option>
            </select>
            <select name="" id="jibie">
                <option value="">客户级别</option>
                <option value="5">★★★★★</option>
                <option value="4">★★★★</option>
                <option value="3">★★★</option>
                <option value="2">★★</option>
                <option value="1">★</option>
            </select>
            <select name="" id="yewu">
                <option value="">业务员</option>
                @foreach($res as $k=>$v)
                    <option value="{{$v['u_id']}}">{{$v['real_name']}}</option>
                @endforeach
            </select>
            <input type="button" value="搜索" id="but">
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
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
                            <th>删除时间</th>
                            <th>业务员</th>
                            <th>管理</th>
                        </tr>
                        </thead>
                        <tbody class="shop">
                        @foreach($arr as $k=>$v)
                        <tr >
                            <td>{{$v['c_id']}}</td>
                            <td>{{$v['c_name']}}</td>
                            <td>{{$v['utime']}}</td>
                            <td>{{$v['u_id']}}</td>
                            <td>
                                <input type="button" value="还原" class="update" u_id="{{$v['c_id']}}">
                                <input type="button" value="删除" class="del" d_id="{{$v['c_id']}}">
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-tab-item">
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
                            <th>删除时间</th>
                            <th>业务员</th>
                            <th>管理</th>
                        </tr>
                        </thead>
                        <tbody class="shop">
                            <tr >
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="button" value="还原">
                                    <input type="button" value="删除">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-tab-item">
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
                            <th>删除时间</th>
                            <th>业务员</th>
                            <th>管理</th>
                        </tr>
                        </thead>
                        <tbody class="shop">
                        <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="button" value="还原">
                                <input type="button" value="删除">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-tab-item">
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
                            <th>删除时间</th>
                            <th>业务员</th>
                            <th>管理</th>
                        </tr>
                        </thead>
                        <tbody class="shop">
                        <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="button" value="还原">
                                <input type="button" value="删除">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="count" count="{{$count}}">
    </div>
    <div id="page"></div>
</fieldset>





<script src="./layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use('element', function(){
        var $ = layui.jquery
                ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块

        //触发事件
        var active = {
            tabAdd: function(){
                //新增一个Tab项
                element.tabAdd('demo', {
                    title: '新选项'+ (Math.random()*1000|0) //用于演示
                    ,content: '内容'+ (Math.random()*1000|0)
                    ,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
                })
            }
            ,tabDelete: function(othis){
                //删除指定Tab项
                element.tabDelete('demo', '44'); //删除：“商品管理”

                othis.addClass('layui-btn-disabled');
            }
            ,tabChange: function(){
                //切换到指定Tab项
                element.tabChange('demo', '22');
            }
        };

        $('.site-demo-active').on('click', function(){
            var othis = $(this), type = othis.data('type');
            active[type] ? active[type].call(this, othis) : '';

        });

        //Hash地址的定位
        var layid = location.hash.replace(/^#test=/, '');
        element.tabChange('test', layid);

        element.on('tab(test)', function(elem){
            location.hash = 'test='+ $(this).attr('lay-id');

        });

    });
    $(function(){
        var count = $('#count').attr('count');
        $('.li').click(function(){
           var gid=$(this).attr('gid');
            $.ajax({
                url:'RecycleDo',
                data:{'gid':gid,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success:function(json_msg){
                var _tr = '';
                    for(var i in json_msg){
                        _tr +="<tr>" +
                                "<td>"+json_msg[i]['c_id']+"</td>" +
                                "<td>"+json_msg[i]['c_name']+"</td>" +
                                "<td>"+json_msg[i]['utime']+"</td>" +
                                "<td>"+json_msg[i]['u_id']+"</td>" +
                                "<td><input type='button' value='还原' class='update' u_id="+json_msg[i]['c_id']+"><input type='button' value='删除' class='del' d_id="+json_msg[i]['c_id']+"></td>" +
                                "</tr>";
                    }
                    $('.shop').html(_tr);
                }

            });
        });
        layui.use('layer', function() {

            var layer = layui.layer;
                var u_id
            $(document).on('click','.update', function(){
                var _this = $(this);
                 u_id=$(this).attr('u_id');
                layer.confirm('是否确定还原？', {
                    btn: ['确定', '关闭'], //可以无限个按钮
                    icon:3,
                    title:'消息'
                    ,btn2: function(index, layero){
                        layer.close();
//                        alert(1)
                    }
                }, function(index, layero){
                    $.ajax({
                        url:'RecycleU',
                        data:{'id':u_id,'_token':'{{csrf_token()}}'},
                        type:'post',
                        dataType:'json',
                        success:function(json_msg){
                        if(json_msg['status'] == 1){
                            layer.close();
                            layer.msg(json_msg['msg'],{icon:json_msg['code']});
                            _this.parents('tr').remove();
                        }else{
                            layer.close();
                            layer.msg(json_msg['msg'],{icon:json_msg['code']});
                        }
                        }
                    });
//                    alert(2);
                });
            });

            $(document).on('click','.del', function(){
                var id = $(this).attr('d_id');
                var _this = $(this);
                layer.confirm('是否确定删除？', {
                    btn: ['确定', '关闭'], //可以无限个按钮
                    icon:3,
                    title:'消息'
                    ,btn2: function(index, layero){
                        layer.close();
//                        alert(1)
                    }
                }, function(index, layero){
                    $.ajax({
                        url:'RecycleD',
                        data:{'id':id,'_token':'{{csrf_token()}}'},
                        type:'post',
                        dataType:'json',
                        success:function(json_msg){
                            if(json_msg['status'] == 1 ){
                                layer.close();
                                layer.msg(json_msg['msg'],{icon:json_msg['code']});
                                _this.parents('tr').remove();
                            }else{
                                layer.close();
                                layer.msg(json_msg['msg'],{icon:json_msg['code']});

                            }
                        }
                    });
                })
            });







        })





        //分页
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
                    $.ajax({
                        url:'RecycleP',
                        data:{'p':p,'_token':'{{csrf_token()}}'},
                        type:'post',
                        dataType:'json',
                        success:function(json_msg){
                            var _tr = '';
                            var info=json_msg.data;
                            for(var i in info){
                                _tr +="<tr>" +
                                        "<td>"+info[i]['c_id']+"</td>" +
                                        "<td>"+info[i]['c_name']+"</td>" +
                                        "<td>"+info[i]['utime']+"</td>" +
                                        "<td>"+info[i]['u_id']+"</td>" +
                                        "<td><input type='button' value='还原' class='update' u_id="+info[i]['c_id']+"><input type='button' value='删除' class='del' d_id="+info[i]['c_id']+"></td>" +
                                        "</tr>";
                            }
                            $('.shop').html(_tr);
                        }

                    })
                }
            })
        });




        //搜索
        $('#but').click(function(){
            var tex = $('#tex').val();
            var leixing = $('#leixing').val();
            var jibie = $('#jibie').val();
            var yewu = $('#yewu').val();
            $.ajax({
                url:'RecycleS',
                data:{'tex':tex,'leixing':leixing,'jibie':jibie,'yewu':yewu,'_token':'{{csrf_token()}}'},
                type:'post',
                dataType:'json',
                success: function(json_msg){
                    var _tr ;
                    var info = json_msg.data;
                    for(var i in info){
                        _tr +="<tr>" +
                                "<td>"+info[i]['c_id']+"</td>" +
                                "<td>"+info[i]['c_name']+"</td>" +
                                "<td>"+info[i]['utime']+"</td>" +
                                "<td>"+info[i]['u_id']+"</td>" +
                                "<td><input type='button' value='还原' class='update' u_id="+info[i]['c_id']+"><input type='button' value='删除' class='del' d_id="+info[i]['c_id']+"></td>" +
                                "</tr>";
                    }
                    $('.shop').html(_tr);
                }
            });
        });



    })
</script>


</body>
</html>