<!DOCTYPE html>
<html>
<body>

<h1>Status page</h1>

<?php
echo "Established TCP sessions";



//execute the netstat command and grep for established tcp sessions
$output = shell_exec('netstat -ant|grep ESTA|grep \:22');
//echo "<pre>$output</pre>";

// Build an array one netsat tcp line per array content both explode and split are working to indicate then end of the  line
//$tcp = preg_split('/[\r\n]+/', $output);
$tcp = explode("\n", $output);


//Show  net stat array for debbug 
//print_r($tcp);



//loop for eacg line/value of the array.

foreach($tcp as $value) {

  echo "<pre>=====================================</pre>";	
  //Debbug 
  //echo "<pre>$value</pre>";

  // Create another array to separtate the line per space ala awk
  $tcpline = preg_split("/[\s,]+/", $value);

  // Print nothing if the variable is empty 
  if (!empty($tcpline[3])) echo "<pre>Server IP $tcpline[3]</pre>";
  if (!empty($tcpline[4])) echo "<pre>Remote IP $tcpline[4]</pre>";
  //Show array
  //print_r($tcpline);



}
?> 

</body>
</html>
