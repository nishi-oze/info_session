<?php

require_once __DIR__ . '/lib/mysqli.php';

function listRooms($results)
{
    while ($roomName = mysqli_fetch_assoc($results)) {
        $rooms[] = $roomName;
    }

    return $rooms;
}

$link = dbConnect();

//ページが表示されたら担当者一覧を表示(sql文で取得)
$sql = <<<EOT
SELECT school_id,room_name FROM roomT
    WHERE school_id = 1
    AND purpose = '面談'
EOT;

$results = mysqli_query($link, $sql);
if ($results) {
    $rooms = listRooms($results);
} else {
    echo 'Error:データの更新に失敗しました' . PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
}

mysqli_free_result($results);

include 'views/shift_info_session_show.php';
