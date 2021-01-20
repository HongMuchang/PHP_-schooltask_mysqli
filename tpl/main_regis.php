<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <title>本登録画面</title>
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
  <div class="login-warp">
    <div class="login-form">
      <div class="login-form-top">本登録画面</div>
      <div class="login-form-main">
        <div class='login-table-center'>
          <form method="post" action="" enctype="multipart/form-data" 　>

            <p class=''>氏名:　<span><?php echo $lists[0]['name'];?>様</span></p>


            <?php if (@$error['pass'] === 'mutch') : ?>
            <p class="error">*パスワードが違います</p>
            <?php endif; ?>
            <div class="form-group form-list">
              <label class="form-title" for="pass">パスワード</label>
              <input type="password" class="form-control" name="pass" placeholder="例）TAROU3939" />
            </div>
            <div class="form-group">
              <!-- ファイル -->
              <?php if (@$error['upload_file'] === 'blank') : ?>
              <p class="error">*画像を選択してください</p>
              <?php endif; ?>
              <label for="upload_file">ファイル</label>
              <input type="file" name="upload_file"><br>
            </div>
            <!-- パスワード  -->
            <hr class='white'>
            <button class="btn btn-info" name="yes" value='btn'>登録</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>