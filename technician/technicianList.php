<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/table.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");

//Page Head
echo "<h1>Technician List</h1>";

//Creates New Connection and pre-sets query info
$con = openConnection();
$table = "technicians";
$PK_field = "techID";
$query = "SELECT * FROM technicians;";

//Form Info
$method = "GET";
$action = "technicianList.php";
$RestorePath = "C:/Users/wong_benj/Documents/School/CS 380/Assign3/SQL/tech_support.sql";
$PK_Masked = true;

//Update Form
//Table Update
if($method=="GET"){
    if(!$PK_Masked){if(!empty($_GET[$PK_field])) sql_btn_execute($con, "Delete",$PK_field,$_GET[$PK_field],$table);}
    else {
       $maskedValues = select($con, $table,$PK_field);
       for($i=0;$i<sizeof($maskedValues[$PK_field]);$i++) 
           if(!empty($_GET[$maskedValues[$PK_field][$i]])) sql_btn_execute($con, "Delete",$PK_field,$maskedValues[$PK_field][$i],$table);
    }
} else if ($method=="POST"){
    if(!$PK_Masked){if(!empty($_POST[$PK_field])) sql_btn_execute($con, "Delete",$PK_field,$_POST[$PK_field],$table);}
    else {
        $maskedValues = select($con, $table,$PK_field);
        for($i=0;$i<sizeof($maskedValues[$PK_field]);$i++)
            if(!empty($_POST[$maskedValues[$PK_field][$i]])) sql_btn_execute($con, "Delete",$PK_field,$maskedValues[$PK_field][$i],$table);
    }
}
//Restore Update
if($method=="GET"||$method=="POST"){
    if(!empty($_GET['Restore'])||!empty($_POST['Restore'])) sql_btn_execute($con, "Restore","Restore",null,null,null,null,$RestorePath);
} 

//Retrieve Record Values
$headers =array("First Name", "Last Name", "Email", "Phone", "Password");
query_table($con, $table, $query, $method, $action,$headers, makeButton("foo", "Delete"),"techID",$PK_Masked);

//Open connection
openConnection();

//Reset Button & Add Technician
echo "<form method='".$method."' action='".$action."'>";
echo makeButton("add","Add Technician", "addTechnician.php");
echo makeButton("Restore", "Restore");
echo "</form>";

//Close connection
closeConnection();

?>