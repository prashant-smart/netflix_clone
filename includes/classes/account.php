<?php
 class Account{
     private $con;
     private $errArray=array();
     public function __construct($con){
        $this->con=$con;
     }
     // For signup
     public function register($fn,$ln,$un,$em,$em2,$pw,$pw2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmails($em,$em2);
        $this->validatePassword($pw,$pw2);
        if(empty($this->errArray)){
           return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        return false;
     }
     //For signin
     public function login($un,$pw){
      $pw=hash('sha256',$pw);
      $query=$this->con->prepare("SELECT * from user where username=:un AND password=:pw");
      $query->bindValue(":un",$un);
      $query->bindValue(":pw",$pw);
      $query->execute();
      if($query->rowCount()==1){
         return true;
      }
      array_push($this->errArray,Constants::$loginFailed);
      return false;

     }


     private function validateFirstName($fn){ //this is private beacuse by this we can call this function only from inside of class
         if(strlen($fn)<2||strlen($fn)>25){
            array_push($this->errArray,Constants::$firstNameCharacter);
         }
     }
     private function validateLastName($ln){
         if(strlen($ln)<2||strlen($ln)>25){
            array_push($this->errArray,Constants::$lastNameCharacter);
         }
     }
     private function validateUserName($un){
         if(strlen($un)<2||strlen($un)>25){
            array_push($this->errArray,Constants::$userNameCharacter);
            return ;// this return is for if username is not valid then it is not need to check in databse anymore
         }
         $query=$this->con->prepare("SELECT * FROM user WHERE username=:un");// put placeholder for username
         $query->bindValue(":un",$un);// replace placeholder with username

         $query->execute();
         if($query->rowCount()!=0){// return the number of row affected by current query
            array_push($this->errArray,Constants::$userNameTaken);
         }
         
      }
      private function validateEmails($em,$em2){
         if($em!=$em2){
           array_push($this->errArray,Constants::$emailDontMatch);
           return;
         }
         if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errArray,Constants::$emailNotValid);
            return;
         }
         $query=$this->con->prepare("SELECT * from user where email=:em");
         $query->bindValue(":em",$em);

         $query->execute();
         if($query->rowCount()!=0){// return the number of row affected by current query
            array_push($this->errArray,Constants::$emailTaken);
         }
     }
     private function validatePassword($pd,$pd2){
        if($pd!=$pd2){
           array_push($this->errArray,Constants::$passwordDontMatch);
           return;
        }
        if(strlen($pd)<2||strlen($pd)>25){
         array_push($this->errArray,Constants::$passwordLength);
         }
     }
     public function getError($error){
        if(in_array($error,$this->errArray)){
             return $error;
           }
       }

      private function insertUserDetails($fn,$ln,$un,$em,$pw){
         $pw=hash('sha256',$pw);
         $query=$this->con->prepare("INSERT INTO user (firstname,lastname,username,email,password) VALUES(:fn,:ln,:un,:em,:pw)");
         $query->bindValue(':fn',$fn);
         $query->bindValue(':ln',$ln);
         $query->bindValue(':un',$un);
         $query->bindValue(':em',$em);
         $query->bindValue(':pw',$pw);
         return $query->execute();// if the query is successful run then this return true

      }
 }   


?>