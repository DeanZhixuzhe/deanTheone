function layer_window(title,url,w,h){
	if (title == null || title == '') {
		title=false;
	}
	if (url == null || url == '') {
		url="404.html";
	}
	if (w == null || w == '') {
		w=800;
	}
	if (h == null || h == '') {
		h=($(window).height() - 50);
	}
	layer.open({
		type: 2,
		area: [w+'px', h +'px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: title,
		content: url
	});
}

function layer_full(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

function admin_del(url){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			success: function(data){
				layer.msg('已删除!',{icon:1,time:1500});
				setTimeout("location.reload()",2000);
			},
			error:function(data) {
				console.log(data.msg);
			},
		});	
	});
}
/**
 * [admin_edit description]
 * @author deanyan 2017-09-08T03:15:17+0800
 * @link   www.deanyan.com
 * @param  {[type]}        url [description]
 * @return {[type]}            [description]
 */
function admin_edit(url){
	$.post(url,function(result){
		if (result.code == 1) {
			layer.msg(result.msg);
			setTimeout("location.reload()",2000);
		}else{
			alert(result.msg);
		}
	},"json");
}

function admin_gather(url){
	$.post(url,function(result){
		if (result.code == 1) {
			layer.msg(result.msg);
		}else{
			alert(result.msg);
		}
	},"json");
}

$('.pages input').blur(function(){
	//获取Ajax需要请求的URL地址
	var url = $(this).attr('k-url');
	//获取改变前排序的值，用于和input中的值做对比
	var pages_old = $(this).attr('k-pages');
	//获取主键ID
	var id = $(this).attr('k-id');
	//获取页数的值
	var pages = $(this).val();
	//处理需要更新的数据
	var postData = {
		'id' : id,
		'pages' : pages,
	};
	//做一个严格判断，如果改变前排序值和input中的值相同，说明未做任何修改，不执行Ajax请求，反之不相等则执行Ajax请求
	if (pages_old != pages) {
		$.post(url,postData,function(result){
			if (result.code == 1) {
				layer.msg(result.msg);
				setTimeout("location.reload()",2000);
			}else{
				alert(result.msg);
			}
		},"json");
	}
});

$('.listorder input').blur(function(){
	//获取Ajax需要请求的URL地址
	var url = $(this).attr('k-url');
	//获取改变前排序的值，用于和input中的值做对比
	var listorder_old = $(this).attr('k-listorder');
	//获取主键ID
	var id = $(this).attr('k-id');
	//获取排序的值
	var listorder = $(this).val();
	//处理需要更新的数据
	var postData = {
		'id' : id,
		'listorder' : listorder,
	};
	//做一个严格判断，如果改变前排序值和input中的值相同，说明未做任何修改，不执行Ajax请求，反之不相等则执行Ajax请求
	if (listorder_old != listorder) {
		$.post(url,postData,function(result){
			if (result.code == 1) {
				//此处做一个判断，不是批量编辑才更新页面
				if (!$('#listorder-all').children(':checkbox').is(':checked')) {
					location.href=result.data;
				}
			}else{
				alert(result.msg);
			}
		},"json");
	}
});

$('#listorder-all').click(function(){
	if ($(this).children(':checkbox').is(':checked')) {
		$(this).children(':submit').removeClass('hidden');
		$(this).children(':checkbox').attr({disabled:'disabled'});
	}else{
		$(this).children(':submit').addClass('hidden');
	}
});
$('#listorder-all').children(':submit').click(function(){
	window.location.reload();
});


/**
 * 采用递归方式全自动处理Select数据，目前有个BUG，同一个页面只能处理一个Select组；
 * 后面的Select组因为递归，获取不到change的元素
 * @author deanyan 2017-09-11T01:22:24+0800
 * @copyright www.deanyan.com
 * @param     {[type]}        linkage [description]
 * @param     {[type]}        name    [description]
 * @param     {[type]}        url     [description]
 * @return    {[type]}                [description]

function laSelect(linkage,name,url){
	$.ajax({
		type:"post",
		url:url,
		data:{name:name},
		success:function(result){
			if (result.status == 1) {
				var arr = result.data;
				var html = '<select><option>--请选择--</option>';
				for(var i in arr){
					html +='<option value="'+arr[i].name+'">'+arr[i].name+'</option>';
				}
				html += '</select>';
				var selectHtml = $(linkage).html(html);
				setRes(selectHtml,0,url);
			}else if(result.status == 0){
				alert(result.message);
				return;
			}
		},
	});
}
function setRes(selectHtml,num,url){
	var total = $(selectHtml).children('select').length;
	$(selectHtml).children('select').eq(num).change(function(){
		$.ajax({
			type:"post",
			url:url,
			data:{name:$(selectHtml).children('select').eq(num).val()},
			success:function(result){
				$(selectHtml).children('select').slice(num+1).remove();
				if (result.status == 1) {
					var arr = result.data;
					var html = '<select><option>--请选择--</option>';
					for(var i in arr){
						html +='<option value="'+arr[i].name+'">'+arr[i].name+'</option>';
					}
					html += '</select>';
					$(selectHtml).append(html);
					setRes($(selectHtml),num+1,url);
				}
			}
		});
	});
} */

function firstSelect(url,select,name){
	$.ajax({
		type:"post",
		url:url,
		data:{name:name},
		success:function(result){
			if (result.status == 1) {
				var arr = result.data;
				var html = '<option>--请选择--</option>';
				for(var i in arr){
					html +='<option value="'+arr[i].name+'">'+arr[i].name+'</option>';
				}
				$(select).html(html);
			}else if(result.status == 0){
				alert(result.message);
				return;
			}
		},
	});
}
function wnSelect(url,selects,name){
	if (name == null) {
		name = '默认';
	}
	firstSelect(url,selects[0],name);
	for (var i = 0;i < selects.length; i++) {
		changeSelect(url,selects[i],selects[i+1]);
	}
}
function changeSelect(url,select1,select2){
	var sel1 = select1;
	var sel2 = select2;
	$(sel1).change(function(){
		$.ajax({
			type:"post",
			url:url,
			data:{name:$(sel1).val()},
			success:function(result){
				$(sel2).html('<option>--请选择--</option>');
				if (result.status == 1) {
					var arr = result.data;
					var html = '<option>--请选择--</option>';
					for(var i in arr){
						html +='<option value="'+arr[i].name+'">'+arr[i].name+'</option>';
					}
					$(sel2).html(html);
				}
			}
		});
	});
}