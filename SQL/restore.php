<?php
function restore($con, $path){
    try{
     openConnection($con);
          
     //Open restore file
     $file = fopen($path,"r") or die("Could not find restore file.");
     $sql = array();     
     
     while(!feof($file)){
         $line = fgets($file);
         if(!empty($line)) $sql[]=$line;//Remove End of File
     }
     
     fclose($file);
     
     //Put together entire script into one string
     $script="";
     
     for($i=0;$i<sizeof($sql);$i++){
        $script = $script.$sql[$i];
     }
     
     //Tokenize into executable statements
     $token = ";";
     $stmt = explode($token, $script);
     
     //Put together exploded statement & execute
     for($i=0;$i<sizeof($stmt);$i++){
         $sqlStmt = $stmt[$i].$token;
         mysqli_query($con,$sqlStmt);
     }
     return true;
     } catch (Exception $e){
     exit("Input Error.");
     }
          
}
?>