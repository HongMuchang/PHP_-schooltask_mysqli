<?php 

session_start();
require_once '../../const.php';
require_once "./func.php";

if(@$_POST['no']){
header('Location:./entry.php');
exit();
}

//---------------------------------
//-----------登録ボタン処理----------
//---------------------------------
if(@$_POST['yes']){
    header('Location:./prov_regis.php');
    exit();
}
require_once "./tpl/entry_conf.php";


?>