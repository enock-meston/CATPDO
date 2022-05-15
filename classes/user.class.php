<?php


class USER extends Dbh{


// create user Method
    public function newUser($fname,$lname,$phone,$email,$password){
        
        $insertQuery= "INSERT INTO `usertbl`(`fname`, `lname`, `phone`, `email`, `password`, `status`) 
        VALUES (?,?,?,?,?,?)";
        $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

        $stmt = $this->connect()->prepare($insertQuery);
        if (!$stmt->execute([$fname,$lname,$phone,$email,$hashedPwd,1])) {
            $stmt= null;
            header('location: ../login.php?error=stmtfailed');
            exit();
        }else {
            header('location: ../login.php?message=stmtok');
        }

    }









   public function getUsers(){
          $sql= "SELECT * FROM `usertbl`";
          $stmt = $this->connect()->query($sql);

          while ($row = $stmt->fetch()) {
              echo "username: ".  $row['name']."<br > ";
              echo "email :".$row['email']." <br>";
          }
   } 


   public function getUsersStmt($name,$email){
    $sql= "SELECT * FROM `usertbl` WHERE name =? AND email=?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name,$email]);
    $names= $stmt->fetchAll();

    foreach ($names as $name) {
        echo "my name is: ". $name['name']. " And email is :".$name['email'] ;
    }
    
} 
}