<?php
if(!isset($execute))require("C:/xampp/htdocs/Assign3/SQL/SQLButton.php");
require("C:/xampp/htdocs/Assign3/format/formBuilder.php");

//Page Head
echo "<h1>Customer Login</h1>";
echo "<p>You must login before you can register a product.</p>";

//Form Info
$method = "GET";
$action = "validateCustomer.php";

echo "<form method='".$method."' action='$action'>";
    echo addLabel("Email: ").addField("email","pattern='[a-zA-Z0-9].{1,}@[a-zA-Z]{1,}\.[a-zA-Z]{1,}'","email").makeButton("login", "Login",$action);
echo "</form>";
?>