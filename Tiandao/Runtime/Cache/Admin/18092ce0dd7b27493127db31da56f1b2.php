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
<!--日期插件start-->
<link rel="stylesheet" href="/Public/Admin/Plugins/datetimepicker/datetimepicker.css">
<script src="/Public/Admin/Plugins/datetimepicker/datetimepicker.js"></script>
<!--日期插件end-->
<script src="/Public/Admin/js/jquery.jqChart.min.js" type="text/javascript"></script>
    <div class="info-manage act-data" style="margin-left:-150px; height: 1000px;">
        <h3>活动信息管理</h3>
        <a href="javascript:;">活动信息管理</a>>><a href="javascript:;"><?php echo ($data["act_name"]); ?></a>>><a href="javascript:;">查看活动数据</a>
        <div class="table">
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
        <a href="<?php echo U('Activity/actEnter',array('act_id'=>$data['act_id']));?>">查看活动报名表</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo U('Activity/actSource',array('act_id'=>$data['act_id']));?>">查看渠道来源表</a>
        <div class="choose">
            <p class="p-choose">筛选</p>
            <dl>
                <dt><input type="radio" name="time" value="2" />近一周 </dt>
                <dd><input type="radio" name="time" value="1"/>近一个月</dd>
                <dd><input type="radio" name="time" value="3"/>近三个月</dd>
                <dd><input type="text"  class="datetimepicker-date time1" placeholder="开始时间" /> </dd>
                <dd><input type="text" class="datetimepicker-date  time2" placeholder="结束时间" /> </dd>
                <dd><input type="button" value="搜索" /> </dd>
            </dl>
        </div>
        <ul class="number">
            <li style="float:left;">每日接收反馈/浏览数</li>
            <li style="float:right;">表单填写率：<span class="bm-count">0<span></li>
        </ul>
        <div class="wrapper">
            <!-- 代码 开始 -->
            <div>
                <div id="jqChart" style="width: 1000px; height: 500px;"></div>
            </div>
            <!-- 代码 结束 -->
        </div>
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
        /*日期*/

        $('.datetimepicker-date').datetimepicker({
            lang: 'ch',
            onGenerate: function(ct) {
                $(this).find('.xdsoft_date').toggleClass('xdsoft_disabled');
            },
            timepicker: false,
            format: 'Y-m-d',
            formatDate: 'Y-m-d',
            minDate: '-1970/01/02', // yesterday is minimum date
            maxDate: '+1970/01/02' // and tommorow is maximum date calendar
        });
    })


    $(function(){
        var actId = <?php echo ($data["act_id"]); ?>;
        $.ajax({
            url : "<?php echo U('Activity/ajaxGetTongJi');?>",
            data : {actId:actId,type:1},
            type : "POST",
            dataType : 'json',
            success : function(data){
                $(".bm-count").text(data.probability+'%');
                $('#jqChart').jqChart({
                    title: { text: '时间范围:最近30天' },
                    axes: [
                        {
                            location: 'left',//y轴位置，取值：left,right
                             minimum: data.count<10 ? 0 : -5,//y轴刻度最小值
                             maximum: data.count,//y轴刻度最大值
                             interval: data.count<10 ? 1 : 5//刻度间距
                         }
                    ],
                    series: [
                        //数据1开始
                        {
                            type: 'line',//图表类型，取值：column 柱形图，line 线形图
                            title:'反馈数量',//标题
                            data: [[data.startTime, 0] ,[data.endTime,data.bmCount]]//数据内容，格式[[x轴标题,数值1],[x轴标题,数值2],......]
                        },
                        //数据1结束
                        //数据2
                        {
                            type: 'line',
                            title:'浏览数量',
                            data: [[data.startTime,0],[data.endTime,data.count]]
                        },
                        //数据2结束
                    ]
                });
            }
        });
    })
</script>
<script>
    $(function(){
        $(":radio").click(function(){
            var type = $(this).val();
            var actId = <?php echo ($data["act_id"]); ?>;
            $.ajax({
                url: "<?php echo U('Activity/ajaxGetTongJi');?>",
                data: {actId: actId, type: type},
                type: "POST",
                dataType: 'json',
                success : function(data){
                        $(".bm-count").text(data.probability+'%');
                        $('#jqChart').jqChart({
                            title: { text: '时间范围:'+data.head },
                            axes: [
                                {
                                    location: 'left',//y轴位置，取值：left,right
                                    minimum: data.count<10 ? 0 : -5,//y轴刻度最小值
                                    maximum: data.count,//y轴刻度最大值
                                    interval: data.count<10 ? 1 : 5//刻度间距
                                }
                            ],
                            series: [
                                //数据1开始
                                {
                                    type: 'line',//图表类型，取值：column 柱形图，line 线形图
                                    title:'反馈数量',//标题
                                    data: [[data.startTime, 0] ,[data.endTime,data.bmCount]]//数据内容，格式[[x轴标题,数值1],[x轴标题,数值2],......]
                                },
                                //数据1结束
                                //数据2
                                {
                                    type: 'line',
                                    title:'浏览数量',
                                    data: [[data.startTime,0],[data.endTime,data.count]]
                                },
                                //数据2结束
                            ]
                        });
                }
            })
        });
    })
</script>
<script>
    $("input[type='button']").click(function(){
          var time1 = $(".time1").val();
          var time2 = $(".time2").val();
          var actId = <?php echo ($data["act_id"]); ?>;
          $.ajax({
              url : "<?php echo U('Activity/ajaxGetTongJi');?>",
              data: {actId: actId, type: 4,time1:time1,time2:time2},
              type: "POST",
              dataType: 'json',
              success : function(data){
                  $(".bm-count").text(data.probability+'%');
                  $('#jqChart').jqChart({
                      title: { text: '时间范围:'+data.head },
                      axes: [
                          {
                              location: 'left',//y轴位置，取值：left,right
                              minimum: data.count<10 ? 0 : -5,//y轴刻度最小值
                              maximum: data.count,//y轴刻度最大值
                              interval: data.count<10 ? 1 : 5//刻度间距
                          }
                      ],
                      series: [
                          //数据1开始
                          {
                              type: 'line',//图表类型，取值：column 柱形图，line 线形图
                              title:'反馈数量',//标题
                              data: [[data.startTime, 0] ,[data.endTime,data.bmCount]]//数据内容，格式[[x轴标题,数值1],[x轴标题,数值2],......]
                          },
                          //数据1结束
                          //数据2
                          {
                              type: 'line',
                              title:'浏览数量',
                              data: [[data.startTime,0],[data.endTime,data.count]]
                          },
                          //数据2结束
                      ]
                  });
              }
          });
    });

</script>
</html>