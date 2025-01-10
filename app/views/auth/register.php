<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規登録</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">ユーザー新規登録</h1>

        <!-- エラーメッセージの表示 -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- 新規登録フォーム -->
        <form action="" method="post" class="bg-white p-4 shadow-sm rounded">
            <?= \Fuel\Core\Form::csrf(); ?> <!-- CSRFトークンを追加 -->
            <div class="mb-3">
                <label for="username" class="form-label">ユーザー名:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">パスワード確認:</label>
                <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>

        <!-- ログインリンク -->
        <p class="mt-3">既にアカウントをお持ちですか？ <a href="<?= Uri::create('auth/login') ?>">ログイン</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
