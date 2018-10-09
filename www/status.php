<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tcp status page</title>
    <link rel="stylesheet" href="/assets/pure-min.css">
    <link rel="stylesheet" href="/assets/grids-responsive-min.css">
    <link rel="stylesheet" href="/assets/hint.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="shortcut icon" href="/assets/favicon.ico">
</head>
<body>

<h1>Status page</h1>

<?php

// php funtion to check if the port is open
function stest($ip, $port) {
   


  if(fsockopen("$ip",$port))
  {
  print "Port $port is openened for ssh access";
  }
  
}
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
  //if (!empty($tcpline[3])) echo "<pre>Server IP $tcpline[3]</pre>";
  if (!empty($tcpline[4])) echo "<pre>Remote IP $tcpline[4] connected</pre>";
  //Show array
  //print_r($tcpline);
}

// For loop we have written in our doc bind the renote ssh port to ports between 8222-92000

for( $i=8822; $i<=9000; $i++ )

{

//echo $i;
stest ('127.0.0.1',"$i");

echo "<br>";

 }
?> 

</body>
</html>
