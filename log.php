<?php
Class Login{
    
    private $db, $email, $password;

    public function __construct() {
        require "dbcon.php";
        $this->db = $con;
    }

    public function login($email, $password) {
        $st = $this->db->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        $st->bind_param("ss", $email, $password);

        $st->execute();
        $res = $st->get_result();

        if($res -> num_rows > 0){
            $row = $res->fetch_assoc();
                $_SESSION ['user_id'] = $row['user_id'];
                $_SESSION ['fname'] = $row['fname'];
                $_SESSION ['mname'] = $row['mname'];
                $_SESSION ['lname'] = $row['lname'];
                $_SESSION ['age'] = $row['age'];
                $_SESSION ['sex'] = $row['sex'];
                $_SESSION ['email'] = $row['email'];
                $_SESSION ['password'] = $row['password'];

                return true;

        }else {
            echo "Invalid email or password";
        }
        $st->close();
    }
}

Class Signup{
    private $db, $fname, $mname, $lname, $age, $sex, $email, $password;

    public function __construct()
    {
        require 'dbcon.php';
        $this->db = $con;
    }

    public function signup($fname, $mname, $lname, $age, $sex, $email, $password){
        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->age = $age;
        $this->sex = $sex;
        $this->email = $email;
        $this->password = sha1($password);

        $stmt = $this->db->prepare("INSERT INTO user (fname, mname, lname, age, sex, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $fname, $mname, $lname, $age, $sex, $email, $password);
        $result = $stmt->execute();
        
        if ($result) {
            echo "Registered";
        } else {
            echo "Registration failed.";
        }
        
        $stmt->close();
    }

}



?>