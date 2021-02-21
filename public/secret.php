
<?php
    require_once ('constants.php');
    session_start();
    $name = $_SESSION['name'];
    $time = $_SESSION['timestamp'];
    $timeSinceLogin = (time() - $_SESSION['timer']);
    $timeElapsed = 0;
    if(isset($_SESSION['lastactivitytime'])){
        $timeElapsed = time()-$_SESSION['lastactivitytime'];
        $_SESSION['lastactivitytime'] = time();
    }else{
        $_SESSION['lastactivitytime'] = time();
    }

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
    <h1>Secret Page</h1>
    <h1>Login as <?php echo $name; ?> at <?php echo $time; ?></h1>
    <h2>has login in for <?php echo $hours.":".$min.":".$sec ?> seconds</h2>
<?php
    if (isset($_SESSION['name'])){
        if ($timeElapsed > 10) {
            header('Location: logout.php');
        } else {
            echo PRIVATE_URL;
            echo '<br>';
            echo SECRET_URL;
            echo '<br>';
            echo LOGOUT_URL;
        };
    };
?>
</body>
</html>