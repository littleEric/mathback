<?php

    const mysql_conf = array(
    'host'    => '127.0.0.1:8889',
    'db'      => 'math',
    'db_user' => 'root',
    'db_pwd'  => 'root',
    );
    function writedb($json){


        $mysqli = @new mysqli(mysql_conf['host'], mysql_conf['db_user'], mysql_conf['db_pwd']);
        if ($mysqli->connect_errno) {
        die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
        }
        $mysqli->query("set names 'utf8';");//编码转化
        $select_db = $mysqli->select_db(mysql_conf['db']);
        if (!$select_db) {
        die("could not connect to the db:\n" .  $mysqli->error);
        }

        $sql = "INSERT INTO `mathtable`(`json_col`) VALUES ('{$json}');";

        $res = $mysqli->query($sql);
        if (!$res) {
        die("sql error:\n" . $mysqli->error);
        }

        $mysqli->close();
    }
    function getdatabysql($sql){
        $mysqli = @new mysqli(mysql_conf['host'], mysql_conf['db_user'], mysql_conf['db_pwd']);
        if ($mysqli->connect_errno) {
            die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
        }
        $mysqli->query("set names 'utf8';");//编码转化
        $select_db = $mysqli->select_db(mysql_conf['db']);
        if (!$select_db) {
            die("could not connect to the db:\n" .  $mysqli->error);
        }

        $res = $mysqli->query($sql);
        $arr = array();
        while($row=$res->fetch_row())
        {
            array_push($arr,$row[1]);
        }
        echo json_encode($arr,JSON_UNESCAPED_SLASHES);
        $res->free();//释放内存
        $mysqli->close();//关闭连接
    }
    function getmaxid(){
        $mysqli = @new mysqli(mysql_conf['host'], mysql_conf['db_user'], mysql_conf['db_pwd']);
        if ($mysqli->connect_errno) {
            die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
        }
        $mysqli->query("set names 'utf8';");//编码转化
        $select_db = $mysqli->select_db(mysql_conf['db']);
        if (!$select_db) {
            die("could not connect to the db:\n" .  $mysqli->error);
        }
        $sql = 'select max(id) from mathtable';
        $res = $mysqli->query($sql);
        return $res->fetch_row()[0]+1;
        $res->free();//释放内存
        $mysqli->close();//关闭连接
    }
    function deletebyid($id){
        $mysqli = @new mysqli(mysql_conf['host'], mysql_conf['db_user'], mysql_conf['db_pwd']);
        if ($mysqli->connect_errno) {
            die("could not connect to the database:\n" . $mysqli->connect_error);//诊断连接错误
        }
        $mysqli->query("set names 'utf8';");//编码转化
        $select_db = $mysqli->select_db(mysql_conf['db']);
        if (!$select_db) {
            die("could not connect to the db:\n" .  $mysqli->error);
        }
        $sql = "delete from mathtable where id='{$id}'";
        $res = $mysqli->query($sql);
        if($res){
            echo "delete succeed";
        }else{
            echo "delete failed";
        }
        $res->free();//释放内存
        $mysqli->close();//关闭连接

    }