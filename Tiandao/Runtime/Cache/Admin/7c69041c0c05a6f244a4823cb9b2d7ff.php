<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天道活动管理平台</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
    <script src="/Public/Admin/js/jquery.cookie.js"></script>
    <script src="/Public/Admin/js/ancement.js"></script>
    </style>
</head>
<body>
    <div class="account-info edit-group" style="margin-left:-150px;">
        <h3>权限管理</h3>
        <a href="<?php echo U('System/authInfo');?>">权限管理</a>>><a href="<?php echo U('System/addGroup');?>">新增小组</a>
        <form>
            <dl>
                <dt><h3>组名称</h3></dt>
                <dd><input type="text" placeholder="新增小组" class="group-name" /> </dd>
            </dl>
<!--            <dl>
                <dt><h3>组员列表</h3></dt>
                <dd>
                    <span>王珊<button><img src="images/u39.jpg" /></button>  </span>
                    <span>李芸<button><img src="images/u39.jpg" /></button></span>
                </dd>
            </dl>-->
<!--            <dl>
                <dt><h3>添加组员</h3></dt>
                <dd>
                    <input type="search"  placeholder="按姓名搜索" />
                    <ul>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                    </ul>
                </dd>
                <a href="#">加入本组</a>
            </dl>
            <ul>
                <li>
                    <input type="checkbox" name="name" />李立
                </li>
                <li>
                    <input type="checkbox" name="name" />王虎
                </li>
            </ul>-->
            <div class="reserve">
                <button type="button" class="add-group">保存设置</button>
            </div>
        </form>
    </div>
</body>
<script>
    $(function(){
      
        /*删除组员*/
        $('.edit-group form dl dd span').click(function(){
            $(this).children('button').show();
        })
        /*搜索*/
//        $(".edit-group form dl dd input[type='search']").keyup(function(){
//           var username = $.trim($(this).val());
//           if(username.length == 0){
//               $(this).next('ul').hide();
//           }
//           if(username.length >0){
//                $.ajax({
//                    url : "<?php echo U('System/ajaxSearch');?>",
//                    data :{username:username},
//                    type : "POST",
//                    dataType:"json",
//                    success : function(data){
//                          console.log(data);
//                    }
//                });
//           }
//            $(this).next('ul').show();
//           
//        })
//        $(".edit-group form dl dd input[type='search']").blur(function(){
//            $(this).next('ul').hide();
//        })
    })
</script>
</html>