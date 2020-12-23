<?php

$link = mysqli_connect('db','test_user','pass','test');

if(!$link){
    echo 'Error:データベースに接続できませんでした'.PHP_EOL;
    echo 'Debugging error:'.mysqli_connect_error().PHP_EOL;
    exit;
}

echo 'データベースに接続できました'.PHP_EOL;

$sql = <<<EOT
INSERT INTO shift_info_sessionT (
    reservation_date,
    start_time,
    employ_id,
    place
) VALUES (
    '2020-12-20',
    '15:00',
    5,
    '面談室5'
)
EOT;

echo 'INSERTできた？' . PHP_EOL;

mysqli_close($link);
echo 'データベースとの接続を切断しました'.PHP_EOL;
