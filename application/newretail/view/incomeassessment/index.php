<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="__STATIC__/libs/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="__STATIC__/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__STATIC__/libs/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css"></script>
<script type="text/javascript" src="__STATIC__/libs/bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/libs/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<style type="text/css">
	.content{width: 970px; margin: 20px auto; position: relative;}
	.bg div{border-bottom: 1px solid #ddd;border-right: 1px solid #ddd; text-align: center; padding:10px 0; height: 40px; overflow: hidden; font-size: 16px}
	.firstCol{height: 150px; display: block;}
	.left-border{border-left: 1px solid #ddd}
	.top-border{border-top: 1px solid #ddd}
	.pgbutton{position: absolute; top: 0; right: 10px;}
	.container{margin-top: 50px;}
</style>
</head>
<body>
<div class="content" id="app">
	<form class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">成交量</label>
			<div class="col-sm-3">
				<input type="number" v-model="turnover" name="turnover" id="turnover" class="form-control" placeholder="输入交易量">
			</div>
			<label class="col-sm-2 control-label">成交价</label>
			<div class="col-sm-3">
				<input type="number" v-model="price" name="price" id="price" class="form-control">
			</div>
		</div>
		<!-- <div class="form-group">
			<label>交易时间</label>
			<input type="text" name="time" id="time" class="form-control" readonly>
		</div>
		<div class="form-group">
			<label>交易类型</label>
			<select name="type" id="type" class="form-control">
				<option value="">买入</option>
				<option value="">卖出</option>
			</select>
		</div> -->
	</form>
	<div class="pgbutton">
		<button v-on:click="sypg" class="btn btn-default">评估收益</button>
	</div>
	
	<div class="container">
		
	</div>

	<div class="container">
		<div class="row top-border left-border">
			<div class="col-sm-3" style="height: 200px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; text-align: center; padding: 45px 115px; font-size: 20px">
				预计收益
			</div>
			<div class="col-sm-9">
				<div class="row bg">
					<div class="col-sm-7">预计现金收益</div>
					<div class="col-sm-5">{{cashEarnings}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计积分收益</div>
					<div class="col-sm-5">{{integralEarnings}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计收益比例</div>
					<div class="col-sm-5">{{earningsRatio}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计积分周期</div>
					<div class="col-sm-5">{$earningsPeriod}天</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计积分时间</div>
					<div class="col-sm-5">{$earningsTime}左右</div>
				</div>
			</div>
		</div>

		<div class="row top-border left-border">
			<div class="col-sm-3" style="height: 200px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; text-align: center; padding: 45px 115px; font-size: 20px">
				预计成本
			</div>
			<div class="col-sm-9">
				<div class="row bg">
					<div class="col-sm-7">预计总成本</div>
					<div class="col-sm-5">{{predictcosting}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计本期成本</div>
					<div class="col-sm-5">{{thiscosting}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">预计下期成本</div>
					<div class="col-sm-5">{{nextcosting}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">交易数量</div>
					<div class="col-sm-5">{{turnover}}</div>
				</div>
				<div class="row bg">
					<div class="col-sm-7">交易价格</div>
					<div class="col-sm-5">{{price}}</div>
				</div>
			</div>
		</div>



		
	</div>
</div>
<script type="text/javascript">
	$('#time').datetimepicker({
		language:'zh-CN',
		weekStart:1
	});
	var app = new Vue({
		el:'#app',
		data:{
			predictEarnings:'',
			cashEarnings:'',
			integralEarnings:'',
			earningsRatio:'',
			earningsPeriod:'',
			earningsTime:'',
			turnover:'',
			price:'',
			predictcosting:'',
			thiscosting:'',
			nextcosting:'',

		},
		methods:{
			sypg:function(){
				this.thiscosting = this.turnover * this.price
				this.nextcosting = this.turnover * 3 * 299
				this.predictcosting = this.thiscosting+this.nextcosting
				this.predictEarnings = this.turnover * 3 * this.price - this.nextcosting - this.thiscosting
				this.cashEarnings = ((this.turnover * 3 * this.price - this.nextcosting) * 0.7 - this.thiscosting).toFixed(2)
				this.integralEarnings = ((this.turnover * 3 * this.price - this.nextcosting) * 0.3).toFixed(2)
				this.earningsRatio = ((this.cashEarnings / this.predictEarnings) * 100).toFixed(2) + '%'
			}
		}
	})
</script>
</body>
</html>