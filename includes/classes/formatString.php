<?php
class FormatString{
    public static function formatString($inputText){
        $inputText=strip_tags($inputText); //remove any html tags
        $inputText=str_replace(" ","",$inputText); //to replace all extra space
        $inputText=strtolower($inputText); // convert whole string into lower case
        $inputText=ucfirst($inputText);// convert first alphabet of string into upper case
        return $inputText;
    }
    public static function formatPassword($inputText){
        return $inputText;
    }
    public static function formatEmail($inputText){
        return $inputText;
    }
}  

?>