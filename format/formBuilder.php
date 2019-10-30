<?php
function addField($name, $attributes=null){
    return "<input type='text' name='".$name."' ".$attributes.">";
}

function addLabel($string,$for=null){
    return "<label for='".$for."'>".$string."</label>";
}

function getSubmission($name, $method){
    if($method=="GET"){
        if(gettype($name)=="array"){
            $return = array();
            for($i=0;$i<sizeof($name);$i++) $return[] = $_GET[$name[$i]];
        } else {
            $return = $_GET[$name];
        }
        return $return;
    } else if($method=="POST"){
        if(gettype($name)=="array"){
            $return = array();
            for($i=0;$i<sizeof($name);$i++) $return[] = $_POST[$name[$i]];
        } else {
            $return = $_POST[$name];
        }
        return $return;
    }
}

function forceTableStructure($LHS, $RHS){
    try{
        echo "<table>";
            if(gettype($LHS)=="array"&&gettype($RHS)=="array") for($i=0;$i<sizeof($LHS);$i++) echo "<tr><td>".$LHS[$i]."</td><td>".$RHS[$i]."</td></tr>";
            else echo "<tr><td>".$LHS."</td><td>".$RHS."</td></tr>";
        echo "</table>";
    } catch(Exception $e){
        exit("Error: Lefthand and righthand side array inputs must be equal sizes.");
    }
  
}

?>
