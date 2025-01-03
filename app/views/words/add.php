<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error->get_message()) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<form action="add" method="post">
    <?= \Fuel\Core\Form::csrf() ?>
    <div>
        <label for="english_word">英単語:</label>
        <input type="text" name="english_word" id="english_word" required>
    </div>
    <div>
        <label for="japanese_translation">日本語訳:</label>
        <input type="text" name="japanese_translation" id="japanese_translation" required>
    </div>
    <div>
        <button type="submit">追加</button>
    </div>

    <a href="<?= Uri::create('words/index') ?>">戻る</a>
</form>
