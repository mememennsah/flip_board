<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">ログイン</h1>

        <!-- エラーメッセージの表示 -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- ログインフォーム -->
        <form action="" method="post" class="bg-white p-4 shadow-sm rounded">
            <?= \Fuel\Core\Form::csrf(); ?>
            <div class="mb-3">
                <label for="username" class="form-label">ユーザー名:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>

        <!-- 登録リンク -->
        <p class="mt-3">未登録の方はこちらへ: <a href="<?= Uri::create('auth/register') ?>">新規登録</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
