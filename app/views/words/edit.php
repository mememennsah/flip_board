<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>単語の編集</title>
</head>
<body>
    <h1>単語の編集</h1>
    <form action="" method="post">
    <?= \Fuel\Core\Form::csrf() ?>
        <div>
            <label for="status">ステータス:</label>
            <select name="status" id="status">
                <option value="unknown" <?= $user_word['status'] === 'unknown' ? 'selected' : '' ?>>わからない...</option>
                <option value="understand" <?= $user_word['status'] === 'understand' ? 'selected' : '' ?>>わかる！</option>
            </select>
        </div>
        <div>
            <button type="submit">更新</button>
        </div>
    </form>
    <p><a href="<?= Uri::create('words/index') ?>">戻る</a></p>
</body>
</html>
