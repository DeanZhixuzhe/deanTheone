<?php
namespace app\index\controller;

use think\Loader;
use think\Controller;
use think\Request;
use think\Route;
use think\Config;
use app\dedecms\controller\ApiController as dedecmsApi;
use app\pay\controller\ApiController as payApi;
// use app\pay\controller\wxpay\WxPayUnifiedOrder;

/**
* 
*/
class CashierController extends BaseController
{
	public function index(){
		$data = $this->request->param();
		$data['title'] = isset($data['title']) ? $data['title'] : '测试';
		$data['litpic'] = isset($data['litpic']) ? $data['litpic'] : '';
		$data['trueprice'] = isset($data['trueprice'])?$data['trueprice']:1;
		$discounts = isset($data['discounts'])?$data['discounts']:'';
		$rand1 = rand(1000,9999);
		$rand2 = rand(10,99);
		function getMillisecond() {
			list($t1, $t2) = explode(' ', microtime());
			$s = substr((float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000),9);
			if(substr($s,0,1) == 0){
				$s = '1'.substr($s,1);
			}
			return $s;
		}
		$data['out_trade_no'] = getMillisecond().date('d').date('H').'11'.date('i').date('m').$rand1.'01'.$rand2.date('y').date('s');
		if (empty($discounts)) {
			$data['discountsCon'] = "";
		}else{
			$data['discountsCon'] = "<h4>现在购买您可享受以下优惠</h4>";
			$data['discountsCon'] .= "<p>$discounts</p>";
		}
		return $this->fetch('',['data' => $data]);
	}

	public function pay(){
		$data = $this->request->param();
		$pay = new payApi();
		if ($this->request->isMobile()) {
			$data['terminal'] = (stripos($this->request->header('user-agent'),'microMessenger')!==false) ? 'wx' : 'h5';
		}else{
			$data['terminal'] = 'pc';
		}
		if ($data['pingtai'] == 'wechat') {
			$result = $pay->wxPay($data);
			switch ($data['terminal']) {
				case 'pc':
					return $this->fetch('wxpay_native',['data' => $result,'out_trade_no' => $data['out_trade_no']]);
					break;
				case 'h5':
					$url = $result['mweb_url'];
					echo "<script language='javascript' type='text/javascript'>";
					echo "window.location.href='$url'";
					echo "</script>";
					break;
				case 'wx':
					return $this->fetch('wxpay_jsapi',['jsApiParameters' => $result,'data' => $data]);
					break;
			}
		}elseif ($data['pingtai'] == 'alipay') {
			if ($data['terminal'] == 'wx') {
				if (stripos($this->request->header('user-agent'),'iphone')!==false) {
					$open = '<li><em>1</em>点击右上角<img src="/static/tot/images/pay/wxllqi.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;按钮</li>
						<li><em>2</em>选择在<img src="/static/tot/images/pay/safariopen.png"></li>';
				}else{
					$open = '<li><em>1</em>点击右上角<img src="/static/tot/images/pay/wxllqa.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;按钮</li>
					<li><em>2</em>选择在浏览器中打开</li>';
				}
				return $this->fetch('alipay_in_wechat',['data' => $open]);
			}
			$result = $pay->aliPay($data);
			echo $result;
		}
	}

	public function wxpayAjax(){
		$out_trade_no = $this->request->param('order_id');
		$input = new \app\pay\controller\wxpay\WxPayOrderQuery();
		$input->SetOut_trade_no($out_trade_no);
		$result = \app\pay\controller\wxpay\WxPayApi::orderQuery($input);
		if (isset($result['trade_state']) && $result['trade_state'] == 'SUCCESS') {
			echo "1";
		}elseif (isset($result['out_trade_no']) && $result['result_code'] == 'FAIL') {
			echo "2";
		}else{
			echo "0";
		}
	}

	public function notice(){
		return $this->fetch('',['result' => $this->request->param('result')]);
	}

	public function alipayNotice(){
		$alipay_config = \app\pay\controller\alipay\AlipayConfig::alipayConfig();
		//计算得出通知验证结果
		$alipayNotify = new \app\pay\controller\alipay\AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
			$data = $this->request->param();
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			
			// //商户订单号
			// $out_trade_no = $_POST['out_trade_no'];

			// //支付宝交易号
			// $trade_no = $_POST['trade_no'];

			// //交易状态
			// $trade_status = $_POST['trade_status'];

		    if($data['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
					//如果有做过处理，不执行商户的业务程序
						
				//注意：
				//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		    }
		    else if ($data['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
					//如果有做过处理，不执行商户的业务程序
						
				//注意：
				//付款完成后，支付宝系统发送该交易状态通知

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		    }

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		        
			echo "success";		//请不要修改或删除
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo "fail";

		    //调试用，写文本函数记录程序运行情况是否正常
		    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}

	public function alipayReturn(){
		$alipay_config = \app\pay\controller\alipay\AlipayConfig::alipayConfig();
		$alipayNotify = new \app\pay\controller\alipay\AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
			$data = $this->request->param();
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			// //商户订单号
			// $out_trade_no = $_GET['out_trade_no'];

			// //支付宝交易号
			// $trade_no = $_GET['trade_no'];

			// //交易状态
			// $trade_status = $_GET['trade_status'];

		    if($data['trade_status'] == 'TRADE_FINISHED' || $data['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
		    }
		    else {
		      echo "trade_status=".$_GET['trade_status'];
		    }
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='/index/cashier/notice/result/success.html'";
			echo "</script>";
			exit;

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='/index/cashier/notice/result/fail.html'";
			echo "</script>";
		    exit;
		}
	}
}