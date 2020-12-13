<?php 
require_once "../../const.php";
require_once "./func.php";
session_start();


if(@$_POST['yes']){
    @$login_id=$_POST['login_id'];
    @$pass=$_POST['pass'];    
    
    $db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
    @$result = mysqli_query($db, "SELECT * FROM m_user WHERE login_id ='${login_id}'");
    while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
        @$lists[]=$list;
    }
    if(empty($lists)){//ログインIDが存在しない時
        $error['join']='mutch';
    }else{
        $hash_pass=chengeHash($pass,$lists[0]['salt'],$lists[0]['stretch']);
        if (@$hash_pass != $lists[0]['password']) {
            $error['join'] = "mutch";
        }    
    }

    if (empty($error)) {
        $_SESSION['index']=[
        $login_id,
        $hash_pass,
    ];
        header('Location:./index.php?page=1');
        exit();
    }
}

require_once "./tpl/login.php";

?>