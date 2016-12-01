<?php  
// define('CURL_DEBUG_LOG_PATH', 'D://1.log');  // CURL调试过程LOG输出路径
// define('CURL_OUTPUT_LOG_PATH', 'D://1.txt'); // CURL结果LOG输出路径

$cookie = $_POST['cookie'];
$pageNum = $_GET['pageNum'];


$url = 'https://buyertrade.taobao.com/trade/itemlist/asyncBought.htm?action=itemlist/BoughtQueryAction&event_submit_do_query=1&_input_charset=utf8' ;  
$fields = array(  
                    'lastStartRow'          =>      '2032334272_9223370635680156807_670972489487242_670972489487242',
                    'pageNum'               =>      $pageNum,//'2',
                    'pageSize'              =>      '15',
                    'action'                =>      'itemlist/BoughtQueryAction',
                    'prePageNo'             =>      '3',
                    'buyerNick'             =>      '',
                    'dateBegin'             =>      '0',
                    'dateEnd'               =>      '0',
                    'logisticsService'      =>      '',
                    'options'               =>      '0',
                    'orderStatus'           =>      '',
                    'queryBizType'          =>      '',
                    'queryOrder'            =>      'desc',
                    'rateStatus'            =>      '',
                    'refund'                =>      '',
                    'sellerNick'            =>      '',
                );  

$header = array(
                    ':authority:buyertrade.taobao.com',
                    ':method:POST',
                    ':path:/trade/itemlist/asyncBought.htm?action=itemlist/BoughtQueryAction&event_submit_do_query=1&_input_charset=utf8',
                    ':scheme:https',
                    'accept:application/json, text/javascript, */*; q=0.01',
                    'accept-encoding:gzip, deflate, br',
                    'accept-language:zh-CN,zh;q=0.8',
                    'cache-control:no-cache',
                    'content-type:application/x-www-form-urlencoded; charset=UTF-8',
                    'origin:https://buyertrade.taobao.com',
                    'pragma:no-cache',
                    'referer:https://buyertrade.taobao.com/trade/itemlist/list_bought_items.htm?spm=a21bo.50862.1997525045.2.ZNLCmG',
                    'user-agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36',
                    'x-requested-with:XMLHttpRequest',
                );

if(defined('CURL_DEBUG_LOG_PATH')){   
    $fp = fopen(CURL_DEBUG_LOG_PATH, 'w');
}

$ch = curl_init() ;  

curl_setopt($ch, CURLOPT_URL,$url) ;  
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields)); 
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);      // 发送自定义header
curl_setopt($ch, CURLOPT_ENCODING , "gzip");        // gzip处理

// CURL调试结果输出 
if(defined('CURL_DEBUG_LOG_PATH') ){
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_STDERR, $fp);
}

// 发送请求
$result = curl_exec($ch);  

// 释放
curl_close($ch) ;  
if(isset($fp) && !empty($fp)) fclose($fp);

// 将GBK的转成utf8的
$result = iconv("gb2312","utf-8//IGNORE", $result);

// CURL 回复结果输出
if(defined('CURL_OUTPUT_LOG_PATH')) {
    file_put_contents(CURL_OUTPUT_LOG_PATH, $result);
}


echo $result;  

