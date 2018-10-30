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
            <select name="" id="">
                <option value="">客户类型</option>
                <option value="">已成交</option>
                <option value="">未成交</option>
                <option value="">跟进中</option>
                <option value="">有意向</option>
            </select>
            <select name="" id="">
                <option value="">客户级别</option>
                <option value="">★★★★★</option>
                <option value="">★★★★</option>
                <option value="">★★★</option>
                <option value="">★★</option>
                <option value="">★</option>
            </select>
            <select name="" id="">
                <option value="">业务员</option>
                <option value="">乡长</option>
                <option value="">小王</option>
                <option value="">小丽</option>
            </select>
            <input type="button" value="搜索">
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
                        <tr>
                            <td>孟子</td>
                            <td>华夏族（汉族）</td>
                            <td>公元前-372年</td>
                            <td>猿强，则国强。国强，则猿更强！ </td>
                            <td>
                                <input type="button" value="还原">
                                <input type="button" value="删除">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="layui-tab-item">内容2</div>
            <div class="layui-tab-item">内容3</div>
            <div class="layui-tab-item">内容4</div>
        </div>
    </div>
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
        $('.li').click(function(){
           var gid=$(this).attr('gid');
            alert(gid);
        });
    })
</script>


</body>
</html>