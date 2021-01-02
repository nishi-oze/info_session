<?php

function validate($reservation)
{
    $errors = [];

    //担当者IDが正しく入力されているかチェック(先頭がT、残りが5桁の数字になっているか)
    if (!preg_match("/^T\d\d\d\d\d/i", $reservation['employ_id'])) {
        $errors['employ_id'] = 'T12345という体裁で入力してください';
    }

    return $errors;
}

function createShiftInfo($link)
{
    echo '西暦を入力してください' . PHP_EOL;
    echo '西暦:';
    $reservation['year'] = trim(fgets(STDIN));

    echo '月を入力してください' . PHP_EOL;
    echo '月:';
    $reservation['month'] = trim(fgets(STDIN));

    echo '担当者IDを入力してください' . PHP_EOL;
    echo '担当者ID:';
    $reservation['employ_id'] = mb_convert_kana(trim(fgets(STDIN)), "nK");

    echo '予約日を入力してください' . PHP_EOL;
    echo '予約日:';
    $reservation['reservation_date'] = trim(fgets(STDIN));

    echo '開始時間を入力してください' . PHP_EOL;
    echo '開始時間:';
    $reservation['start_time'] = trim(fgets(STDIN));

    echo '場所を入力してください' . PHP_EOL;
    echo '場所:';
    $reservation['place'] = trim(fgets(STDIN));

    echo 'ログインIDを表示します' . PHP_EOL;
    echo 'ログインID:';
    $reservation['login_id'] = trim(fgets(STDIN));

    $validated = validate($reservation);
    if (count($validated) > 0) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
    }

    $sql = <<<EOT
INSERT INTO shift_info_sessionT (
    reservation_date,
    start_time,
    employ_id,
    place,
    login_id
) VALUES (
    "{$reservation['reservation_date']}",
    "{$reservation['start_time']}",
    "{$reservation['employ_id']}",
    "{$reservation['place']}",
    "{$reservation['login_id']}"
)
EOT;

    $result = mysqli_query($link, $sql);
    if ($result) {
        echo 'データを追加しました' . PHP_EOL;
    } else {
        echo 'Error:データの追加に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }
}

function listReservations($reservationLists)
{
    echo '予約一覧を表示します' . PHP_EOL;

    foreach ($reservationLists as $reservation) {
        echo '西暦：' . $reservation['year'] . PHP_EOL;
        echo '月：' . $reservation['month'] . PHP_EOL;
        echo '担当者ID：' . $reservation['employ_id'] . PHP_EOL;
        //echo '担当者名：' . $name . PHP_EOL;
        echo '予約日：' . $reservation['reservation_date'] . PHP_EOL;
        echo '開始時間：' . $reservation['start_time'] . PHP_EOL;
        //echo 'ログインID：' . $login_id . PHP_EOL;
        echo '-------------' . PHP_EOL;
    }
}

function dbConnect()
{
    $link = mysqli_connect('db', 'test_user', 'pass', 'test');

    if (!$link) {
        echo 'Error:データベースに接続できませんでした' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo 'データベースに接続できました' . PHP_EOL;
    return $link;
}

$reservationLists = [];
$link = dbConnect();

while (true) {
    echo '1. 予約を登録' . PHP_EOL;
    echo '2. 予約一覧を表示' . PHP_EOL;
    echo '9. アプリケーションを終了' . PHP_EOL;
    echo '番号を選択してください（1,2,9）：';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createShiftInfo($link);
    } elseif ($num === '2') {
        listReservations($reservationLists);
    } elseif ($num === '9') {
        mysqli_close($link);
        break;
    }
}
var_export($reservationLists);

/*
function createShiftInfo($link)
{

}

$sql = <<<EOT
INSERT INTO shift_info_sessionT (
    reservation_date,
    start_time,
    employ_id,
    place,
    login_id
) VALUES (
    '2020-12-20',
    '15:00',
    8,
    '面談室5',
    9
)
EOT;
*/
