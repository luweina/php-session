
<?php
    session_start();
    $name = $_SESSION['name'];
    $time = $_SESSION['timestamp'];
    $timeSinceLogin = (time() - $_SESSION['timer']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Login as <?php echo $name; ?> at <?php echo $time; ?></h1>
<h2>has login in for <?php echo $timeSinceLogin ?> </h2>

</body>
</html>