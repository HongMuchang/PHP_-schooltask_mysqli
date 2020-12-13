<?php 
require_once "../../const.php";
require_once "./func.php";


//---------------------------------
//--------idを元に行を取得-----------
//---------------------------------
$id=$_GET['id'];
$db = dbConnect(HOST, USER_ID, PASSWORD, DB_NAME);
@$result = mysqli_query($db, "SELECT * FROM m_news WHERE id ='${id}'");
while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    @$lists[]=$list;
}

if(@$_POST['lode']){
   PDF(BASE_URL."/14/edit.php?id=${id}");
}

require_once "./tpl/edit.php";
?>