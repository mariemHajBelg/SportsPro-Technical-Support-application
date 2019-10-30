<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/table.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");

//Page Head
echo "<h1>Product List</h1>";

//Creates New Connection and pre-sets query info
$con = openConnection();
$table = "products";
$PK_field = "productCode";
$query = "SELECT * FROM products;";

//Form Info
$method = "GET";
$action = "productList.php";
$RestorePath = "C:/Users/wong_benj/Documents/School/CS 380/Assign3/SQL/tech_support.sql";

//Update Form
    //Table Update
if($method=="GET"){
    if(!empty($_GET[$PK_field])) sql_btn_execute($con, "Delete",$PK_field,$_GET[$PK_field],$table);
} else if ($method=="POST"){
    if(!empty($_POST[$PK_field])) sql_btn_execute($con, "Delete",$PK_field,$_POST[$PK_field],$table);
}
    //Restore Update
if($method=="GET"||$method=="POST"){
    if(!empty($_GET['Restore'])||!empty($_POST['Restore'])) sql_btn_execute($con, "Restore","Restore",null,null,null,null,$RestorePath);
} 

//Retrieve Record Values
$headers =array("Product", "Name", "Version", "Release Date");
query_table($con, $table, $query, $method, $action,$headers, makeButton("foo", "Delete"));

//Open connection
openConnection();

//Reset Button & Add Product
echo "<form method='".$method."' action='".$action."'>";
echo makeButton("add","Add Product", "addProduct.php");
echo makeButton("Restore", "Restore");
echo "</form>";

//Close connection
closeConnection();

?>



