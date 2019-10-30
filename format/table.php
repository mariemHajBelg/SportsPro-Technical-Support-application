<?php
$maskedValues = array();

function query_header($con, $table){
    //Retrieve Header Values
    $Headerquery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name ='".$table."';";
    
    $result = mysqli_query($con,$Headerquery) or die('Query failed: '.mysqli_errno($con));
    
    echo "<tr>";
    while($line = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        foreach ($line as $field_value) {
            echo "<th>".$field_value."</th>";
        }
    }
    echo "</tr>";
}

function query_records($con, $table, $query, $method, $action=null, $header=null, $button=null,$qMask=null, $PK_Masked=false){
    //Header
    if(!isset($header)) query_Header($con,$table);
    else{
        echo "<tr>";
        for($i=0; $i<sizeof($header);$i++) echo "<th>".$header[$i]."</th>";
        echo "</tr>";
    }
    
    //Result Query
    $result = mysqli_query($con, $query) or die('Query Failed: '.mysqli_error($con));
   
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr><form method='".$method."' action='".$action."'>";
        $ovrd_button = "";
        $hidden = array();
        foreach ($line as $key => $value) {
            
//            if(gettype($qMask)=="array") for($i=0;$i<sizeof($qMask);$i++);//Need to figure out array mask
            
            //Mask Columns
            if(strcasecmp($key,$qMask)!=0){
                echo "<td><input type='text' value='" . $value . "' name='" . $key . "' readonly='readonly'/></td>";
            } else {
                //Masked PK Button Override
                if(isset($qMask)&&isset($button)&&$PK_Masked===true) {
                    Global $maskedValues;
                    $hidden[]=$value;
                    $maskedValues[$qMask]=$hidden;
                    $ovrd_button = makeButton($value,getBtnValue($button));
                }
            }
        }
        if(isset($button)&&$PK_Masked===false) echo "<td>".$button."</td>";//Does not address possibility of button array (though not needed for A3)
        else if(isset($button)&&$PK_Masked===true) echo "<td>".$ovrd_button."</td>";
        echo "</tr></form>";
    }
}

function query_table($con, $table, $query, $method, $action=null, $header=null, $button=null, $qMask=null, $PK_Masked=false){
    echo "<table name='".$table."'>";
    query_records($con, $table, $query, $method, $action, $header, $button, $qMask, $PK_Masked);
    echo "</table>";
}

function getMaskedValues($maskedCol){
    Global $maskedValues;
    return $maskedValues[$maskedCol];
}

?>