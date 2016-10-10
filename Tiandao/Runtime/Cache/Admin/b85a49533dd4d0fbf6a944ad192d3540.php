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
<div class="account-info modify-limit add-person" style="margin-left:-150px; ">
        <h3>权限管理</h3>
        <a href="javascript:;">权限管理</a>>><a href="javascript:;"><?php echo (session('realname')); ?></a>
        <form id="auth-form" action="" method="">
             <input type="text"  name="username" placeholder="请输入用户名" />
            <span class="user-data">用户名</span>
            <dl>
                <dt>
                    <input class="checkAllItem" type="checkbox" />特别权限
                </dt>
                <dd>（管理员，全站通行）</dd>
            </dl>
            <?php if(is_array($parentAuth)): foreach($parentAuth as $key=>$v): ?><dl>
                <dt><h3><?php echo ($v["auth_name"]); ?>：</h3></dt>
                <dd><input class="checkAll" type="checkbox"  />全选</dd>
               <?php if(is_array($subAuth)): foreach($subAuth as $key=>$vv): if($v['id'] == $vv['parent_id'] ): ?><dd><input class="checkItem" type="checkbox" name="act_list[]" value="<?php echo ($vv["id"]); ?>"/><?php echo ($vv["auth_name"]); ?></dd><?php endif; endforeach; endif; ?>
            </dl><?php endforeach; endif; ?>
       
            <button type="button" class="add-auth">提交权限</button>
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
        
        //失去焦点的时候检验用户是否存在
        $('input[type="text"]').blur(function(){
            var val = $(this).val();
            if(val == ''){
                return;
            }
            $.ajax({
                url: '/index.php/Admin/System/ajaxCheckUser',
                data: {username:val},
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if(data.status == 0){
                       layer.alert(data.info,{icon:5});
                       $('input[type="text"]').val('');
                       $('.user-data').css('color','red').text('账号不存在');
                    }else{
                        $(".user-data").text(data.url.data.realname)
                    }
                }
            });
        });
        $('input[type="text"]').focus(function(){
            $(".user-data").css('color','').text('用户名')
        })
        $(".add-auth").click(function(){
            var data = $("#auth-form").serialize();
            $.ajax({
                url: '/index.php/Admin/System/ajaxAddAuth',
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