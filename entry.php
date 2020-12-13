<?php 
session_start();
require_once '../../const.php';
require_once 'func.php';

if (!empty($_POST)) {

    $db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
    dbConnectErr($db);
    
    //-----------------------------------
    //バリデーション(セッション['join']に保存)
    //-----------------------------------

    $login_id=$_POST['login_id'];
    $db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
    @$result = mysqli_query($db, "SELECT * FROM m_user WHERE login_id = '${login_id}'");
    while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
        @$lake_login_id[]=$list;
    }
    
    $mail=$_POST['mail'];
    $db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
    @$result = mysqli_query($db, "SELECT * FROM m_user WHERE mail = '${mail}'");
    while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
        @$lake_mail[]=$list;
    }
    
    if (@$_POST['username'] == '') {
        $error['username'] = "blank";
    } 
    if (@!preg_match('/\A[a-z\d]{6,12}+\z/i',$_POST['login_id'])) {
        $error['login_id'] = "match";//ログインID(半角英数字6〜12)
    } 
    if (@$_POST['pass']  =='') {
        $error['pass'] = "blank";
    }
    if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
        $error['mail'] = "match";
    }
    
    if(@$lake_login_id[0]['login_id']==$_POST['login_id']){
        $error['login_id'] = "dose";
    }
    if(@$lake_login_id[0]['mail'] == $_POST['mail']){
        $error['mail'] = "dose";
    }
    
    //送られた値を格納
    $_SESSION['join']=[$_POST['username'],$_POST['login_id'],$_POST['mail']];


    //---------------------------------
    //-------------成功時---------------
    //---------------------------------
    if (empty($error)) {
        $_SESSION['login']=$_POST;
        header('Location:./entry_conf.php');
        exit();
    }
}
require_once "./tpl/entry.php";
exit;
?>