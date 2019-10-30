<script>
	function notValid(message){
		alert(message);
	}
</script>
<?php
function isValid($date,$format){
    //Dynamic Get Delimiter
    $delimiter = str_replace("y", "", $format);
    $delimiter = str_replace("m", "", $delimiter);
    $delimiter = str_replace("d", "", $delimiter);
    $delimiter = str_replace(" ", "", $delimiter);
    $delimiter = substr($delimiter, 0,1);

    //Standardize Format Input
    $replace = str_repeat("y", substr_count($format, "y"));
    $frmt = str_replace($replace, "y", $format);
    
    $replace = str_repeat("m", substr_count($format, "m"));
    $frmt = str_replace($replace, "m", $frmt);
    
    $replace = str_repeat("d", substr_count($format, "d"));
    $frmt = str_replace($replace, "d", $frmt);
    
    //Tokenize Parts
    $frmt_components = explode($delimiter, $frmt);
    $date_components = explode($delimiter, $date);
    
    $frmt_key = array();
    for($i=0;$i<sizeof($frmt_components);$i++) $frmt_key[$frmt_components[$i]]=$date_components[$i];
   
    //Set Date Values
    $year = $frmt_key["y"];
    $month = $frmt_key["m"];
    $day = $frmt_key["d"];
    
    if($month==1||$month==3||$month==5||$month==7||$month==8||$month==10||$month==12){
        if($day<=31 && $day>0) return true;
        else return false;
    } else if($month==4||$month==6||$month==9||$month==11){
        if($day<=30 && $day>0) return true;
        else return false;
    } else if($month==2){
        if(isLeapYear($year)){
            if($day<=29 && $day>0) return true;
            else return false;
        } else{
            if($day<=28 && $day>0) return true;
            else return false;
        }
    } else return false;

}

function isLeapYear($year){
    if($year%4==0){
        if($year%400==0){
            return true;
        } else return false;
    } else return false;
}

function alert($message=null){
    if(isset($message)) echo "<script>notValid('".$message."')</script>";
    else echo "<script>notValid('User date input is invalid.')</script>";
}

?>