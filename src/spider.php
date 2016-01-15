#!/usr/bin/php
<?php
include_once 'inc/func.php';
$keywords = array('鲁大学生网');

$url = "http://www.baidu.com/s?word=%s&pn=%d";

foreach($keywords as $k=>$v){
    $i = 0;
    $url = sprintf($url, urlencode($v), $i);
    $contents = getpage($url);
    $pos = strpos($contents, $v);
    file_put_contents('a.html',$contents);
    var_dump($pos);
}

