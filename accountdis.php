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
    <title>Accounts</title>
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
<header>
    <h1>
<button class="custom-button">
    <a href="home.php?id=<?php echo $account['account_id']; ?>" style="text-decoration: none; color: inherit;">Home</a>
</button>
<button class="custom-button">
    <a href="create_acc.php?id=<?php echo $account['account_id']; ?>" style="text-decoration: none; color: inherit;">Create an Account</a>
</button>
<button class="custom-button">
    <a href="accdelete.php?id=<?php echo $account['account_id']; ?>" style="text-decoration: none; color: inherit;">Delete an Account</a>
</button>
    </h1>
</header>

<h1>Your Accounts</h1> 
   <body> 
    <?php 
  $disp = new Account(); 
  $display = $disp->display();
?>
<table border='1'>
  <thead>
    <th>User ID</th>
    <th>Name</th>
    <th>Account ID</th>
    <th>Account Type</th>
    <th>Balance</th>
    <th>Opened On</th>
   
  </thead>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo $row ['fname'];
                  echo " "; 
                  echo $row ['mname']; 
                  echo " "; 
                  echo $row ['lname']?></td>
        <td><?php echo $row['account_id']; ?></td>
        <td><?php echo $row['account_type']; ?></td>
        <td><?php echo $row['balance']; ?></td>
        <td><?php echo $row['opened_on']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    

</body>
</body>
