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
                $page_content = getpage($site_url);
                $result[] = array('page'=>$i/10,'keyword'=>$v,'url'=>$site_url);
                break;
            } else {
                $i+=10;
            }
        }
    }
    return $result;
}

function getpage($url='', $config=array()){
    return file_get_contents($url);
}
