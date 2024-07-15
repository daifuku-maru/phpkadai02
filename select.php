<?php
// SQL文を準備
try {
    //Password....最後の引数の部分。MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=phpkadai02;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM phpkadai02");

// SQL実行
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    exit('SQLError:' . $e->getMessage());
}

// 結果表示
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>データ一覧</title>
</head>
<body>
    <h1>データ一覧</h1>
    <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <p>
            <?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?> : 
            <a href="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8')?>
            </a> - 
            <?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endwhile; ?>
</body>
</html>
