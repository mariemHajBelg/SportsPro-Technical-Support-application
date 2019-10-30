<?php
function select($con, $table, $return_fields=null, $search_fields=null, $search_values=null){
    try{
        openConnection();
        
        $stmt = getQuery($table, $return_fields, $search_fields, $search_values);
        
        //Execute Statement
        $result = mysqli_query($con, $stmt) or die("Execution Error: ".mysqli_errno($con).": ".mysqli_error($con));
        
        $return = array();
        while($line = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            foreach($line as $key => $values) {
                $return[$key][]=$values;
            }
        }
        return $return;
    } catch(Exception $e){
        exit("Error: Select Operation.");
    }
}

function getQuery($table, $return_fields=null, $search_fields=null, $search_values=null){
    $stmt = "";
    
    //Create Statement
    if(!isset($return_fields)&&!isset($search_values)&&!isset($search_fields)){
        $stmt = "SELECT * FROM ".$table.";";
    } else if(isset($return_fields)&&!isset($search_values)&&!isset($search_fields)){
        if(gettype($return_fields)=="array") {
            $input_fields = "";
            for($i=0;$i<sizeof($return_fields);$i++){
                $chrAft = ", ";
                if($i==(sizeof($return_fields)-1)) $chrAft = "";
                $input_fields = $input_fields.$return_fields[$i].$chrAft;
            }
            $stmt = "SELECT ".$input_fields." FROM ".$table.";";
        } else {
            $stmt = "SELECT ".$return_fields." FROM ".$table.";";
        }
    } else if(!isset($return_fields)&&isset($search_values)&&isset($search_fields)){
        if(gettype($search_values)=="array"){
            //Might not need to be defined for A3
        } else {
            $stmt = "SELECT * FROM ".$table." WHERE ".$search_fields."='".$search_values."';";
        }
    } else if(isset($return_fields)&&isset($search_values)&&isset($search_fields)){
        if(gettype($return_fields)=="array") {
            $input_fields = "";
            for($i=0;$i<sizeof($return_fields);$i++){
                $chrAft = ", ";
                if($i==(sizeof($return_fields)-1)) $chrAft = "";
                $input_fields = $input_fields.$return_fields[$i].$chrAft;
            }
            $stmt = "SELECT ".$input_fields." FROM ".$table;
        } else {
            $stmt = "SELECT ".$return_fields." FROM ".$table;
        }
        
        if(gettype($search_values)=="array"){
            //Might not need to be defined for A3
        } else {
            $stmt = $stmt." WHERE ".$search_fields."='".$search_values."';";
        }
    }
    return $stmt;
}
?>