<?php
function delete($con,$table, $key,$key_value){
    try{
        openConnection($con);
        
        $stmt = "DELETE FROM $table WHERE $key = '$key_value';";
        
        mysqli_query($con, $stmt) or die("Execution Error: ".mysqli_errno($con).": ".mysqli_error($con)); 
        return true;
    } catch (Exception $e){
       
        exit("Input Error.");
    }
}

?>

