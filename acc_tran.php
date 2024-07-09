<?php

CLass Account{
    
    private $db, $user_id, $account_type, $balance, $account_id;

    public function __construct(){
        require 'dbcon.php';
        $this->db = $con;
    }

    public function createacc($user_id, $account_type){
        $this->user_id = $user_id;
        $this->account_type = $account_type;

        $stm= $this->db->prepare("INSERT INTO account (user_id, account_type, balance) VALUES (?, ?, 0)");
        $stm->bind_param("is", $user_id, $account_type);
        $stm->execute();
        $result = $stm;

        if($result){
            echo "Account is created";
        }
    

    }
    public function delete($account_id){
        $this->account_id = $account_id;
        $q = ("DELETE FROM account WHERE account_id = ?");
        $st = $this->db->prepare($q);
        $st->bind_param("i", $account_id);
        $st->execute();
        $res = $st;
        if($res){
            echo "Account is deleted";
        }
    }

    public function display() {
        $user_id = $_SESSION['user_id'];
        
        $query = ("SELECT *
                  FROM account
                  INNER JOIN user ON account.user_id = user.user_id
                  WHERE account.user_id = ?");
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
    
        return $result;
}
public function displaytransac(){
    $account_id = $_SESSION['user_id'];
    $st = $this->db->prepare("SELECT * 
    FROM transaction 
    INNER JOIN account ON transaction.account_id = account.account_id 
    INNER JOIN user ON account.user_id = user.user_id 
    WHERE transaction.account_id = ?");

    $st->bind_param("i", $account_id);                     
    $st->execute();
    $res = $st->get_result();
    return $res;
}
public function disloan(){
    $account_id = $_SESSION['user_id'];
    $st = $this->db->prepare("SELECT * 
    FROM loan_pay 
    INNER JOIN loan on loan_pay.loan_id = loan.loan_id
    INNER JOIN account ON loan.account_id = account.account_id 
    INNER JOIN user ON account.user_id = user.user_id 
    WHERE loan.account_id = ?");

    $st->bind_param("i", $account_id);
    $st->execute();
    $res = $st->get_result();
    $st->close();
    
    return $res;
}
    }


        

Class Transaction{
    private $db, $balance, $account_id, $user_id;
    private $transaction_type, $amount;
    
    public function __construct(){
        require 'dbcon.php';
        $this->db= $con;
    }

   /* public function deposit($account_id, $user_id, $balance) {
        $this->balance = $balance;
        $this->account_id = $account_id;
    
        $stmt = $this->db->prepare("UPDATE account SET balance = balance + ? WHERE account_id = ? AND user_id = ?");
        $stmt->bind_param("iii", $balance, $account_id, $user_id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        
        if ($affectedRows > 0) {
            echo "You deposited: ";
            echo $balance;
        } else {
           
            echo 'yewa';
        }
    }*/

    public function deposit2($account_id, $transaction_type, $amount)
{
    $this->account_id = $account_id;
    $this->transaction_type = $transaction_type;
    $this->amount = $amount;

    try {
        
        $Kuery = "INSERT INTO transaction (account_id, transaction_type, amount) VALUES (?, ?, ?)";
        $niggatras = $this->db->prepare($Kuery);
        $niggatras->bind_param("iss", $account_id, $transaction_type, $amount);
        $niggatras->execute();

        $mommy = "UPDATE account SET balance = balance + ? WHERE account_id = ?";
        $moneybaby = $this->db->prepare($mommy);
        $moneybaby->bind_param("si", $amount, $account_id);
        $moneybaby->execute();

        $this->db->commit();
        echo "Deposit successful.";
    } catch (PDOException $e) {
        $this->db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

    /*public function withdraw($account_id, $user_id, $balance) {
        if ($balance <= 0) {
            echo "Invalid number";
            return false;
        }
        
        $this->balance = $balance;
        $this->account_id = $account_id;
    
        $stmt = $this->db->prepare("UPDATE account SET balance = CASE WHEN balance >= ? THEN balance - ? ELSE balance END WHERE account_id = ? AND user_id = ?");
        $stmt->bind_param("iiii", $balance, $balance, $account_id, $user_id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        
        if ($affectedRows > 0) {
            echo "You withdrew: ";
            echo $balance;
        } else {
            // Handle the case where the update did not affect any row
            return false;
        }
    }*/


    public function withdraw2($account_id, $transaction_type, $amount)
{
    $this->account_id = $account_id;
    $this->transaction_type = $transaction_type;
    $this->amount = $amount;

    try {
        
        if ($amount <= 0) {
            throw new Exception("Error: Invalid withdrawal amount.");
        }

        $fuck = "SELECT `balance` FROM `account` WHERE `account_id` = ?";
        $Bitchotin = $this->db->prepare($fuck);
        $Bitchotin->bind_param("i", $account_id);
        $Bitchotin->execute();
        $kneegrow = $Bitchotin->get_result();
        $balanceRow = $kneegrow->fetch_assoc();
        $yawa = $balanceRow['balance'];

        
        if ($amount > $yawa) {
            throw new Exception("Error: Insufficient balance.");
        }

        $japsilog = "INSERT INTO `transaction` (`account_id`, `transaction_type`, `amount`) VALUES (?, ?, ?)";
        $dick = $this->db->prepare($japsilog);
        $dick->bind_param("iss", $account_id, $transaction_type, $amount);
        $dick->execute();

        $niggaquery = "UPDATE `account` SET `balance` = `balance` - ? WHERE `account_id` = ?";
        $balance = $this->db->prepare($niggaquery);
        $balance->bind_param("si", $amount, $account_id);
        $balance->execute();

        $this->db->commit();
        echo "Withdrawal successful.";
    } catch (Exception $e) {
        $this->db->rollBack();
        echo $e->getMessage();
    }
}

} 

Class Loan{
    private $db;
    
    public function __construct(){
        require 'dbcon.php';
        $this->db=$con;
    }

    private $account_id, $loan_amount,$months, $loan_term, $loan, $loan_status;
    private $interest = 0.3;

    public function loan($account_id, $loan_amount, $interest, $months){
        $this->account_id = $account_id;
        $this->loan_amount = $loan_amount;
        $this->interest =$interest;
        $this->months = $months;
        

        $loaner = "INSERT INTO loan (account_id, loan_amount, interest, months, loan_term) VALUES (?, ?, ?, ?, DATE_ADD(CURDATE(), INTERVAL ? MONTH))";
        $stmt = $this->db->prepare($loaner);
        $loan_term = $months;
        $stmt->bind_param("siiis", $account_id, $loan_amount, $interest, $months, $loan_term);
        $stmt->execute();

        $bal = "UPDATE account SET balance = balance + ? WHERE account_id = ?";
        $blad = $this->db->prepare($bal);
        $blad->bind_param("ii", $loan_amount, $account_id);
        $blad->execute();

        $interest_update = "UPDATE loan SET loan_amount = (((interest/100) * months) * loan_amount )+ loan_amount WHERE account_id = ?";
        $interests = $this->db->prepare($interest_update);
        $interests->bind_param("s", $account_id);
        $interests->execute();

    }

    public function pay($loan_id, $account_id, $payment){
        $pquery = "INSERT INTO loan_pay (loan_id, account_id, payment) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($pquery);
        $stmt->bind_param("iii", $loan_id, $account_id, $payment);
        $stmt->execute();
        $stmt->close();

        $yui = "UPDATE loan SET loan_amount = loan_amount - ?, loan_term = CASE WHEN loan_amount - ? <= 0 THEN CURDATE() ELSE loan_term END WHERE loan_id = ?";
        $stmt = $this->db->prepare($yui);
        $stmt->bind_param("iii", $payment, $payment, $loan_id);
        $stmt->execute();
        $stmt->close();
        echo "ssss";

  }   
  
  
}

?>