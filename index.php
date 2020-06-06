<?php
header('X-Powered-By:Yiyan API');
header('access-control-allow-origin:*');
$redis = new Redis();
$redis->connect('127.0.0.1', 1379);
$redis->auth("5139916@hao");
$key=get_real_ip();
$limit="100";
if (!$redis->exists($key)){
    //第一次访问
    $redis->set($key,1,12*60*60); // 设置过期时间并设置初始值1
}else{
    //已经记录过IP
    if ($redis->get($key)<$limit){ //判断IP有没有到达拉黑阈值
        $redis->incr($key); //次数加一
    }else{
//	    echo  '您当前可能已被反爬虫策略限制，请稍候重试！';exit;
	    header('HTTP/1.1 503 Internal Server Error');exit(503);
    }
}
function get_real_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
if ($_GET['charset']=='GBK' ||$_GET['charset']=='gbk' || $_GET['charset']=='gb2312'){
  $array=file('db.txt');
  $line=count($array);
  $rand=rand(0,$line);

  function utf8_to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
    $string=$array[$rand];
        header('Content-Type: text/html; charset=GBK');
    if ($_GET['code']==='js' || $_GET['code']==='javascript' || $_GET['code']==='JavaScript') {
                header('Content-type: application/x-javascript; charset=GBK');
          echo "function kfanghitokoto(){document.write(\"";
          echo trim(utf8_to_gbk($string)) . "\");}";
                 } elseif ($_GET['code']==='array' || $_GET['code']==='Array' || $_GET['code']==='arr' || $_GET['code']==='Arr') {
                        $arr = array(
                        'code' => 200 ,
                        'msg' => trim(utf8_to_gbk($string))
                        );
                        var_dump($arr);
            }else{
          echo trim(utf8_to_gbk($string));
                }
    }else{

  $array=file('db.txt');
  $line=count($array);
  $rand=rand(0,$line);
  $string=$array[$rand];
  function arrayToXml($arr,$dom=null,$node=null,$root='xml',$cdata=false){
    if (!$dom){
        $dom = new DOMDocument('1.0','utf-8');
    }
    if(!$node){
        $node = $dom->createElement($root);
        $dom->appendChild($node);
    }
    foreach ($arr as $key=>$value){
        $child_node = $dom->createElement(is_string($key) ? $key : 'node');
        $node->appendChild($child_node);
        if (!is_array($value)){
            if (!$cdata) {
                $data = $dom->createTextNode($value);
            }else{
                $data = $dom->createCDATASection($value);
            }
            $child_node->appendChild($data);
        }else {
            arrayToXml($value,$dom,$child_node,$root,$cdata);
        }
    }
    return $dom->saveXML();
}
header('Content-Type: text/html; charset=UTF-8');
    if ($_GET['code']==='js' || $_GET['code']==='javascript' || $_GET['code']==='JavaScript') {
                 header('Content-type: application/x-javascript; charset=UTF-8');
          echo "function kfanghitokoto(){document.write(\"";
          echo trim($string);
          echo "\");}";
                 } elseif ($_GET['code']==='json' || $_GET['code']==='JSON') {
                        header('Content-type: application/json; charset=UTF-8');
                        $json = json_encode(array(
                        'code' => 200 ,
                        'msg' => trim($string)
                        ));
                        echo $json;
                } elseif ($_GET['code']==='xml' || $_GET['code']==='XML') {
                $xml = arrayToXml(array(
                        'msg' => trim($string)
                        ));
                        echo $xml;
                 } elseif ($_GET['code']==='array' || $_GET['code']==='Array' || $_GET['code']==='arr' || $_GET['code']==='Arr') {
                        $arr = array(
                        'code' => 200 ,
                        'msg' => trim($string)
                        );
                var_dump($arr);
        }else{
          echo trim($string);
          }
        }
?>
