<?php
namespace app\pay\controller;

use think\Loader;
use think\controller;
use think\Request;
use app\pay\controller\wxpay\WxPayApi;
use app\pay\controller\wxpay\WxPayUnifiedOrder;
use app\pay\controller\wxpay\JsApiPay;
use app\pay\controller\alipay\AlipayConfig;
use app\pay\controller\alipay\AlipaySubmit;

/**
* 
*/
class ApiController extends controller
{
	protected $terminal;
	protected $subject;
	protected $body;
	protected $out_trade_no;
	protected $total_fee;

	public function wxPay($data){
		if (!isset($data['subject']) || $data['subject'] == null || !isset($data['out_trade_no']) || empty($data['out_trade_no']) || !isset($data['total_fee']) || empty($data['total_fee'])) {
        	return false;
        }
		$data['body'] = isset($data['body']) ? $data['body'] : '';

		$input = new WxPayUnifiedOrder();
		$input->SetBody($data['subject']);
		$input->SetAttach($data['body']);
		$input->SetOut_trade_no($data['out_trade_no']);
		$input->SetTotal_fee(intval($data['total_fee']));
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://www.1314theone.com/index/cashier/notify/result/success.html");
		$input->SetProduct_id("123456789");
		switch ($data['terminal']) {
			case 'pc':
				$input->SetTrade_type("NATIVE");
				$result = WxPayApi::unifiedOrder($input);
				break;
			case 'h5':
				$input->SetTrade_type("MWEB");
				$result = WxPayApi::unifiedOrder($input);
				break;
			case 'wx':
				//①、获取用户openid
				$tools = new JsApiPay();
				$openId = $tools->GetOpenid();
				//②、统一下单
				$input->SetTrade_type("JSAPI");
				$input->SetOpenid($openId);
				$order = WxPayApi::unifiedOrder($input);
				$result = $tools->GetJsApiParameters($order);
				break;
		}
		
		return $result;
	}

	public function aliPay($data){
		if (!isset($data['subject']) || $data['subject'] == null || !isset($data['out_trade_no']) || empty($data['out_trade_no']) || !isset($data['total_fee']) || empty($data['total_fee'])) {
        	return false;
        }
		$data['body'] = isset($data['body']) ? $data['body'] : '';
		$alipay_config = AlipayConfig::alipayConfig();
		$parameter = array(
			"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  => $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],
			"out_trade_no"	=> $data['out_trade_no'],
			"subject"	=> $data['subject'],
			"total_fee"	=> ($data['total_fee']*0.01),
			"body"	=> $data['body'],
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
	        //如"参数名"=>"参数值"
		);
		switch ($data['terminal']) {
			case 'pc':
				$parameter['anti_phishing_key'] = $alipay_config['anti_phishing_key'];
				$parameter['exter_invoke_ip'] = $alipay_config['exter_invoke_ip'];
				break;
			case 'h5':
				$parameter['app_pay'] = 'Y';
				break;
		}
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		return $html_text;


		//PC支付宝
		require_once("../extend/alipayPc/alipay.config.php");
		require_once("../extend/alipayPc/lib/alipay_submit.class.php");
		require_once("../extend/alipayPc/lib/alipay_core.function.php");
		require_once("../extend/alipayPc/lib/alipay_md5.function.php");
		$parameter = array(
			"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  => $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],
			"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
			"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
			//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
	        //如"参数名"=>"参数值"
		);
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;

		//H5支付宝
		require_once("../extend/alipayWap/alipay.config.php");
		require_once("../extend/alipayWap/lib/alipay_submit.class.php");
		require_once("../extend/alipayWap/lib/alipay_core.function.php");
		require_once("../extend/alipayWap/lib/alipay_md5.function.php");
		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service"       => $alipay_config['service'],
			"partner"       => $alipay_config['partner'],
			"seller_id"  => $alipay_config['seller_id'],
			"payment_type"	=> $alipay_config['payment_type'],
			"notify_url"	=> $alipay_config['notify_url'],
			"return_url"	=> $alipay_config['return_url'],
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset'])),
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"show_url"	=> $show_url,
			"app_pay"	=> "Y",//启用此参数能唤起钱包APP支付宝
			"body"	=> $body,
			//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.2Z6TSk&treeId=60&articleId=103693&docType=1
	        //如"参数名"	=> "参数值"   注：上一个参数末尾需要“,”逗号。
		);
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;

		
	}
}
