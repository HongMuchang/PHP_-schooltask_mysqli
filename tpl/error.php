<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>エラー画面</title>
</head>

<body>
    <?php if(isset($err_msg)):?>
    <p><?php echo $err_msg; ?></p>
    <?php endif; ?>
</body>

</html>