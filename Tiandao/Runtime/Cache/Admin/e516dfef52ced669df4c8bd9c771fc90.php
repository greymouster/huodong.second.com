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
    <div class="info-manage act-form" style="margin-left:-150px;height:1000px">
        <h3>活动信息管理</h3>
        <a href="javascript:;">活动信息管理</a>>><a href="javascript:;"><?php echo ($data["act_name"]); ?></a>>><a href="javascript:;">查看渠道来源表</a>
        <div class="table table-one">
            <ul class="thead">
                <li class="li-lg">活动名称</li>
                <li>创建人</li>
                <li>活动时间</li>
                <li>访问量</li>
                <li>报名量</li>
                <li>收藏量</li>
            </ul>
            <ul>
                <li class="li-lg"><?php echo ($data["act_name"]); ?></li>
                <li><?php echo ($data["act_charge_name"]); ?></li>
                <li><?php echo ($data["act_date"]); ?></li>
                <li><?php echo ($data["num"]); ?></li>
                <li><?php echo ($data["count"]); ?></li>
                <li><?php echo ($data["collectCount"]); ?></li>
            </ul>
        </div>
        <a href="<?php echo U('Activity/get_exel',array('act_id'=>I('get.act_id')));?>">导出到excel</a>
        <div class="table table-two">
            <ul class="thead">
                <li>活动名称</li>
                <li>渠道</li>
                <li>渠道名称</li>
                <li>渠道唯一标识</li>
                <li>备注信息</li>
                <li>来源个数</li>
                <li>来源占比</li>
                <li class="last">来源链接</li>
            </ul>
            <?php if(is_array($sourceData)): foreach($sourceData as $key=>$vo): ?><ul>
                <li><?php echo ($vo['act_name']); ?></li>
                <li><?php echo ($vo['channel_name']); ?></li>
                <li><?php echo ($vo['channel_alias']); ?></li>
                <li><?php echo ($vo['channel_detal']); ?></li>
                <li><?php echo ($vo['channel_remarks']); ?></li>
                <li><?php echo ($vo['num']); ?></li>
                <li><?php echo ($vo['zhanbi']); ?>%</li>
                <li class="last"><?php echo ($vo['channel_url']); ?></li>
            </ul><?php endforeach; endif; ?>
        </div>
        <div class="page-list-link">
            <?php if($sourceData != ''): echo ($page); endif; ?>
        <div>
        <!--<ul class="pagnation">
            <li><a href="#"> &lt;上一页 </a> </li>
            <li><a href="#">1</a> </li>
            <li class="active"><a href="#">2</a> </li>
            <li><a href="#">3</a> </li>
            <li><a href="#">4</a> </li>
            <li><a href="#">5</a> </li>
            <li><a href="#">6</a> </li>
            <li><a href="#">7</a> </li>
            <li><a href="#">8</a> </li>
            <li><a href="#">9</a> </li>
            <li><a href="#">10</a> </li>
            <li><a href="#">下一页&gt;</a> </li>
        </ul>-->
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
        $('.pagnation li').click(function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
        })
    })
</script>
</html>