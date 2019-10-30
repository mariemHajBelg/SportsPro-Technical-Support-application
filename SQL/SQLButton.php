<?php
require("C:/xampp/htdocs/Assign3/event/button.php");
require("C:/xampp/htdocs/Assign3/SQL/delete.php");
require("C:/xampp/htdocs/Assign3/SQL/update.php");
require("C:/xampp/htdocs/Assign3/SQL/restore.php");
require("C:/xampp/htdocs/Assign3/SQL/insert.php");
require("C:/xampp/htdocs/Assign3/SQL/select.php");

function sql_btn_execute($con, $type, $key=null, $key_value=null,$table=null, $update_field=null,$new_value=null,$path=null){
    $execute = false;
    if(isset($key)&&isset($type)){
        if($type=="Delete") $execute = delete($con, $table, $key, $key_value);
//      else if($type==="Update") update($con, $table, $update_field, $new_value, $name, $value);
        else if($type=="Insert") $execute = insert($con,$table,$update_field,$new_value);
        else if($type=="Restore") $execute = restore($con, $path);
        else if($type=="Select") $execute = select($con, $table,$update_field, $key, $key_value);//Need to work on this
    } return $execute;
}
?>
