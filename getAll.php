<?php
/**
 * Created by PhpStorm.
 * User: ericlai
 * Date: 2018/4/27
 * Time: 上午5:30
 */
header('Content-type: application/json');
require "utils/writedb.php";
$sql = "select * from mathtable";
getdatabysql($sql);