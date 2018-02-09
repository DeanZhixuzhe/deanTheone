{include file="public__meta"}

<title>新增</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{:url('admin/Article/save')}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="title" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>短标题：</label>
			<div class="formControls col-xs-8 col-sm-6">
				<input type="text" class="input-text" value="" placeholder="" id="shorttitle" name="shorttitle">
			</div>
			<label class="form-label col-xs-1 col-sm-1"><span class="c-red">*</span>作者：</label>
			<div class="formControls col-xs-1 col-sm-2">
				<input type="text" class="input-text" value="" placeholder="" id="writer" name="writer">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>TAG标签：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="">
			</div>
		</div>
		<div class="row cl">
              <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
              <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
                <input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="">
              </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>来源：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="source" name="source">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类：</label>
			<div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
					<select name="category_id" class="select">
						{volist name='categorys' id='vo'}
						<option value="{$vo.id}">{$vo.tree}</option>
						{/volist}
					</select>
				</span>
			</div>
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地区：</label>
			<div class="formControls col-xs-8 col-sm-2">
				<span class="select-box">
					<select name="area_id" class="select">
						<option value="0">选择地区</option>
						{volist name='areaList' id='vo'}
						{volist name='vo.areas' id='vo'}
						<option value="{$vo.id}">{$vo.name}</option>
						{/volist}
						{/volist}
					</select>
				</span>
			</div>
			
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标签：</label>
			<div class="formControls col-xs-8 col-sm-2">
			{volist name='tagsList' id='vo'}
			{volist name='vo.tagss' id='vo'}
				<label><input type="checkbox" name="tags_id[]" value="{$vo.id}">{$vo.name}</label>
			{/volist}
			{/volist}
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="keywords" name="keywords">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea class="textarea" value="" placeholder="" id="description" name="description"></textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editorContent"  type="text/plain" name="content" style="width:100%;height:300px;"></script> 
			</div>
		</div>
		<input type="hidden" name="__token__" value="{$Request.token}">
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

{include file="public__footer"}

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="__STATIC__/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
var SCOPE = {
   	'city_url' : "{:url('api/city/getCitysByParentId')}",
    'category_url' : "{:url('api/category/getCategoryByParentId')}",
	'uploadify_swf' : '__STATIC__/lib/uploadify/uploadify.swf',
	'image_upload' : "{:url('api/image/upload')}",
};
$(function(){
	// //表单验证
	// $("#form1-article-add").validate({
	// 	rules:{
	// 		articletitle:{
	// 			required:true,
	// 		},
	// 		articletitle2:{
	// 			required:true,
	// 		},
	// 		articlecolumn:{
	// 			required:true,
	// 		},
	// 		articletype:{
	// 			required:true,
	// 		},
	// 		articlesort:{
	// 			required:true,
	// 		},
	// 		keywords:{
	// 			required:true,
	// 		},
	// 		abstract:{
	// 			required:true,
	// 		},
	// 		author:{
	// 			required:true,
	// 		},
	// 		sources:{
	// 			required:true,
	// 		},
	// 		allowcomments:{
	// 			required:true,
	// 		},
	// 		commentdatemin:{
	// 			required:true,
	// 		},
	// 		commentdatemax:{
	// 			required:true,
	// 		},

	// 	},
	// 	onkeyup:false,
	// 	focusCleanup:true,
	// 	success:"valid",
	// 	submitHandler:function(form){
	// 		//$(form).ajaxSubmit();
	// 		var index = parent.layer.getFrameIndex(window.name);
	// 		//parent.$('.btn-refresh').click();
	// 		parent.layer.close(index);
	// 	}
	// });
	
	
	var ue = UE.getEditor('editorContent');
	
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>