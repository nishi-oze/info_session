<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>シフト一覧</title>
</head>

<body>
    <form method="post" action="/../shift_info_session_create.php">
        <button type="submit">送信</button>
        <?php
        require_once __DIR__ . '/../lib/mysqli.php';
        function listRooms($results)
        {
            while ($roomName = mysqli_fetch_assoc($results)) {
                $rooms[] = $roomName;
            }
            return $rooms;
        }
        $link = dbConnect();

        //ページが表示されたら面談室一覧を表示
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
        foreach ($rooms as $room) {
            $rooms .= "<option value='" . $room['room_name'];
            $rooms .= "'>" . $room['room_name'] . "</option>";
        }
        ?>
        <select name="room">
            <?php echo $rooms; ?>
        </select><br>
        <?php
        echo "<p>担当者名：" . $_GET["person"] . "</p>";
        echo "<p>年：" . $_GET["year"] . "</p>";
        echo "<p>月：" . $_GET["month"] . "</p>";
        $days = (int) date('t', mktime(0, 0, 0, $_GET["month"], 1, $_GET["year"]));
        ?>

        <?php for ($day = 1; $day <= $days; $day++) : ?>
            <?php
            $timestamp = mktime(0, 0, 0, $_GET["month"], $day, $_GET["year"]);
            $date = date('w', $timestamp);
            $week = [
                '日', //0
                '月', //1
                '火', //2
                '水', //3
                '木', //4
                '金', //5
                '土', //6
            ];
            ?>
            <p><?php echo $day . "(" . $week[$date] . ")"; ?>
                <input type="checkbox" name="11startTime_<?php echo $day ?>" value="11:00" id="11:00"><label>11:00</label>
                <input type="checkbox" name="12startTime_<?php echo $day ?>" value="12:00" id="12:00"><label>12:00</label>
                <input type="checkbox" name="13startTime_<?php echo $day ?>" value="13:00" id="13:00"><label>13:00</label>
                <input type="checkbox" name="14startTime_<?php echo $day ?>" value="14:00" id="14:00"><label>14:00</label>
                <input type="checkbox" name="15startTime_<?php echo $day ?>" value="15:00" id="15:00"><label>15:00</label>
                <input type="checkbox" name="16startTime_<?php echo $day ?>" value="16:00" id="16:00"><label>16:00</label>
                <input type="checkbox" name="17startTime_<?php echo $day ?>" value="17:00" id="17:00"><label>17:00</label>
                <input type="checkbox" name="18startTime_<?php echo $day ?>" value="18:00" id="18:00"><label>18:00</label>
                <input type="checkbox" name="19startTime_<?php echo $day ?>" value="19:00" id="19:00"><label>19:00</label>
                <input type="checkbox" name="20startTime_<?php echo $day ?>" value="20:00" id="20:00"><label>20:00</label>
            <?php endfor; ?></p>
    </form>
</body>

</html>
