<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/style_user.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>FastFood</title>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="225">
    <?php
      include("../admincp/connectDatabase.php");
      include("order/menu.php");
      include("order/main.php");
      include("../pages/footer.php");
    ?>
</body>
</html>