<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/login/validateLogin.php");

//Info
$con = openConnection();
$table = "customers";
$key = "email";
$method = "GET";

if(!empty($_GET['login'])||!empty($_POST['login'])){
    if($method=="GET") $user = $_GET['email'];
    else if($method=="POST") $user = $_POST['email'];
    
    if(!isValidAccount($con, $table, $key, $user)) {
        $execute = false;
        require("C:/xampp/htdocs/Assign3/customer/login/loginRequest.php");
        
        //Alert
        if(alert("Account does not exist: \'$user\'")){
            echo "<script>window.location.replace('loginRequest.php')</script>";
        }
    }
    else {
        session_start();
        $_SESSION['userID'] = returnAccountInfo($con, $table, $key, $user,"customerID")['customerID'][0];
        header("Location: ../../product/registerProduct.php?login=$user");
    }
}




?>