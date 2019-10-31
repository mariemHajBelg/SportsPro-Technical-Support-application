<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/table.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/format/formBuilder.php");

//Page Head
echo "<h1>Customer Search</h1>";

//Creates New Connection and pre-sets query info
$con = openConnection();
$table = "customers";
$PK_field = "customerID";
$PK_masked = true;
$query;
$selectSubmission;
$return_fields = array("customerID", "CONCAT(firstName,' ', lastname)", "email", "city");

//Form Info
$method = "GET";
$action = "selectCustomer.php";
                    
//Update Form       
if($method=="GET"){
    if(!empty($_GET['lastName'])) $query = getQuery($table,$return_fields,"lastName",$_GET['lastName']);
} else if($method=="POST"){
    if(!empty($_POST['lastName'])) $query = getQuery($table,$return_fields,"lastName",$_POST['lastName']);
}

//Form
echo "<form method='".$method."' action='".$action."'>";
    $label = addLabel("Last Name: ");
    $field = addField("lastName").makeButton("search", "Search");
    forceTableStructure($label, $field);
echo "</form>";

//Result
if(!empty($query)){
    //Retrieve Record Values
    echo "<h1>Result</h1>";
    $headers =array("Name", "Email", "City");
    if(!query_table($con, $table, $query, $method, "updateCustomer.php",$headers, makeButton("foo", "Select","updateCustomer.php"),$PK_field,$PK_masked))
        echo "<span>No Records Found</span>";
}

//Close Connection
closeConnection();

?>