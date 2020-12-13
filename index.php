<?php 
session_start();
require_once "../../const.php";
require_once "./func.php";

//---------------------------------
//----------バリデーション-----------
//---------------------------------
if(empty($_SESSION['index'])){//直接
    $error['login']='blank';
    header('Location:login.php');
    exit();
}
if(@$_POST['logout']){//ログアウト
    $error['logout']='logout';
    session_destroy();
    header('Location:login.php');
    exit();
}

//---------------------------------
//------ログインしてる人の情報---------
//---------------------------------
$login_id=$_SESSION['index'][0];
$db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
$result = mysqli_query($db, "SELECT * FROM m_user WHERE login_id = '${login_id}'");
while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    $user[]=$list;
}
mysqli_close($db);

//---------------------------------
//--------投稿データ取得(m_news)-----
//---------------------------------
$db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
$paging_sql=set_limit_sql($_GET['page'],5,'created_at desc',"m_news");//ページングのSQL
$result = mysqli_query($db, $paging_sql);
while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    $lists[]=$list;
}
mysqli_close($db);

$db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
$result = mysqli_query($db, "SELECT COUNT(*) FROM m_news");
while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    $rows[]=$list;
}


$max_page=set_page_vol($rows[0]['COUNT(*)'],5);//総ページ数


// echo $paging_sql;

require_once "./tpl/index.php";
?>