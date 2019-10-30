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
$return_fields = array("customerID", "CONCAT(firstName,' ', lastname)", "email", "city");

//Form Info
$method = "GET";
$action = "updateCustomer.php";
                    
//Update Form       $con, $table,$update_field, $key, $key_value,$new_value
if($method=="GET"){//$con, $type, $key=null, $key_value=null,$table=null, $update_field=null, $new_value
    if(!empty($_GET['lastName'])) $query = getQuery($table,$return_fields,"lastName",$_GET['lastName']);
} else if($method=="POST"){
    if(!empty($_POST['lastName'])) echo $_POST['lastName'];
}

//Form
echo "<form method='".$method."' action='".$action."'>";
    $label = addLabel("Last Name: ");
    $field = addField("lastName").makeButton("search", "Search");
    forceTableStructure($label, $field);
echo "</form>";

if(!empty($query)){
    //Retrieve Record Values
    echo "<h1>Result</h1>";
    $headers =array("Name", "Email", "City");
    query_table($con, $table, $query, $method, $action,$headers, makeButton("foo", "Select"),$PK_field,$PK_masked);
}
//Close Connection
closeConnection();

?>