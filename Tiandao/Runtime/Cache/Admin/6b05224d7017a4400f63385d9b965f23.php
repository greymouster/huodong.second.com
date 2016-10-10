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
<div class="account-info modify-limit add-person" style="margin-left:-150px;height:1000px;">
        <h3>权限管理</h3>
        <a href="javascript:;">权限管理</a>>><a href="javascript:;"><?php echo (session('realname')); ?></a>
        <form id="edit-auth-form" action="" method="">
            <input type="hidden" name="admin_id" value="<?php echo ($_GET['id']); ?>">
             <b>管理员名称:</b><input type="text"  name="username"  value="<?php echo ($realname); ?>" style="text-align:center;" disabled="disabled"/>
            <dl>
                <dt>
                    <input class="checkAllItem" type="checkbox" />特别权限
                </dt>
                <dd>（管理员，全站通行）</dd>
            </dl>
            <?php if(is_array($parentAuth)): foreach($parentAuth as $key=>$v): ?><dl>
                <dt><h3><?php echo ($v["auth_name"]); ?>：</h3></dt>
                <dd><input class="checkAll" type="checkbox"  />全选</dd>
               <?php if(is_array($subAuth)): foreach($subAuth as $key=>$vv): if($v['id'] == $vv['parent_id'] ): ?><dd><input class="checkItem" type="checkbox" name="act_list[]" value="<?php echo ($vv["id"]); ?>" /><?php echo ($vv["auth_name"]); ?></dd><?php endif; endforeach; endif; ?>
                <!-- <dd><input class="checkItem" type="checkbox" name="checkbox" />修改&新增公告</dd> -->
            </dl><?php endforeach; endif; ?>
    
            <button type="button" class="edit-auth">提交权限</button>
        </form>
    </div>
</body>
<script>
    $(function(){
        $('.account').click(function(){
            $(this).children('ul').css('display','block');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.account ul').css('display','none');
        })
        /*全选*/
        $('.modify-limit form dl dd .checkAll').click(function(){
            var flag=$(this).prop('checked');
            $(this).parent().nextAll('dd').find('.checkItem').prop('checked',flag);
            $('.modify-limit form dl dd .checkItem').click(function(){
                var flag2=$(this).prop('checked');
                if(flag==true){
                    $(this).parent().siblings('dd').find('.checkAll').prop('checked',flag2);
                }
            })
        })
        $('.modify-limit form dl dt .checkAllItem').click(function(){
            var flag3=$(this).prop('checked');
            $(this).parent().parent().siblings().find('dd').find('input').prop('checked',flag3);
            $('.modify-limit form dl dd .checkItem').click(function(){
                var flag4=$(this).prop('checked');
                $(this).parent().siblings('dd').find('.checkAll').prop('checked',flag4);
            })
        })

        $(".edit-auth").click(function(){
            var data = $("#edit-auth-form").serialize();
            $.ajax({
                url: '/index.php/Admin/System/ajaxEditAuth',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.status == 0){
                        layer.msg(data.info,{icon:5});
                    }
                    if(data.status == 1){
                        layer.msg(data.info,{icon:6});
                        setTimeout(function(){
                            window.location.href = "<?php echo U('System/authInfo');?>";
                        },1500);
                    }
                }
            });
            

        });
         
    })
</script>
</html>