<?php  

header("Content-Type: text/event-stream"); 

$list["result"] = TRUE;

echo 'data: ' . json_encode($list) . "\n\n";

flush(); 

?>  