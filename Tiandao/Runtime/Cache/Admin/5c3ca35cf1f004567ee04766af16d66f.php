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
<script src="/Public/Admin/Plugins/jqueryform/jquery.form.js"></script>

<!--umeditor-->
<!--<link href="/Public/Admin/Plugins/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">-->
<!--<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/umeditor/umeditor.config.js"></script>-->
<!--<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/umeditor/umeditor.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/Admin/Plugins/umeditor/lang/zh-cn/zh-cn.js"></script>-->
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Plugins/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="publish-act" style="margin-left:-150px; ">
        <h3>发布新活动</h3>
        <a href="javascript:;">发布新活动</a>>><a href="javascript:;">填写信息</a>
        <div class="act-info">
            <div class="top">
                <div class="one">
                    <p class="active">1.填写信息</p>
                    <img src="/Public/Admin/images/u50.png" />
                </div>
                <div class="line"></div>
                <div class="one">
                    <p>2.报名表单设置</p>
                    <img src="/Public/Admin/images/u50.png" />
                </div>
            </div>
            <form id="myForm" class="base-info" action="" method="POST" enctype="multipart/form-data">
                <p class="title">填写基本资料</p>
                <dl>
                    <dt><h2>活动名称<span>*</span></h2></dt>
                    <dd><input type="text" name="act_name"/> </dd>
                    <dd><h2>负责人：<i><?php echo (session('realname')); ?></i></h2></dd>
					<input type="hidden" name="act_charge_name" value="<?php echo (session('realname')); ?>">
                </dl>
                <dl>
                    <dt><h2>活动地点<span>*</span></h2></dt>
                    <dd>
                        <select name="place_id">
                            <option selected="selected" value="0">选择城市</option>
							<?php if(is_array($placeData)): foreach($placeData as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["place_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </dd>
                    <dd><input type="text" placeholder="填写具体的活动地点" name="spec_address"/></dd>
                </dl>
                <dl>
                    <dt><h2>活动分类<span>*</span></h2></dt>
                    <dd>
                        <select  name="cat_id">
                            <option value="0">选择分类</option>
                            <?php if(is_array($cateData)): foreach($cateData as $key=>$vo): ?><option  value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt><h2>活动费用<span>*</span></h2></dt>
                    <dd><input type="text" name="act_cost"/>元</dd>
                </dl>
                <dl>
                    <dt><h2>活动是否需报名审核：</h2></dt>
                    <dd><input type="radio" name="act_status" value="0" checked="checked"/>否</dd>
                    <dd><input type="radio" name="act_status" value="1" />是</dd>
                </dl>
                <dl>
                    <dt><h2>活动时间<span>*</span></h2></dt>
                    <div class="time">
                        <input type="text" name="act_start_date" class="datetimepicker-date"  placeholder="活动开始日期" />
                        <input type="text" name="act_start_time" class="datetimepicker-time" placeholder="开始时间" />
                        到
                        <input type="text" name="act_end_date" class="datetimepicker-date" placeholder="活动结束日期" />
                        <input type="text" name="act_end_time" class="datetimepicker-time" placeholder="结束时间" />
                    </div>
                </dl>
                <dl>
                    <dt><h2>活动上线时间<span>*</span></h2></dt>
                    <dd><input type="radio" name="act_online" value="1" checked="checked"/>审核后立即上线</dd>
                    <dd><input type="radio" name="act_online" value="2"/>审核通过后定时上线</dd>
                    <dd><input type="text" class="time datetimepicker-date" name="act_date"  placeholder="请选择上线日期" /></dd>
                    <dd><input type="text" class="time datetimepicker-time" name="act_time"  placeholder="请选择上线时间" /></dd>
                </dl>
            <div class="base-info overview">
                <p class="title">活动概览图</p>
                <div class="up-pic">
                    <input style="width:530px;margin-top:52px;" id="uploadImage" name="act_file" type="file" value="上传图片"/>
                   <p style="text-align: left; font-size: 20px; color:#ff3cd9;">上传尺寸限制为720px X 405px;上传大小最大为2M</p>
                </div>
                <div id="uploadPreview"></div>
            </div>
            <div class="base-info details">
                <p class="title">活动详情</p>
                <textarea id="act_desc" name="act_desc"></textarea>
            </div>
		</form>
            <div class="bottom">
                <button type="button" class="submit-yulan">预览</button>
                <button type="button" class="submit-caogao">保存</button>
                <button type="button" class=" submit-file-desc" >下一步</button>
            </div>

        </div>
    </div>
</body>
</html>
<script>
/*活动时间弹框*/
$('.publish-act .base-info dl dd input[name="act_time_status"]').click(function(){
	var flag=$(this).prop('checked');
	if(flag==true){
		$(this).parent().find('.box').show();
		$(this).parent().siblings().find('.box').hide();
		//清空值
		$(this).parent().siblings().find(".box input[type='text']").val('');
	}
})
/*图片预览*/
$("#uploadImage").on("change", function(){

    //$('.size').empty().text(this.files[0].size/1024/1024 + "Mb");
    //$('.big').empty().text('720px X 640px');
	// Get a reference to the fileList
	var files = !!this.files ? this.files : [];
	// If no files were selected, or no FileReader support, return
	if (!files.length || !window.FileReader) return;
	// Only proceed if the selected file is an image
	if (/^image/.test( files[0].type)){
		// Create a new instance of the FileReader
		var reader = new FileReader();
		// Read the local file as a DataURL
		reader.readAsDataURL(files[0]);
		// When loaded, set image data as background of div
		reader.onloadend = function(){
			$("#uploadPreview").css("background", "url("+this.result+")");
		}
	}

	else {
		alert('请输入正确的图片格式');
	}
});



$(function(){
     $(".datetimepicker-time").datetimepicker({
	    datepicker:false,
		format : 'H:i',
		step :60
	 
	 });
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

    window.UEDITOR_HOME_URL = "/Public/Admin/Plugins/ueditor/";
    UE.getEditor('act_desc',{initialFrameWith:'100%',initialFrameHeight:450});
    UE.getEditor('act_how_part',{initialFrameWith:'100%',initialFrameHeight:450});
})

</script>