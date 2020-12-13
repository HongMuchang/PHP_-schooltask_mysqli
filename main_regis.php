<?php
session_start();
require_once "../../const.php";
require_once "./func.php";

$id=$_GET['id'];
$db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
$result = mysqli_query($db, "SELECT * FROM m_user WHERE hash_login_id ='${id}'");
while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    $lists[]=$list;
  }

if(@$_POST['yes']){

    $hash_pass=chengeHash($_POST['pass'],$lists[0]['salt'],$lists[0]['stretch']);

    if (@$hash_pass != $lists[0]['password']) {
        $error['pass'] = "mutch";
    }
    if (@$_FILES['upload_file']['name']=='') {
        $error['upload_file'] = "blank";
    }
    if (empty($error)) {
        //---------------------------------
        //------ファイルアップロード----------
        //---------------------------------
        $upload_file = $_FILES['upload_file'];
        $ext=explode('.',$upload_file['name']);
        @mkdir("./".DIR_IMG, 0700);
        @mkdir("./".DIR_IMG.'/user/', 0700);
        @mkdir("./".DIR_IMG.'/user/'.$lists[0]['id'], 0700);
        move_uploaded_file($upload_file['tmp_name'], DIR_IMG."/user/".$lists[0]['id'].'/'.$upload_file['name']);
        $file=$upload_file['name'];
        $id=$lists[0]['id'];
        $link=dbConnect(HOST,USER_ID,PASSWORD,DB_NAME);
        $result = mysqli_query($link, "UPDATE m_user SET file_name='${file}',user_state=1 WHERE id = '${id}'");
        
        //---------------------------------
        //---------サムネイル作成------------
        //---------------------------------
        $upload_file = $_FILES['upload_file'];
        $ext=explode('.',$upload_file['name']);
        $ext_name=$ext[1];//ファイル名（拡張子）
        $link = DIR_IMG."/user/".$lists[0]['id'].'/'.$upload_file['name'];
        $thum_link =DIR_IMG."/user/".$lists[0]['id'].'/thumb_'.$upload_file['name'];
        resizeIconImg($ext_name, $link, 60, 70, $thum_link);


        header('Location:./main_regis_comp.php');
        exit();
    }
}


require_once "./tpl/main_regis.php";