<?php


class Test extends Dbh{

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