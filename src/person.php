<?php

require_once __DIR__ . '/lib/mysqli.php';

function listPersons($results)
{
    while ($personName = mysqli_fetch_assoc($results)) {
        $persons[] = $personName;
        //echo $personName['last_name'] . "  " . $personName['first_name'] . PHP_EOL;
    }

    //mysqli_free_result($results);
    return $persons;
}

//$persons = [];
$link = dbConnect();

//ページが表示されたら担当者一覧を表示(sql文で取得)
$sql = <<<EOT
SELECT last_name,first_name,emT.employ_id FROM employT as emT
    LEFT JOIN belongT as beT ON emT.employ_id = beT.employ_id
    LEFT JOIN schoolT as scT ON beT.school_id = scT.school_id
    WHERE beT.school_id = 1
EOT;

$results = mysqli_query($link, $sql);
if ($results) {
    $persons = listPersons($results);
} else {
    echo 'Error:データの更新に失敗しました' . PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
}

mysqli_free_result($results);

$months = [];
include 'views/shift_info_session_new.php';
