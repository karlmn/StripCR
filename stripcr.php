<?php

/* --- stripcr --- 
 *
 * Script which removes carriage return (^M) from the end of all lines of a text-file.
 *
 * --- Karl Magnus Nilsen - Tromsø 1st December 2005 ---
 */

/* CR's ascii value is 13*/

/* Output array*/
$outputString;

/* Check input.*/
if($argc != 2){
    echo "Error: Wrong number of arguments.\nUsage: php stripcr.php <file-to-be-stripped>\n";
    exit();
}

/* Read file name.*/
$fileName = $argv[1];

/* Read the file into an array.*/
if(!$lines = file($fileName)){
    echo "Error: Could not read file ".$fileName.".\n";
    exit();
}

/* Read the file size.*/
if(!$numBytesRead = filesize($fileName)){
    echo "Error: Could not read file size of file ".$fileName.".\n";
}
else{
    echo "File ".$fileName."(".$numBytesRead." bytes) is read.\n";
}

/* Remove the CR.*/
foreach($lines as $line){
    $outputString = $outputString.str_replace(chr(13),"",$line);
}

/* Write file.*/
if(!$fp = fopen($fileName, "w")){
    echo "Error: Could not open file ".$fileName.".\n";
    exit();
}

if(($numBytesWritten = fwrite($fp, $outputString)) === FALSE){
    echo "Error: Could not write file ".$fileName.".\n";
}
else{
    echo "File ".$fileName."(".$numBytesWritten." bytes) was successfully written.\n";
}

/* Close file.*/
if(!fclose($fp)){
    echo "Error: Could not close file ".$fileName.".\n";
}
else{
    echo "File closed (og alt er bare godt).\n";
}

?>