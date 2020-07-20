<?php
    class Database{
        private $dsn= "mysql:host=localhost;dbname=application";
        private $dbUser = 'root';
        private $dbPass = '';
        public $conn;

        public function __construct(){
            try {
               $this->conn=new PDO($this->dsn,$this->dbUser,$this->dbPass);
            //    echo "Connected Successfully to DB";
            } catch (PDOException $e) {
                echo 'Error: '.$e->getMessage();
            }
            return $this->conn;
        }

        public function cleanInput($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function msgAlert($type,$message){
            return '<div class="alert alert-'.$type.' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong class="text-center">'.$message.'</strong>
        
                </div>';
        }
    }

   
    

?>