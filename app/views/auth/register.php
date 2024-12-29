<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirm">パスワード確認:</label>
            <input type="password" name="password_confirm" id="password_confirm" required>
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>

    <p>既にアカウントをお持ちですか？ <a href="<?= Uri::create('auth/login') ?>">ログイン</a></p>
</body>
</html>
