<?php
function makeButton($name,$value, $action=null){
    return "<input type='submit' value='".$value."' name='".$name."' formaction='".$action."'/>";
}

function getBtnName($search,$method=null){
    if(isset($method)){
        if(gettype($search)=="array"){
            for($i=0;$i<sizeof($search);$i++){
                    if($method==="GET"){
                        if(isset($_GET[$search[$i]])){
                            return $search[$i];
                        }
                    } else if($method==="POST"){
                        if(isset($_POST[$search[$i]])){
                            return $search[$i];
                        }
                    } 
            }
        } else {
            if($method==="GET"){
                if(isset($_GET[$search])){
                    return $search;
                }
            } else if($method==="POST"){
                if(isset($_POST[$search])){
                    return $search;
                }
            } 
        }
    } else {
        $tokenize = explode("'", $search);
        return $tokenize[5];
    }
}

function getBtnValue($btnName, $method=null){
    if(isset($method)){
        if(isset($_GET[$btnName])||isset($_POST[$btnName])){
            if($method==="GET") return $_GET[$btnName];
            else if($method==="POST") return $_POST[$btnName];
        }
    } else {
        $tokenize = explode("'", $btnName);
        return $tokenize[3];
    }
}

?>