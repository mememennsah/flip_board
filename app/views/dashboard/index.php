<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ダッシュボード</title>
    <!-- CDNからChart.jsをインポート -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>ダッシュボード</h1>

    <?php if (!empty($username)): ?>
        <p>ようこそ、<?= htmlspecialchars($username) ?> さん！</p>
    <?php else: ?>
        <p>ログインしてください。</p>
    <?php endif; ?>

    <h2>学習進捗</h2>
    <!-- ビューにキャンバスを追加 -->
    <canvas id="progressChart"></canvas>
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['理解済み', '未理解'],
                datasets: [{
                    data: [<?= $progress['understood_words'] ?>, <?= $progress['total_words'] - $progress['understood_words'] ?>],
                    backgroundColor: ['#4CAF50', '#F44336']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
    <p>全単語数: <?= $progress['total_words'] ?> 単語</p>
    <p>理解済み単語数: <?= $progress['understood_words'] ?> 単語</p>
    <p>進捗率: <?= $progress['progress'] ?>%</p>

    <p><a href="<?= Uri::create('words/index') ?>">単語一覧を見る</a></p>

    <p><a href="<?= Uri::create('auth/logout') ?>">ログアウト</a></p>

</body>
</html>
