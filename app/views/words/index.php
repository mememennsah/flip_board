<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>単語一覧</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
    <script src="/assets/js/words.js"></script>
</head>
<body>
    <h1>単語一覧</h1>
    <a href="<?= Uri::create('words/add') ?>">単語を追加</a>
    <table border="1">
        <tr>
            <th>英単語</th>
            <th>日本語訳</th>
            <th>ステータス</th>
            <th>操作</th>
        </tr>
        <?php foreach ($user_words as $word): ?>
            <tr>
                <td><?= htmlspecialchars($word['english_word']) ?></td>
                <td><?= htmlspecialchars($word['japanese_translation']) ?></td>
                <td><?= htmlspecialchars($word['status']) ?></td>
                <td>
                    <a href="<?= Uri::create('words/edit/'.$word['id']) ?>">編集</a>
                    <a href="<?= Uri::create('words/delete/'.$word['id']) ?>" onclick="return confirm('削除しますか？')">削除</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="<?= Uri::create('words/export') ?>">CSVエクスポート</a></p>
</body>
</html>
