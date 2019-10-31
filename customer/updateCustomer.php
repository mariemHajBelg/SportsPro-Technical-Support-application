<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/table.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/format/formBuilder.php");

//Page Head
echo "<h1>View/Update Customer</h1>";

//Creates New Connection and pre-sets query info
$con = openConnection();
$table = "customers";
$PK_field = "customerID";
$PK_masked = true;
$fieldnames = array("firstname","lastname","address","city","state","postalCode","countryCode","phone","email","password");
$result;

//Form Info
$method = "GET";
$action = "updateCustomer.php";
$update = "update";
$RestorePath = "C:/Users/wong_benj/Documents/School/CS 380/Assign3/SQL/tech_support.sql";

//Retrieve customer info
if($method=="GET"){
    if(!$PK_masked){
        if(!empty($_GET[$PK_field])) $selectSubmission = $_GET[$PK_field];
    } else {
        $maskedValues = select($con, $table,$PK_field);
        for($i=0;$i<sizeof($maskedValues[$PK_field]);$i++){
            if(!empty($_GET[$maskedValues[$PK_field][$i]])){
                $selectSubmission = $maskedValues[$PK_field][$i];
            }
        }
    }
} else if($method=="POST"){
    if(!$PK_masked){
        if(!empty($_POST[$PK_field])) $selectSubmission = $_POST[$PK_field];
    } else {
        $maskedValues = select($con, $table,$PK_field);
        for($i=0;$i<sizeof($maskedValues[$PK_field]);$i++){
            if(!empty($_POST[$maskedValues[$PK_field][$i]])){
                $selectSubmission = $maskedValues[$PK_field][$i];
            }
        }
    }
}

//Pre-enter Customer data page as needed
if(isset($selectSubmission)){
    $result = select($con, $table,null,$PK_field,$selectSubmission);
    $update = $selectSubmission;
} 

//Form Update
if(!empty($_GET[$update])||!empty($_POST[$update])){
    $update_fields = array();
    $update_values = array();
    
    if($method=="GET"){
        for($i=0;$i<sizeof($fieldnames);$i++) {
            if(!empty($_GET[$fieldnames[$i]])) {
                $update_fields[]=$fieldnames[$i];
                $update_values[]=$_GET[$fieldnames[$i]];
            }
        }
    } else if($method=="POST"){
        for($i=0;$i<sizeof($fieldnames);$i++) {
            if(!empty($_POST[$fieldnames[$i]])) {
                $update_fields[]=$fieldnames[$i];
                $update_values[]=$_POST[$fieldnames[$i]];
            }
        }
    }
    
    if(sql_btn_execute($con, "Update", $PK_field, $update, $table, $update_fields,$update_values)){
        $result = select($con, $table,null,$PK_field,$selectSubmission);//Refreshes values that are updated
    }
}

//Restore Update
if($method=="GET"||$method=="POST"){
    if(!empty($_GET['Restore'])||!empty($_POST['Restore'])) sql_btn_execute($con, "Restore","Restore",null,null,null,null,$RestorePath);
}

//Form
echo "<form method='".$method."' action=''>";
   $labels = array(addLabel("First Name: "),
                   addLabel("Last Name: "),
                   addLabel("Address: "),
                   addLabel("City: "),
                   addLabel("State: "),
                   addLabel("Postal Code: "),
                   addLabel("Country Code: "),
                   addLabel("Phone: "),
                   addLabel("Email: "),
                   addLabel("Password: "),
                   addLabel(""));
   $key = array();
   if(!empty($result)){
       foreach($result as $attr => $val) $key[]=$val[0];
       $fields = array(addField("firstname","value='".$key[1]."'"),
                       addField("lastname","value='".$key[2]."'"),
                       addField("address","value='".$key[3]."'"),
                       addField("city","value='".$key[4]."'"),
                       addField("state","value='".$key[5]."'"),
                       addField("postalCode","value='".$key[6]."'"),
                       addField("countryCode","value='".$key[7]."'"),
                       addField("phone","value='".$key[8]."'"),
                       addField("email","value='".$key[9]."'"),
                       addField("password","value='".$key[10]."'"),
                       makeButton($update,"Update Customer"));
   } else  $fields = array(addField("firstname"),//Not entirely needed, but used for dev purposes to view structure
                       addField("lastname"),
                       addField("address"),
                       addField("city"),
                       addField("state"),
                       addField("postalCode"),
                       addField("countryCode"),
                       addField("phone"),
                       addField("email"),
                       addField("password"),
                       makeButton($update,"Update Customer"));//Will fail execution
        
    forceTableStructure($labels, $fields);
echo "</form>";

//Search Customers
echo "<form method='".$method."' action=''>";
    echo makeButton("search", "Search Customers","selectCustomer.php");
    echo makeButton("restore", "Restore");
echo "</form>";


//Close Connection
closeConnection();
?>