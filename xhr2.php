<?php
/**
 * Created by PhpStorm.
 * User: ericlai
 * Date: 2018/4/27
 * Time: 上午1:06
 */
require "utils/writedb.php";
//print_r($_FILES["file"]);
//print_r($_POST["answer"]);

function getRandTxt(){
    return md5(time().mt_rand(0,1000));
}

function getExt($filename){
    $match=preg_replace("/.*\.(\w+)/" , "\\1" ,$filename );
    return $match;
}
$uploadsfloder = "uploads/";
if (isset($_POST['answer'])){
    $answer = $_POST['answer']-1;
    $questionid = $_POST['questionId'];
    //key:option
    $arr = array();
    for($i=0;$i<count($_FILES["file"]['name']);$i++){
        $filename = getRandTxt();
        $filenameWithExt = $uploadsfloder.$filename.'.'.getExt($_FILES['file']['name'][$i]);
        //正确选项设correct值为true
        if ($answer == $i){
            $sarr = array();
            $sarr['src'] = $filenameWithExt;
            $sarr['correct'] = true;
            $sarr['check'] = false;
            array_push($arr,$sarr);
        }else{
            $sarr = array();
            $sarr['src'] = $filenameWithExt;
            $sarr['correct'] = false;
            $sarr['check'] = false;
            array_push($arr,$sarr);
        }
        move_uploaded_file($_FILES["file"]["tmp_name"][$i],$filenameWithExt);
    }
    $bigarr = array();
    $bigarr['id'] = getmaxid();
    $bigarr['question'] = $questionid;
    $bigarr['option'] = $arr;
    $json = json_encode($bigarr);
    writedb($json);
    die($json);
    //生成json

}else{
    $filename = getRandTxt();
    $filenameWithExt = $uploadsfloder.$filename.'.'.getExt($_FILES['file']['name']);
    move_uploaded_file($_FILES["file"]["tmp_name"],$filenameWithExt);
    //返回题目id,前段进行选项上传，并生成json保存到数据库
    die($filenameWithExt);
}





?>