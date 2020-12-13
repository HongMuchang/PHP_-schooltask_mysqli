<?php

//---------------------------------
//--------------接続----------------
//---------------------------------
function dbConnect($host,$user,$pass,$db){
    $cn = @mysqli_connect($host,$user,$pass,$db);
    mysqli_set_charset($cn, 'utf8');
    return $cn;
}

//---------------------------------
//----------接続例外処理-------------
//---------------------------------
function dbConnectErr($link)
{
  if (!$link) {
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：103)';
    require_once './tpl/error.php';
    exit;
  }
}

//---------------------------------
//-----------実行例外処理------------
//---------------------------------
function sqlErr($link, $result)
{
  if (!$result) { //エラー処理
    mysqli_close($link);
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：104)';
    require_once './tpl/error.php';
    exit;
  }
}

//---------------------------------
//-------------全件取得-------------
//---------------------------------
// [関数名]:fetchAll
// 第1引数: テーブル名
// return: array
//---------------------------------
function fetchAll($table)
{
  $link = dbConnect();//接続
  $result = mysqli_query($link, "SELECT * FROM $table");
  
  while($list=mysqli_fetch_array($result)){//ある分だけループで取得
    $lists[]=$list;
  }
  mysqli_close($link);
  return $lists;
}

//---------------------------------
//-------------指定取得-------------
//---------------------------------
// [関数名]:fetch
// 第1引数: カラム名
// 第2引数: テーブル名
// return: array
//---------------------------------
function fetch($column_name,$table_name)
{
  $link = dbConnect();//接続
  $result = mysqli_query($link, "SELECT $column_name FROM $table_name ");
  
  while($list=mysqli_fetch_array($result)){//ある分だけループで取得
    $lists[]=$list;
  }
  sqlErr($link,$result); //実行例外処理
  mysqli_close($link);
  return $lists;
}

//---------------------------------
//------------idで1行取得-----------
//---------------------------------
// [関数名]:fetchId
// 第1引数: カラム名
// 第2引数: テーブル名
// 第3引数: 取得したいid
// return: array
//---------------------------------
function fetchId($db,$table_name,$id)
{
  $link = $db;//接続
  $result = mysqli_query($link, "SELECT * FROM $table_name Where id = $id");
  while($list=mysqli_fetch_array($result)){//ある分だけループで取得
    $lists[]=$list;
  }
  mysqli_close($link);
  return $list;
}
//---------------------------------
//-------------var_dump------------
//---------------------------------
function dump($result)
{
  echo '<pre>';
  var_dump($result);
  echo '</pre>';
}

//---------------------------------
//--------where文テンプレート--------
//---------------------------------
// [関数名]:where
// 第1引数: カラム名
// 第2引数: テーブル名
// 第3引数: 条件
// return: array
//---------------------------------
function where($column_name, $table, $where)
{
  $result = mysqli_query($link, "SELECT $column_name FROM $table WHERE $where");
  while($list=mysqli_fetch_array($result)){//ある分だけループで取得
    $lists[]=$list;
  }
  exeErr($link, $result);//実行エラー
  return $lists;
}

/**
 * sql result例外処理
 * [関数名]:exeErr
 * 第1引数: $link
 * 第2引数: $result
 */
function exeErr($link,$result)
{
  if (!$result) { //エラー処理
    mysqli_close($link);
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。(エラーコード：104)';
    exit;
  }
}

//---------------------------------
//------insert文テンプレート--------
//---------------------------------
// [関数名]:insert
// 第1引数 テーブル名
// 第2引数 カラム名(複数可)
// 第3引数~ insertする値
// 第4引数~ insertする値
// 第5引数~ insertする値
// 第6引数~ insertする値
//---------------------------------
function insert($table,$column_name,$val1, $val2,$val3,$val4)
{
  $link = dbConnect();
  dbConnectErr($link); //接続例外処理
  $stmt = $link->prepare("INSERT INTO $table ($column_name) VALUES (?,?,?,?)");
  $stmt->bind_param('ssss', $val1, $val2,$val3,$val4);
  $stmt->execute();
  $link->close();
}

//---------------------------------
//------insert文テンプレート--------
//---------------------------------
// [関数名]:insert
// 第1引数 テーブル名
// 第2引数 カラム名(複数可)
// 第3引数~ insertする値
// 第4引数~ insertする値
// 第5引数~ insertする値
// 第6引数~ insertする値
//---------------------------------
function loginInsert($db,$table,$name, $mail,$login_id,$pass,$salt,$stretch)
{
  $link = $db;
  dbConnectErr($link); //接続例外処理
  $hash_login_id="NULL";
  $user_state=0;
  $file_name="NULL";

  $stmt = $link->prepare("INSERT INTO $table (name,mail,login_id,password,hash_login_id,salt,stretch,user_state,file_name) VALUES (?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param('ssssssiis',$name,$mail,$login_id,$pass,$hash_login_id,$salt,$stretch,$user_state,$file_name);
  $stmt->execute();
  $stmt->close();
  $link->close();
}

function insertLastId($db){
  $link=$db;
  $result = mysqli_query($link, "SELECT COUNT(LAST_INSERT_ID()) FROM m_user");
  while($list=mysqli_fetch_assoc($result)){//ある分だけループで取得
    $lists[]=$list;
  }
  return $lists;
}
//---------------------------------
//--------------最大公約数----------
//---------------------------------
function gcd($m, $n){
    if($n > $m) list($m, $n) = array($n, $m);

    while($n !== 0){
        $tmp_n = $n;
        $n = $m % $n;
        $m = $tmp_n;
    }
    return $m;
}
//---------------------------------
//----------サムネイル関数-----------
//---------------------------------
/**
*@param string $ext **画像の拡張子
*@param string $link
*@param int $limWid
*@param int $limHeight
*@param string $thumLink
*/
function resizeIconImg($ext, $link, $limWid, $limHeight, $thumLink){

    // 元画像のサイズを取得
    $imgSize = getimagesize($link);

    $width = $imgSize[0];
    $height = $imgSize[1];

    /**
    *はみ出し判定
    */
    if($width < $limWid && $height < $limHeight){
        $newWidth = $width;
        $newHeight = $height;
    }else{
        /**
        *最大公約数を求めて幅：高さを求める
        */
        // 最大公約数を求める
        $gcd = gcd($width, $height);
        // 幅の比率を求める
        $ratWidth = $width / $gcd;
        // 高さの比率を求める
        $ratHeight = $height / $gcd;

        /**
        *はみ出ている割合を求めてどちらを基準にするか決める
        */
        // 幅のはみ出し率を求める
        $perWidth = $width / $limWid;
        // 高さのはみ出し率を求める
        $perHeight = $height / $limHeight;

        // はみ出し率から基準を決める
        if($perWidth > $perHeight){
            $newWidth = $limWid;
            $newHeight = $newWidth * $ratHeight / $ratWidth;
        }else{
            $newHeight = $limHeight;
            $newWidth = $newHeight * $ratWidth / $ratHeight;
        }
    }
    if($ext == 'png'){
        // 新しい画像をメモリに作成
        $img_in = imagecreatefrompng($link);
        // 背景が黒い画像を作成する(width, height)
        $img_out = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($img_out, false);
        imagesavealpha($img_out, true);
        // 縮小化された画像を作成する
        imagecopyresampled($img_out, $img_in, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        //pngとして元の画像ファイルにコピー
        imagepng($img_out, $thumLink);
    }elseif($ext == 'jpeg' || $ext == 'jpg'){
        // 新しい画像をメモリに作成
        $img_in = imagecreatefromjpeg($link);
        // 背景が黒い画像を作成する(width, height)
        $img_out = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($img_out, false);
        imagesavealpha($img_out, true);
        // 縮小化された画像を作成する
        imagecopyresampled($img_out, $img_in, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        //pngとして元の画像ファイルにコピー
        imagejpeg($img_out, $thumLink);
    }
    // メモリ内に作った画像を削除
    imagedestroy($img_in);
    imagedestroy($img_out);
}

//---------------------------------
// 半角英数字(6~12)
//---------------------------------
// if (!preg_match('/\A[a-z\d]{6,12}+\z/i',$_POST['login_id'])) {
//   $error['login_id'] = "blank";
// } 

/**
 * [関数名]:randStr
 * [内容] :自動で文字列生成
 * 第1引数:生成する文字数
 */
function randStr($length){
  $res = null;
  $string_length = $length;
  $base_string = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
  for( $i=0; $i<$string_length; $i++ ) {
      $res .= $base_string[mt_rand( 0, count($base_string)-1)];
  }
  return $res;
}

/**
* [関数名]:randNum
* [内容] :自動で数字生成
* 第1引数:スタート回数
* 第2引数:終わりの回数
*/
function randNum($start,$end){
  return $cnt=rand($start,$end);
}

/**
* [関数名]:changeHash
* [内容] :自動でパスワードハッシュ化
* 第1引数:パスワード
* 第2引数:randStr関数(自動文字生成)
* 第3引数:randNum関数(自動数字生成)
*/
function callChengeHash($pass,$fn,$fn2,$str,$start,$end){
  $solt=$fn($str);//randStr呼び出し
  $cnt=$fn2($start,$end);//randNum呼び出し
  for ($i=1; $i <=$cnt ; $i++) { 
      $pass=$solt.$pass;//パスワードに特定の文字連結
      $pass=md5($pass);
  }
  $ary[]=[$solt,$cnt,$pass];
  return $ary;
}

/**
* [関数名]:changeHash
* 第1引数:パスワード
* 第2引数:ソルト
* 第3引数:ハッシュ回数
*/

//-----------------------
//パスワードをハッシュ化する
//-----------------------
function chengeHash($pass,$solt,$cnt){
  for ($i=1; $i <=$cnt ; $i++) { 
      $pass=$solt.$pass;//パスワードに特定の文字連結
      $pass=md5($pass);
  }
  return $pass;
}

function sessionLastId(){
  $SESSION['last_id']=$_SESSION['id'];
}


function PDF($path){
require_once './vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
    'fontdata' => [
        'ipa' => [
            'R' => 'ipag.ttf',
        ]
    ],
    'format' => 'A4',
    'mode' => 'ja'
]);
$mpdf -> WriteHTML(file_get_contents($path),2);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-theme.css'),1);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-min.css'),1);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-grid.css'),1);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-grid.min.css'),1);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-reboot.css'),1);
    // $mpdf -> WriteHTML(file_get_contents('css/bootstrap-reboot.min.css'),1);
    $mpdf -> Output('test.pdf','D');
    
}

//DBの行数
//何ページ表示するか(5)

function set_page_vol($count, $pageLim){
  $totalPage = ceil($count / $pageLim); // 最大ページ数
  return $totalPage;
}

function prev_page($now_page, $file_name){
  $prev_page = $now_page - 1;
  if($now_page > 1){
      $link = '<a href="'.$file_name.'.php?page='.$prev_page.'">前へ</a>';
  }else{
      $link = '前へ';
  }
  return $link;
}

function next_page($now_page, $max_page, $file_name){
  $next_page = $now_page + 1;
  if($now_page < $max_page){
      $link = '<a href="'.$file_name.'.php?page='.$next_page.'">次へ</a>';
  }else{
      $link = '次へ';
  }
  return $link;
}

function page_num($file_name, $max_page, $now_page){
  for($i = 1; $i <= $max_page; $i++){
      if($i == $now_page){
          echo $link = $i;
      }else{
          $link = '<a href="'.$file_name.'.php?page='.$i.'">'.$i.'</a>';
      }
  }
  return $link;
}


//$page $_GET[id]
//$pageLim 5
//$sort DESK or ASC
//$table テーブル名
function set_limit_sql($page, $pageLim, $sort, $table){

  $page=max(1,$page);
  $crit = ($page - 1) * $pageLim;

  $sql = "SELECT * FROM ". $table ." ORDER BY ".$sort." LIMIT ". $crit. "," . $pageLim . "";

  return $sql;
}