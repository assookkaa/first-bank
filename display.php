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
    <title>Transactions</title>
    <link rel="stylesheet" type="text/css" href="crat.css">
</head>
<style>
  .custom-button {
    /* Add your desired styles here */
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .custom-button:hover {
    background-color: #45a049;
  }
</style>
<body>
<h1>Transactions</h1> 
<button class="custom-button">
  <a href="home.php?id=<?php echo $account['account_id']; ?>" style="text-decoration: none; color: inherit;">Home</a>
</button>
    <?php 
  $showall = new Account(); 
  $display = $showall->displaytransac();
?>
<table border='1'>
  <thead>
    <th>Transaction ID</th>
    <th>Account ID</th>
    <th>Name</th>
    <th>Transaction Type</th>
    <th>Amount</th>
    <th>Date of transaction</th>
   
  </thead>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['transaction_id']; ?></td>
        <td><?php echo $row['account_id']; ?></td>
        <td><?php echo $row ['fname'];
                  echo " "; 
                  echo $row ['mname']; 
                  echo " "; 
                  echo $row ['lname']?></td>
        <td><?php echo $row['transaction_type']; ?></td>
        <td><?php echo $row['amount']; ?></td>
        <td><?php echo $row['transaction_date']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    

</body>
</body>
