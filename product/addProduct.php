<?php
require("C:/xampp/htdocs/Assign3/SQL/mySQLConnect.php");
require("C:/xampp/htdocs/Assign3/format/formBuilder.php");
require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/format/date.php");

//Open Connection
$con = openConnection();

echo "<h1>Add Product</h1>";

//Form Info
$method = "GET";
$action = "productList.php";
$table = "products";
$add = "insert";

//Update Form
if(!empty($_GET[$add])||!empty($_POST[$add])){   
    $fields = array("productCode","name","version","releaseDate");
    $values = getSubmission($fields, $method);
    if(!isValid(getSubmission("releaseDate", $method), "yyyy-mm-dd")){
        alert();
        goto f_input;
        return;//Return in case goto error
    }
    if(sql_btn_execute($con, "Insert", $add, null, $table, $fields,$values)){
        header("Location: productList.php");
        exit;
    }
}

//Form
f_input://GoTo Jump point
echo "<form method='".$method."' action='".$action."'>";
    $button = makeButton($add,"Add Product");
    $labels = array(addLabel("Code: ","code"),
                    addLabel("Name: ","name"),
                    addLabel("Version: ","version"),
                    addLabel("Release Date: ","release"),
                    addLabel(""));
    $inputs = array(addField("productCode","id='code' required='required'"),
                    addField("name","id='name' required='required'"),
                    addField("version","id='version' required='required'"),
                    addField("releaseDate","id='release' required='required'
                                            pattern='[0-9]{4}-([0][1-9]|[1][0-2])-([0][1-9]|[12][0-9]|[3][01])' 
                                            title='Please enter a valid date range using &#39;yyyy-mm-dd&#39; format.'")
                    .addLabel("Use 'yyyy-mm-dd' format","field_hint"),
                    $button);
    forceTableStructure($labels, $inputs);
echo "</form>";

//View Product List Button
echo "<form method='".$method."' action='".$action."'>";
echo makeButton("foo", "View Product List",$action);
echo "</form>";

//Close Connection
closeConnection();
?>