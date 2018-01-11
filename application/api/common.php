<?php
/**
 * 模拟系统的result方法输出数据，最大的好处是API模块的控制器不继承系统控制器类，也能正常输出数据
 * @author deanyan 2017-09-11T03:13:11+0800
 * @copyright www.deanyan.com
 * @param     int 			 $status
 * @param     string         $message
 * @param     array          $data
 * @return    json                 
 */
function show($status=0,$message='',$data=[]){
	return [
		'status' => intval($status),
		'message' => $message,
		'time' => time(),
		'data' => $data,
	];

}