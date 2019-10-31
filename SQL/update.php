<?php
function update($con,$table,$field,$new_value, $key,$key_value){
    try{
        openConnection($con);
        
        $stmt = "";
        
        if(gettype($field)!="array") $stmt = "UPDATE $table SET $field = '$new_value' WHERE $key = '$key_value'";
        else{
            $new_fields = "";
            for($i=0;$i<sizeof($field);$i++) {
                $tokenizer = ", ";
                if($i==(sizeof($field)-1)) $tokenizer = "";
                
                $new_fields = $new_fields.$field[$i]."='".$new_value[$i]."'".$tokenizer;
            }
            $stmt = "UPDATE ".$table." SET ".$new_fields." WHERE ".$key."='".$key_value."';";
        }
        
        mysqli_query($con,$stmt) or die("Execution Error: ".mysqli_errno($con));
        return true;
    } catch (Exception $e){
        exit("Input Error.");
    }
  
}


?>
