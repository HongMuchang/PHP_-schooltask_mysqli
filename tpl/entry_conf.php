<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>仮登録確認画面</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <div class="login-warp">
        <div class="login-form">
            <div class="login-form-top">仮登録確認画面</div>
            <div class="login-form-main">
                <div class='login-table-center'>
                    <table>
                        <tr>
                            <th class='login-tr'>氏名:</th>
                            <td class='login-td'><?php echo $_SESSION['login']['username']?></td>
                        </tr>
                        <tr>
                            <th class='login-tr' >ログインID:</th>
                            <td class='login-td'><?php echo $_SESSION['login']['login_id']?></td>
                        </tr>
                        <tr>
                            <th class='login-tr' >パスワード:</th>
                            <td class='login-td'><?php echo $_SESSION['login']['pass']?></td>
                        </tr>
                        <tr>
                            <th class='login-tr' >メールアドレス:</th>
                            <td class='login-td'><?php echo $_SESSION['login']['mail']?></td>
                        </tr>
                    </table>
                    <hr class='white'>
                </div>
                <form action='' method="post">
                    <button class="btn btn-info" name="no" value='btn'>再設定</button>
                    <button class="btn btn-info" name="yes" value='btn'>登録</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>