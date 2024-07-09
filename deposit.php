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
    <title>Depostit</title>
    <link rel="stylesheet" type="text/css" href="withdraw.css">
</head>
<body>
  <?php
  // Include the file containing the deposit2() function definition

  if (isset($_POST["Deposit"])) {
    $account_id = $_POST["account_id"];
    $transaction_type = $_POST["Deposit"];
    $amount = $_POST["amount"];

    $depo = new Transaction();
    $depo->deposit2($account_id, $transaction_type, $amount);
  }
  ?>
  <form method="POST">
    <h1>Select Account to withdraw</h1>
    <?php 
  $disp = new Account(); 
  $display = $disp->display();
?>
<table border='1'>
  <thead>
    <th>Account ID</th>
    <th>Account Type</th>
    <th>Balance</th>
    <th>Opened On</th>
   
  </thead>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['account_id']; ?><input type="radio" name="account_id" value = <?php echo $row['account_id']; ?>></button></td>
        <td><?php echo $row['account_type']; ?></td>
        <td><?php echo $row['balance']; ?></td>
        <td><?php echo $row['opened_on']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
      <br>
    <input type="text" name="amount" placeholder="Amount"><br>
    <center>
    <button type="submit" name="Deposit" value = "Deposit">Deposit</button>
    <br>
    <br>
    <button><a href="home.php?">Back To Home</a></button><br>
    </center>
  </form>
</body>
</html>