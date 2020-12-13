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
    <main>
        <div class="container">
            <h1>一覧表</h1>
            <table style="width:100%; border:2px solid green;">
                <tr style="border-bottom:0.5px solid gray;">
                    <th>id</th>
                    <th>タイトル</th>
                    <th>コメント</th>
                    <th>登録日</th>
                </tr>
                <tr>
                    <td>
                        <p><?php echo $lists[0]['id']; ?></p>
                    </td>
                    <td id=" msg">
                        <p><?php echo $lists[0]['title']; ?></p>
                    </td>
                    <td id=" msg">
                        <p><?php echo $lists[0]['content']; ?></p>
                    </td>
                    <td>
                        <p><?php echo $lists[0]['created_at']; ?></p>
                    </td>
                </tr>
            </table>
            <form action='' method='post'>
                <button type='submit' name='lode' class="btn btn-warning" value='ダウンロード'>PDFダウンロード</button>
            </form>
        </div>
    </main>
</body>

</html>