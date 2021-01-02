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

$result = mysqli_query($link,$sql);
if($result){
    echo 'データを追加しました'.PHP_EOL;
}else{
    echo 'Error:データの追加に失敗しました'.PHP_EOL;
    echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
}

mysqli_close($link);
echo 'データベースとの接続を切断しました'.PHP_EOL;
