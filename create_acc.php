<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
require 'dbcon.php';
require 'acc_tran.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation</title>
    <link rel="stylesheet" type="text/css" href="crat.css">
</head>
<body>
    <center>
        <fieldset>
            <legend>Apply Banking Account</legend>
            <?php
                $create = new Account();

                if(isset($_POST['Create'])){
                    $user_id = $_SESSION['user_id'];
                    $account_type = $_POST['account_type'];
                    $create_banking_account = $create->createacc($user_id, $account_type);
                    }
            ?>
            <h1>Select what type of account you want to apply</h1>
            <form method="POST">
                <input type="radio" name="account_type" value="Savings Account" required> Savings Account <br>
                <input type="radio" name="account_type" value="Salary Account">Salary Account<br>
                <input type="radio" name="account_type" value="Student Account">Student Account<br></br>
                <button type="submit" name="Create">Apply
                <a href="accountdis.php"></a>
                </button>
            </form>
            <body>
            <button><a href="home.php">back to Home</a></button>
        </fieldset>
    </center>
</body>

</html>
