<?php
function insert($con,$table,$fields=null,$values){
    try{
     openConnection($con);
     
     $fieldString = "";
     $valuesString = "";
     
     if(gettype($fields)=="array"){
         for($i=0;$i<sizeof($fields);$i++) {
             $comma = ",";
             if($i==0) $fieldString = "(";
             if($i==(sizeof($fields)-1)) $comma = ")";
             $fieldString = $fieldString.$fields[$i].$comma;
         }
     } else if(!empty($fields)){
         $fieldString = " ".$fields;
     }
     
     if(gettype($values)=="array"){
         for($i=0;$i<sizeof($values);$i++) {
             $comma = ",";
             if($i==(sizeof($values)-1)) $comma = "";
             $valuesString = $valuesString."'".$values[$i]."'".$comma;
         }
     } else {
         $valuesString = "'".$values."'";
     }
      
     $stmt = "INSERT INTO ".$table.$fieldString." VALUES(".$valuesString.");";
     
     echo $stmt;
     
     mysqli_query($con,$stmt) or die("Execution Error: ".mysqli_errno($con));
     return true;
     } catch (Exception $e){
     exit("Input Error.");
     }
}


?>