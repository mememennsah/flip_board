<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>CSVインポート</title>
</head>
<body>
    <h1>CSVインポート</h1>
    <form action="" method="post" enctype="multipart/form-data">
    <?= \Fuel\Core\Form::csrf(); ?> <!-- CSRFトークンを追加 -->
        <div>
            <label for="csv_file">CSVファイルを選択:</label>
            <input type="file" name="csv_file" id="csv_file" required>
        </div>
        <div>
            <button type="submit">インポート</button>
        </div>
    </form>
    <p><a href="<?= Uri::create('words/index') ?>">単語一覧に戻る</a></p>
</body>
</html>
