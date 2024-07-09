<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
require 'dbcon.php';
require 'acc_tran.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yetus Deletus</title>
    <link rel="stylesheet" type="text/css" href="withdraw.css">
</head>
<body>
  <?php
  // Include the file containing the deposit2() function definition

  if (isset($_POST["Delete"])) {
    $account_id = $_POST["account_id"];

    $deletus = new Account();
    $deletus->delete($account_id);
  }
  ?>
  <form method="POST">
    <h1>Select Account to DELETE</h1>
    <?php 
  $disp = new Account(); 
  $display = $disp->display();
?>
<center>
<table border='.5'>
  <thead>
    <th>Account ID</th>
    <th>Account Holder</th>
    <th>Account Type</th>
    <th>Balance</th>
    <th>Opened On</th>
   
  </thead>
</center>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['account_id']; ?><input type="radio" name="account_id" value = <?php echo $row['account_id']; ?>></button></td>
        <td><?php echo $row ['fname'];
                  echo " "; 
                  echo $row ['mname']; 
                  echo " "; 
                  echo $row ['lname']?></td>
        <td><?php echo $row['account_type']; ?></td>
        <td><?php echo $row['balance']; ?></td>
        <td><?php echo $row['opened_on']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

    <center>
      <br>
    <button type="submit" name="Delete">Delete</button>
    <br>
    <br>
    <button><a href="home.php"></a>Back to home</button>
    </center>
  </form>
</body>
</html>