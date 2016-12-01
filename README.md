# studydemo

- php_curl(php curl方面的例子)
    - taobao_order
        - 名字：淘宝-已购买的商品curl获取
        - 说明：感觉淘宝订单页翻页比较麻烦，于是做了这个来获取订单列表，通过传入cookie和页数，直接获取淘宝中已购买的商品中指定页数的订单信息
        - 用法：
            +   1.界面
                打开tb.html输入cookie和页数

            +   2.接口(./debug.php?pageNum=页数)
                post数据cookie到上面的接口地址
            
            +   3.额外配置
                如需开启debug, 获取curl访问流程信息以及回复结果, 可以在debug.php定义以下Log文件路径常量
                CURL_DEBUG_LOG_PATH     // 访问流程信息Log文件路径
                CURL_OUTPUT_LOG_PATH    // 回复结果Log文件路径
                
        - 学到的东西：
            +   1.curl 报文头配置(cookie字符串, 自定义header头, gzip压缩)
                curl_setopt($ch, CURLOPT_COOKIE,     $cookie);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
                curl_setopt($ch, CURLOPT_ENCODING ,  "gzip");

            +   2.curl https配置
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            +   3.curl debug配置
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_STDERR, $fp); // 文件句柄 $fp = fopen(CURL_DEBUG_LOG_PATH, 'w');

            +   4.回复结果转码(GBK转utf8)
                $result = iconv("gb2312","utf-8//IGNORE", $result);
        
