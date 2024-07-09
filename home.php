<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
  
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<style>
    body {
    background-color: #181818;
    color: #ffffff;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0px;
   
  }
    </style>
    <header>
    <h1>WELCOME TO THE BLACK BANK: 
        <?php
        if(isset($_SESSION['fname'])){
            echo $_SESSION['fname'];
            echo " ";
         }
         if(isset($_SESSION['mname'])){
             echo $_SESSION['mname'];
             echo " ";
          }
          if(isset($_SESSION['lname'])){
             echo $_SESSION['lname'];
          }
        ?>
        <img src="images/reaction.jpg" alt="Reaction" style="width: 30px;">
        <button><a href="secret.php">PRESS ME</a></button>
    </h1>
    </header>
        <br>
        <br>

        <button><a href="accountdis.php">Accounts</a></button><br>
        <br>
        <button><a href="display.php?id=<?php echo $account['account_id']; ?>">Show Transactions</a></button><br>
        <br>
        <button><a href="withdraw.php?id=<?php echo $account['account_id']; ?>">Withdraw</a></button><br>
        <br>
		<button><a href="deposit.php?id=<?php echo $account['account_id']; ?>">Deposit</a></button><br>
        <br>
        <button><a href="loan.php?id=<?php echo $account['account_id']; ?>">Loan</a></button><br>
        <button><a href="pay.php?id=<?php echo $account['account_id']; ?>">Pay</a></button><br>
        <br>
        <br>
        <br>
     
        <br>
        <br>
        <button><a href="logout.php">logout</a></button>
    
    </body>
</html>