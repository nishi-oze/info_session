<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
  <title>担当者登録</title>
</head>

<?php
foreach ($persons as $person) {
  $persons .= "<option value='" . $person['last_name'] . $person['first_name'];
  $persons .= "'>" . $person['last_name'] . $person['first_name'] . "</option>";
}
for ($i = 1; $i < 13; $i++) {
  $months .= "<option value='" . $i;
  $months .= "'>" . $i;
}
?>

<body>
  <h1>担当者登録</h1>
  <form method="GET" action="shift_info_session_show.php">
    担当者を選択して下さい<br>
    <select name="person">
      <?php echo $persons; ?>
    </select><br>
    年を選択して下さい<br>
    <select name="year">
      <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
      <option value="<?php echo date('Y', strtotime('+1 year')); ?>"><?php echo date('Y', strtotime('+1 year')); ?></option>
    </select><br>
    月を選択して下さい<br>
    <select name="month">
      <?php echo $months; ?>
    </select><br>
    <button type="submit">表示</button>
  </form>
</body>

</html>
