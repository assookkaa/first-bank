<?php
require 'dbcon.php';
require 'log.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
    <header>
        <h1>
            Signup for a new account
        </h1>
    </header>
</head>

<body>
<div class="container">
    <center>
        <fieldset>
            <legend>Signup</legend>
            <?php
            $signup = new Signup();
            if(isset($_POST['register'])){
                if($_POST['password'] == $_POST['vpassword']){
                    $fname = $_POST['fname'];
                    $mname = $_POST['mname'];
                    $lname = $_POST['lname'];
                    $age = $_POST['age'];
                    $sex = $_POST['sex'];
                    $email = $_POST['email'];
                    $password = sha1($_POST['password']);

                    $signup->signup($fname, $mname, $lname, $age, $sex, $email, $password);
                }
                else{
                    echo 'Registration failed';
                }
            }
            ?>
            <form method="POST">
                <input type="text" name="fname" placeholder="First name" required><br></br>
                <input type="text" name="mname" placeholder="Middle name" required><br></br>
                <input type="text" name="lname" placeholder="Last name" required><br></br>
                <input type="number" name="age" placeholder="Age" required><br></br>
                <input type="radio" name="sex" value="male"required> Male
                <input type="radio" name="sex" value="female"> Female<br></br> 
                <input type="text" name="email" placeholder="Email" required><br></br>
                <input type="password" name="password" placeholder="Password" required><br></br>
                <input type="password" name="vpassword" placeholder="Verify Password" required><br></br>
                <button type="submit" name="register">Register</button>


            </form>
            <button><a href="index.php">Back to Login</a></button>
        </fieldset>
    </center>
</div>
</body>

</html>