<?php 
    require_once('config.php');

    class Auth extends Database{
        public function saveUserEmail($email,$token){
            $sql = "INSERT INTO user_data (email,token) VALUES (:email,:token)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email,'token'=>$token]);
            return true;
        }

        // check if user Exist
        public function checkUser($email){
            $sql = "SELECT email from user_data WHERE email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function checkToken($token,$email){
            $sql = "SELECT token from user_data WHERE token=:token && email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['token'=>$token,'email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insertData($fname,$lname,$addr,$marital,$edu,$subject,$rel,$state,$dob,$img,$email){
            $sql = "UPDATE user_data SET 
            first_name=:fname,last_name=:lname,adress=:addr,marital_status=:marital,education_background=:edu,
            best_subject=:subject,religion=:rel,state_of_origin=:state,dob=:dob,image=:img,verify=1 WHERE email=:email";
            $stmt= $this->conn->prepare($sql);
            $stmt->execute([
                'fname'=>$fname,
                'lname'=>$lname,
                'addr'=>$addr,
                'marital'=>$marital,
                'edu'=>$edu,
                'subject'=>$subject,
                'rel'=>$rel,
                'state'=>$state,
                'dob'=>$dob,
                'img'=>$img,
                'email'=>$email
                ]);
            return true;
        }

        public function fetchData($email,$token){
            $sql="SELECT * FROM user_data WHERE email=? && token=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email,$token]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        
    }
   
?>