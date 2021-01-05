<?php

require __DIR__ . '/vendor/autoload.php';

function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USERNAME'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);

    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

function listPersons($results)
{
    while ($personName = mysqli_fetch_assoc($results)) {
        echo $personName['last_name'] . "  " . $personName['first_name'] . PHP_EOL;
    }
}

//$persons = [];
$link = dbConnect();

//ページが表示されたら担当者一覧を表示(sql文で取得)
$sql = <<<EOT
SELECT last_name,first_name FROM employT as emT
    LEFT JOIN belongT as beT ON emT.employ_id = beT.employ_id
    LEFT JOIN schoolT as scT ON beT.school_id = scT.school_id
    WHERE beT.school_id = 1
EOT;

$results = mysqli_query($link, $sql);
if ($results) {
    listPersons($results);
} else {
    echo 'Error:データの更新に失敗しました' . PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
}

mysqli_free_result($results);
