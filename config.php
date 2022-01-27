<?php
    function connect_to_database(){
        $dbsvname="localhost";
        $dbusername="root";
        $dbpassword="";
        $db_table="education";
        $dbcon=new mysqli($dbsvname,$dbusername,$dbpassword,$db_table);
        return $dbcon; 
    }
    function random_number(){
        return rand();
    }
    function upload_pics($file,$destination){
        if(move_uploaded_file($file,$destination)){
            echo "uploaded";
        }
    }
    function page_handling($add){
        echo $_SERVER["PHP_SELF"]."?add=".$add;
    }

?>