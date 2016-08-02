<?php
    class Connect {
        
        private $address = 'localhost';
        private $username = 'root';
        private $password = '';
        private $dbname = 'social';
        private $conn;
        
        public function __construct(){
            $this->connect();
        }
        
        public function connect(){
            
            $conn = new mysqli($this->address,$this->username,$this->password,$this->dbname);
            $this->conn = $conn;
            $this->conn->set_charset("utf8");
            $this->error();
        }
        
        private function error(){
            if($this->conn->connect_error){
                echo "Hiba az adatbázishoz való csatlakozásban: " . mysqli_connect_error();
            }
        }
        
        public function getDb(){
            return $this->conn;
        }
        
    }

?>