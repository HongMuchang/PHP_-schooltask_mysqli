<?php
session_start();
require_once "../../const.php";
require_once "./func.php";

$link=dbConnect(HOST,USER_ID,PASSWORD,DB_NAME);
    
$hashary=callChengeHash($_SESSION['login']['pass'],"randStr","randNum",5,1000,10000);
$name=$_SESSION['login']['username'];
$mail=$_SESSION['login']['mail'];
$login_id=$_SESSION['login']['login_id'];
$pass=$hashary[0][2];
$salt=$hashary[0][0];
$stretch=$hashary[0][1];

loginInsert($link,'m_user',$name,$mail,$login_id,$pass,$salt,$stretch);//inser文実行

//直前のinsetしたidを取得
$link=dbConnect(HOST,USER_ID,PASSWORD,DB_NAME);
$result = mysqli_query($link, "SELECT COUNT(LAST_INSERT_ID()) FROM m_user");
while($list=mysqli_fetch_assoc($result)){
    $lists[]=$list;
}
$last_id=$lists[0]['COUNT(LAST_INSERT_ID())'];//insertしたid
$hash=md5($last_id);//idをハッシュ

$link=dbConnect(HOST,USER_ID,PASSWORD,DB_NAME);
$result = mysqli_query($link, "UPDATE m_user SET hash_login_id='$hash' WHERE id = $last_id");


//---------------------------------
//------------メール送信------------
//---------------------------------
$to = "test@gmail.com";
$subject = "仮会員登録のお知らせ";
$message = "この度は仮会員登録ありがとうございます。";
$headers = FROM;
mb_send_mail($to, $subject, $message, $headers); 
session_destroy();

require_once "./tpl/prov_regis.php";