<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/formBuilder.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/format/date.php");

//Open Connection
$con = openConnection();

echo "<h1>Add Technician</h1>";

//Form Info
$method = "GET";
$action = "technicianList.php";
$table = "technicians";
$add = "insert";

//Update Form
if(!empty($_GET[$add])||!empty($_POST[$add])){
    $fields = array("firstName", "lastName", "email", "phone", "password");
    $values = getSubmission($fields, $method);
    if(sql_btn_execute($con, "Insert", $add, null, $table, $fields,$values)){
        header("Location: technicianList.php");
        exit;
    }
}

//Form
f_input://GoTo Jump point
echo "<form method='".$method."' action='".$action."'>";
$button = makeButton($add,"Add Technician");
$labels = array(addLabel("First Name: "),
                addLabel("Last Name: "),
                addLabel("Email: "),
                addLabel("Phone: "),
                addLabel("Password: "),
                addLabel(""));
$inputs = array(addField("firstName"),
                addField("lastName"),
                addField("email"),
                addField("phone"),
                addField("password"),
                $button);
forceTableStructure($labels, $inputs);
echo "</form>";

//View Product List Button
echo "<form method='".$method."' action='".$action."'>";
echo makeButton("foo", "View Technician List",$action);
echo "</form>";

//Close Connection
closeConnection();

?>