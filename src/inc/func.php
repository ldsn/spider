<?php
function trimall($str)
{
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian,$hou,$str);    
}

function getpage($url='', $config=array()){
    return file_get_contents($url);
}


