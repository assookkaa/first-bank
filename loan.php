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
    <title>Loan</title>
    <link rel="stylesheet" type="text/css" href="loan2.css">
</head>
<body>
    <h1>Loan Application Form</h1>
    <?php
    require "acc_tran.php";
    $loan = new Loan();
    // Process the loan application when the form is submitted
    if (isset ($_POST ["Apply"])) {
        // Retrieve form data
        $account_id = $_POST["account_id"];
        $loan_amount = $_POST["loan_amount"];
        $interest = $_POST["interest"];
        $months = $_POST["months"];

        // Call the loan() function to process the loan application
        $loan->loan($account_id, $loan_amount, $interest, $months);
    }
    ?>

    <form method="POST">
    <h1>Select Account</h1>
    <center>
    We only offer a 3% interest rate
    </center>
    <br>
    <?php 
  $disp = new Account(); 
  $display = $disp->display();
?>
    <table border='.5'>
  <thead>
    <th>Account ID</th>
    <th>User ID</th>
    <th>Name</th>
    <th>Account Type</th>
    <th>Balance</th>
    <th>Opened On</th>
   
  </thead>
  <tbody>
    <?php foreach ($display as $row): ?>
      <tr>
        <td><?php echo $row['account_id']; ?><input type="radio" name="account_id" value = <?php echo $row['account_id']; ?>></button></td>
        <td><?php echo $row['user_id']; ?></td>
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

        <input type="number" name="loan_amount" placeholder="Input Amount" required><br>
        <input type="number" name="months" placeholder="How many months?" required><br>
        <center>
        <input type="radio" name="interest" value="3" required="">3%<br><br>
        <button type="submit" name= "Apply">Apply</button>
        <button type="submit"><a href="home.php?">Back To Home</a></button><br>
        </center>
    </form>
</body>
</html>
