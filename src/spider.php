#!/usr/bin/php
<?php
include_once 'inc/func.php';

$str = '鲁东大学,鲁大学生网,鲁东大学学生网,鲁东大学吧,鲁东大学论坛,鲁东大学怎么样,鲁东大学首页,鲁东大学考研,鲁东大学教务信息网,鲁东大学图书馆,鲁东大学研究生处,鲁东大学分数线,烟台大学,烟台论坛';
$keywords = explode(',', $str);
$result = findurl($keywords);

file_put_contents('tmp/log_'.time().'.log', var_export($result,true));