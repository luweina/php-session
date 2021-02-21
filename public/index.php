<?php
     session_start();
     require_once ('constants.php');
     if (isset($_POST['submit']) && isset($_POST['username']) && $_POST['password']){

         require_once ("../db/db.php");
         $schemas = Array(
             "users" => Array(
                 "path" => "../db/users.csv",
                 "schema" => Array(
                     "UserName",
                     "Password",
                     "LoggedIn",
                     "Attempts"
                 )
             )
         );

         $db = new Database($schemas);

        // var_dump($db->searchTable('users' , 'LastName' , 'safavi'));
         $username = strip_tags($_POST['username']);
         $password = strip_tags($_POST['password']);


         $userRows =  $db->searchTable('users', 'UserName', $username);

        if(!empty($userRows)){
            $flag= 0;
            foreach ($userRows as $row){
                if($row["Password"] == $password) {
                    echo '<h1>successfully logged in</h1> ';
                    $logindatetime = date("Y/m/d H:i:s");

                    //$hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $_SESSION['name'] = htmlentities(($_POST['username']));
                    $_SESSION ['timestamp'] = $logindatetime;
                    //$_SESSION['password'] = htmlentities($hashed_password);
                    $_SESSION['logintime'] = $logindatetime;
                    $_SESSION['timer'] = time();


                    $newUser = Array(
                        "UserName" => $username,
                        "Password" => $password,
                        "LoggedIn" => $logindatetime,
                        "Attempts" => 0
                    );

                    $db->editRow('users', 'UserName', $username, $newUser);
                    $flag=1;
                }
            }
            if($flag == 0){
                echo "<h1>username and password does not match</h1>";
                if(isset($_SESSION['attempts'])){
                    $_SESSION['attempts']++;
                }else{
                    $_SESSION['attempts'] = 1;
                }

                if($_SESSION['attempts'] >= 3){
                    echo "<h1>Account Locked!!</h1>";
                }
            }

        }else{
            echo "<h1>no user exit </h1>";
            if(isset($_SESSION['attempts'])){
                $_SESSION['attempts']++;
            }else{
                $_SESSION['attempts'] = 1;
            }

            if($_SESSION['attempts'] >= 3){
                echo "<h1>Account Locked!!</h1>";
            }
        }
     };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>php session</h1>
    <form action="index.php" method="POST" >
        <input placeholder="username" type="text" name="username" />
        <br>
        <br>
        <input placeholder="password" type="password" name="password" />
        <br>
        <br>
        <input type="submit" name="submit" value="submit" />
     </form>
     <?php
        if (isset($_SESSION['name'])){
            echo PRIVATE_URL;
            echo '<br>';
            echo SECRET_URL;
            echo '<br>';
            echo LOGOUT_URL;
        };
     ?>
</body>
</html>
