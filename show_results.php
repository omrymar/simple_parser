<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game results</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="center">
  <div class="content">
    <?php $results = parser($_POST['instruction'],$_POST['dice_type'], $_POST['count'])?>

    <?php foreach ($results as $result): ?>
      <div class="dice-<?php echo $result; ?> dices"></div><br/>
    <?php endforeach; ?>

    <form action="index.php" method="post" role="form">
      <div class="btn_center">
        <input type="submit" value="На главную" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>
</body>
</html>
