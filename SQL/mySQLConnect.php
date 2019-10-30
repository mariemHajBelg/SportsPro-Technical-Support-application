<?php
$con = null;
$url = "localhost";
$username = "";
$password = "";
$DBname = "tech_support";

$con = newConnection($url,$username,$password,$DBname);

function newConnection($URL, $user, $pw, $DB){
    Global $con, $url, $username, $password, $DBname;
    $url = $URL;
    $username = $user;
    $password = $pw;
    $DBname = $DB;
    
    $con = mysqli_connect($url, $username, $password, $DBname);
    
    if (mysqli_connect_errno ( $con )) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error ()."<br/>";
        exit("Connection Error");
    }
    return $con;
}

function openConnection(){
    Global $con, $url, $username, $password, $DBname;
    if($con==null){
        echo "Failed to connect to MySQL: Create New Connection First<br/>";
        exit("Connection Error");
    }else{
        $con = mysqli_connect($url, $username, $password, $DBname);
        
        if (mysqli_connect_errno ( $con )) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ()."<br/>";
            exit("Connection Error");
        }
    }
    return $con;
}


function closeConnection(){
    Global $con;
    mysqli_close($con);
}
?>
