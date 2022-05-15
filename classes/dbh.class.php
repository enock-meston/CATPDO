<?php
    class Dbh{
        private $host = "localhost";
        private $user = "root";
        private $pwd = "";
        private $dbname = "dbtest";

        protected function connect(){
            try{
                $dsn = "mysql:host=$this->host;dbname=$this->dbname";//data source name
            $pdo = new PDO($dsn,$this->user,$this->pwd);

            // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            return $pdo;
            }catch(PDOException $e){
                echo $e;
            }
            
           
        }
    }

