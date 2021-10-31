<?php
   // include_once(include/classes/constants.php);
 class Account{
     private $con;
     private $errArray=array();
     public function __construct($con){
        $this->con=$con;
     }
     public function register($fn,$ln,$un,$em,$em2,$pw,$pw2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmails($em,$em2);
        

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
         $query=$this->con->prepare("SELECT * from users where username=:un");// put placeholder for username
         $query=bindValue(":un",$un);// replace placeholder with username

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
         $query=$this->con->prepare("SELECT * from users where email=:em");
         $query=bindValue(":em",$em);

         $query->execute();
         if($query->rowCount()!=0){// return the number of row affected by current query
            array_push($this->errArray,Constants::$emailTaken);
         }
     }
     public function getError($error){
        if(in_array($error,$this->errArray)){
             return $error;
           }
       }
 }   


?>