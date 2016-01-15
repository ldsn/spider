#!/usr/bin/php
<?php
include_once 'inc/func.php';
$keywords = array('鲁东大学吧');
$find = '鲁大学生网';

$url_tmpl = "http://www.baidu.com/s?word=%s&pn=%d";

$result = array();
foreach($keywords as $k=>$v){
    $i = 0;
    while($i<=1000) {
        $url = sprintf($url_tmpl, urlencode($v), $i);
        $contents = getpage($url);
        $contents = trimall($contents);
        $pattern = '/title":"'.$find.'(.*?)url":"(.*?)"/si';
        preg_match($pattern, $contents, $matches);
        $site_url = isset($matches[2])?$matches[2]:null;
        if($site_url){
            $result[] = array('keyword'=>$v,'url'=>$site_url);
            break;
        } else {
            $i+=10;
        }
    }
}

var_dump($result);