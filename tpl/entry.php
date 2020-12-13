<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>登録ページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="./style.css" />
</head>

<body>

    <div class="login-warp">
        <div class="login-form">
            <div class="login-form-top">SignUp</div>
            <div class="login-form-main">
                <form method="post" action="">
                    <!-- 氏名  -->
                    <?php if (@$error['username'] === 'blank') : ?>
                    <p class="error">*氏名を入力してください</p>
                    <?php endif; ?>
                    <div class="form-group form-list">
                        <label class="form-title" for="username">氏名</label>
                        <input type="username" class="form-control" name="username" placeholder="例）HAL太郎"
                            value='<?php echo @$_SESSION['join'][0]?:''; ?>' />
                    </div>

                    <!-- ログインID  -->
                    <?php if (@$error['login_id'] === 'match') : ?>
                    <p class="error">*半角英数字6〜12文字以内で入力してください</p>
                    <?php endif; ?>
                    <?php if (@$error['login_id'] === 'dose') : ?>
                    <p class="error">*既に存在するログインIDです</p>
                    <?php endif; ?>
                    <div class="form-group form-list">
                        <label class="form-title" for="login_id">ログインID</label>
                        <input type="username" class="form-control" name="login_id" placeholder="例）000001"
                            value='<?php echo @$_SESSION['join'][1]?:''; ?>' />
                    </div>

                    <!-- パスワード  -->
                    <?php if (@$error['pass'] === 'blank') : ?>
                    <p class="error">*パスワードを入力してください</p>
                    <?php endif; ?>
                    <div class="form-group form-list">
                        <label class="form-title" for="pass">パスワード</label>
                        <input type="pass" class="form-control" name="pass" placeholder="例）TAROU3939" />
                    </div>

                    <!-- メール  -->
                    <?php if (@$error['mail'] === 'match') : ?>
                    <p class="error">*正しいメールアドレスを入力してください</p>
                    <?php endif; ?>
                    <?php if (@$error['mail'] === 'dose') : ?>
                    <p class="error">*既に存在するメールアドレスです</p>
                    <?php endif; ?>
                    <div class="form-group form-list">
                        <label class="form-title" for="mail">メールアドレス</label>
                        <input type="mail" class="form-control" name="mail" placeholder="例）TAROU@gmail.com"
                            value='<?php echo @$_SESSION['join'][2]?:''; ?>' />
                    </div>
                    <button class="btn btn-info">登録</button>
                </form>
            </div>
        </div>
    </div>
</body>