<?php
function getpage($url,$config['ua']){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(isset($config['ua']))
    curl_setopt($ch, CURLOPT_USERAGENT,$config['ua']);
    $rs = curl_exec($ch);
    curl_close($ch); 
    return $rs;
}
?>