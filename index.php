<?php
require "dbcon.php";
require "log.php";
session_start();
if (isset($_SESSION['user_id'])){
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <header>
        <h1>Black Bank Corporation</h1>
        <img src="images/ballin.png" alt="Ballin" style="width:70px">
    </header>
    <div class="container">
        <fieldset>
            <legend>Login</legend>
            <?php
            if(isset($_POST['login'])){
                $email = $_POST['email'];
                $password = sha1($_POST['password']);

                $getin = new Login();
                $getin->login($email, $password);
                $a = $getin;
                if($a){
                    header("location: home.php");
                }else{
                    echo "[access denied]";
                }
            }
            ?>
            <form method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password"><br></br>
                <button type="submit" name="login">Login</button><br><br>
                <button><a href="signup.php">No Account? </a></button>
            </form>
        </fieldset>
    </div>
</body>
</html>
