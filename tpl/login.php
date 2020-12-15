<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>ログインページ</title>
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <div class="login-warp">
        <div class="login-form">
            <div class="login-form-top">Login</div>
            <div class="login-form-main">
                <form method="post" action="">
                    <!-- ユーザー名  -->
                    <div class="form-group">
                        <?php if (@$error['logout'] === 'logout') : ?>
                        <p class="error">*ログアウトに成功しました</p>
                        <?php endif; ?>

                        <?php if (@$error['login'] === 'blank') : ?>
                        <p class="error">*ログインをしてください</p>
                        <?php endif; ?>

                        <?php if (@$error['join'] === 'mutch') : ?>
                        <p class="error">*ログインIDまたはパスワードが違います</p>
                        <?php endif; ?>
                        <label for="login_id">ログインID</label>
                        <input type="login_id" class="form-control" name="login_id" placeholder="Yamamoto" />
                    </div>

                    <!-- パスワード  -->
                    <div class="form-group">
                        <label for="pass">パスワード</label>
                        <input type="password" class="form-control" name="pass" placeholder="test" />
                    </div>

                    <button class="btn btn-info" name="yes" value='btn'>ログイン</button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>