<?php if (!defined('THINK_PATH')) exit();?><script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
<script src="/Public/Admin/js/ancement.js"></script>
<div class="table">
    <ul class="thead">
        <li class="li-sm">活动名称</li>
        <li>活动状态</li>
        <li>活动访问量</li>
        <li>渠活动报名量</li>
    </ul>
    <?php if(is_array($data)): foreach($data as $key=>$vo): ?><ul>
        <li class="li-sm"><a href="#"><?php echo ($vo["act_name"]); ?></a> </li>
        <li><?php echo ($vo["current_status"]); ?></li>
        <li><?php echo ($vo["num"]); ?></li>
        <li><?php echo ($vo["count"]); ?></li>
    </ul><?php endforeach; endif; ?>
</div>
    <div class="page-list-link">
		<?php echo ($show); ?>
	<div>
</div>
<script type="text/javascript">
	$(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
	
</script>