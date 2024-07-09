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
    <title>Pay up nigga</title>
    <link rel="stylesheet" type="text/css" href="loan3.css">
</head>
<body>
    <h1>Loan Payment Form</h1>
    <?php
    require "acc_tran.php";
    if (isset($_POST['Pay'])) {
   
    $loan_id = $_POST['loan_id'];
    $account_id = $_POST['account_id'];
    $payment_amount = $_POST['payment'];

    $loan = new Loan();
    $loan->pay($loan_id, $account_id, $payment_amount);
    
}
?>
<form method="POST">
<h1>Loans</h1> 
   <body> 
    <?php 
  $disp = new Account(); 
  $display = $disp->disloan();
?>
<table border='1'>
  <thead>
    <th>Loan ID</th>
    <th>Account ID</th>
    <th>Name</th>
    <th>Loan Amount</th>
    <th>Loan Term</th>
    <th>Months</th>
    <th>Payment Amount</th>
    <th>Pay date</th>
   
  </thead>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['loan_id']; ?><input type="radio" name="loan_id" value = <?php echo $row['loan_id']; ?> required></button></td>
        <td><?php echo $row['account_id']; ?><input type="radio" name="account_id" value = <?php echo $row['account_id']; ?> required></button></td>
        <td><?php echo $row ['fname'];
                  echo " "; 
                  echo $row ['mname']; 
                  echo " "; 
                  echo $row ['lname']?></td>
        <td><?php echo $row['loan_amount']; ?></td>
        <td><?php echo $row['loan_term']; ?></td>
        <td><?php echo $row['months']; ?></td>
        <td><?php echo $row['payment']; ?></td>
        <td><?php echo $row['paydate']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

        <center>
       <input type="number" name="payment" placeholder="Amount"><br><br>
       <button type="submit" name= "Pay">Apply</button><br> <br>
       <button type="submit"><a href="home.php?">Back To Home</a></button><br>
        </center>
    </form>
</body>
</html>