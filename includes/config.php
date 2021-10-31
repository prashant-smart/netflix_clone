<?php
   ob_start();//after this all code doesn't reach to the browser   
   session_start(); // this start a session and it has variable and all variable is clear if season will end (by closing browser)
   date_default_timezone_set("Europe/London");
    try{
        $con=new PDO("mysql:dbname=netflix;host=localhost","root","");
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    catch(PDOException $e){
        exit("Connection failed:" . $e->getMessage()); //"." is use to append string
    }
?>