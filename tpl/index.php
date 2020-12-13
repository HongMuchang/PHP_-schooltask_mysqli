<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>一覧リスト</title>
</head>

<body>
    <header>
        <div>
            <div class='header-left'>
                <h1>会員専用ページ
                </h1>
            </div>
            <div class='header-right'>
                <?php if(@$user[0]['id'] == 10):?>
                <img src='<?php echo DIR_IMG."/user/".$user[0]['id'].'/thumb_'.$user[0]['file_name']; ?>' alt=''>
                <?php endif;?>
                <p><?php echo $user[0]['name'];?>様</p>
                <form action='' method='post'>
                    <button type='submit' name='logout' value='ログアウト' class="btn btn-danger">
                        ログアウト
                    </button>
                </form>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>一覧表</h1>
            <table style="width:100%; border:2px solid green;">
                <tr style="border-bottom:0.5px solid gray;">
                    <th>タイトル</th>
                    <th>登録日</th>
                </tr>
                <?php foreach($lists as $list): ?>
                <tr>
                    <td>
                        <a href="./edit.php?id=<?php echo $list['id']; ?>" target="_blank">
                            <?php echo $list['title']; ?>
                        </a>
                    </td>
                    <td id=" msg">
                        <p><?php echo $list['created_at']; ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class='pageing'>
                <p>
                    <span><?php echo prev_page($_GET['page'],BASE_URL."/14/index");?></span>
                    <?php page_num(BASE_URL."/14/index",$max_page,$_GET['page']);?>
                    <span><?php echo next_page($_GET['page'],$max_page,BASE_URL."/14/index");?></span>
                </p>
            </div>
    </main>
</body>

</html>