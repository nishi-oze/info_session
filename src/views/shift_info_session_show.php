<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>シフト一覧</title>
</head>

<body>
    <!-- 担当者名を表示 -->
    <!-- 年を表示 -->
    <!-- 月を表示 -->
    <?php
    echo "<p>担当者名：" . $_GET["person"] . "</p>";
    echo "<p>年：" . $_GET["year"] . "</p>";
    echo "<p>月：" . $_GET["month"] . "</p>";
    ?>

</body>

</html>
