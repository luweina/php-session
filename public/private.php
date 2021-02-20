
<?php
    session_start();
    $name = $_SESSION['name'];
    $time = $_SESSION['timestamp'];
    $timeSinceLogin = (time() - $_SESSION['timer']);
    $_SESSION['lastactivitytime'] = time();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 $hours = floor($timeSinceLogin/3600);
 $min = floor(($timeSinceLogin/60)%60);
 $sec = $timeSinceLogin%60;
?>
<h1>Login as <?php echo $name; ?> at <?php echo $time; ?></h1>
<h2>has login in for <?php echo $hours.":".$min.":".$sec ?> seconds</h2>
<?php
        if (isset($_SESSION['name'])){
            echo  '<a href="private.php">private</a>';
            echo '<br>';
            echo '<a href="secret.php">secret</a>';

        };

     ?>

    <?php
        if ($timeSinceLogin > 180 ) {
            session_destroy();
            header('Location: index.php');
        }
     ?>


</body>
</html>