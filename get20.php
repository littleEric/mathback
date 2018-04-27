<?php
/**
 * Created by PhpStorm.
 * User: ericlai
 * Date: 2018/4/27
 * Time: 上午4:48
 */
header('Content-type: application/json');
require "utils/writedb.php";
$sql = "select * from mathtable LIMIT 20";
getdatabysql($sql);
