<?php
function trimall($str)
{
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian,$hou,$str);    
}

function findurl($keywords){
    $find = '鲁大学生网';
    $url_tmpl = "http://www.baidu.com/s?word=%s&pn=%d";
    $result = array();
    foreach($keywords as $k=>$v){
        $i = 0;
        while($i<=1000) {
            $url = sprintf($url_tmpl, urlencode($v), $i);
            $contents = trimall(getpage($url));
            $pattern = '/title":"'.$find.'(.*?)url":"(.*?)"/si';
            preg_match($pattern, $contents, $matches);
            $site_url = isset($matches[2])?$matches[2]:null;
            if($site_url){
                $ua = getua();
                $page_content = getpage($site_url, array('ua'=>$ua));
                $result[] = array('page'=>($i/10+1),'keyword'=>$v,'url'=>$site_url);
                break;
            } else {
                $i+=10;
            }
        }
    }
    return $result;
}

function getua(){
    $default = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36';
    $path = getcwd().'/';
    if(file_exists($path.'ua.config')){
        $contents = file_get_contents($path.'ua.config');
        if($contents){
            $ua = array_filter( explode("\n", $contents) );
            return $ua[ array_rand($ua) ];
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

function getpage($url = "",$config = Array()){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(isset($config['ua'])){
        curl_setopt($ch, CURLOPT_USERAGENT,$config['ua']);
    }
    $rs = curl_exec($ch);
    curl_close($ch); 
    return $rs;
}