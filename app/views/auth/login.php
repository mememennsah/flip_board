<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <?= \Fuel\Core\Form::csrf(); ?>
        <div>
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">ログイン</button>
        </div>
    </form>

    <p>未登録の方はこちらへ: <a href="<?= Uri::create('auth/register') ?>">新規登録</a></p>
</body>
</html>
