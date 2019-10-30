<?php
function update($con,$table,$field,$new_value, $key,$key_value){
    echo "<br>Update<br>";
/*    try{
        openConnection($con);
        
        $stmt = "UPDATE $table SET $field = '$new_value' WHERE $key = '$key_value'";
        
        mysqli_stmt_execute($stmt) or die("Execution Error: ".mysqli_errno($con));
        closeConnection();
    } catch (Exception $e){
        exit("Input Error.");
    }
*/   
}


?>