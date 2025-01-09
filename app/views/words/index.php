<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($app_name) ?> - 単語一覧</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-min.js"></script>
    <script src="/assets/js/words.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4"><?= htmlspecialchars($app_name) ?> - 単語一覧</h1>
        <p>1ページあたりの最大単語数: <?= htmlspecialchars($items_per_page) ?></p>
        <div class="mb-3">
            <a href="<?= Uri::create('words/add') ?>" class="btn btn-primary">単語を追加</a>
            <a href="<?= Uri::create('words/import') ?>" class="btn btn-secondary">CSVインポート</a>
            <a href="<?= Uri::create('words/export') ?>" class="btn btn-secondary">CSVエクスポート</a>
        </div>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>英単語</th>
                    <th>日本語訳</th>
                    <th>ステータス</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_words as $word): ?>
                    <tr>
                        <td><?= htmlspecialchars($word['english_word']) ?></td>
                        <td><?= htmlspecialchars($word['japanese_translation']) ?></td>
                        <td>
                            <?php if ($word['status'] === 'understand'): ?>
                                <span class="text-success">◯</span>
                            <?php else: ?>
                                <span class="text-danger">×</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= Uri::create('words/edit/'.$word['id']) ?>" class="btn btn-warning btn-sm">編集</a>
                            <a href="<?= Uri::create('words/delete/'.$word['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('削除しますか？')">削除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="<?= Uri::create('dashboard/index') ?>" class="btn btn-secondary mt-3">戻る</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
