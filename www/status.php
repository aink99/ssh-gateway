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
    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <!-- Generic page styles -->
     <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->

</head>
<body>

<h1>Status page</h1>



<?php

//Variables
$file = '/var/log/sshd.log';
#$searchfor = 'Accepted publickey for';
$searchfor = 'Accepted publickey for';
// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);
// escape special characters in the query
$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
//$pattern = "/^.*$pattern.*\$/m";
$pattern = "/^.*$pattern.*\n.*\n.*\$/m";


// php funtion to check if the port is open
function stest($ip, $port) {



  if(fsockopen("$ip",$port))
  {
  print "Port $port is openened for ssh access";
  }

}



FUNCTION hello(){
 echo "Call php function on onclick event.";
 $output = shell_exec('whoami');
 echo "$output";
 }

//



echo "Established TCP sessions";

//echo '<div class="header1">Hello</div>';



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
  if (!empty($tcpline[4])) {
    //echo "<pre>Remote IP $tcpline[4] connected</pre>";

   // Split ip and port delimited by :
    $ip_port = explode (":", $tcpline[4]);
     echo "<pre>Remote IP $ip_port[0] is connected source port is $ip_port[1]</pre>";

     //Search for port number within the sshd.log
     $pattern = "/^.*port $ip_port[1] ssh2.*\n.*\n.*\$/m";
     preg_match_all($pattern, $contents, $matches);


     // Put the result of matches into the line variable
     $line = implode("\n", $matches[0]);

     //Search for the  keword PID in the line variable
     $pattern = "/^.*pid.*\$/m";
     preg_match_all($pattern, $line, $matches);

     // Put result in tis variable
     $PID = implode("\n", $matches[0]);
     //echo $PID;
     //create an array splite by space
     $pidline = preg_split("/[\s,]+/", $PID);


     //echo $pidline[5];
     echo "<pre>PID is $pidline[5] </pre>";
    //echo '<input type="button"  value="Kill ssh session" onclick="msg()">';



    //echo '<a <button class="btn info" onclick="echoHello()"><code> Kill ssh session <code></button></a> ';

     if (isset($_POST)) {
    // PHP function you want to call
   $results = shell_exec("whoami");
      echo "<pre>".$results . "</pre>";

}

// Kill button '.$variable.' is needed to call th php variable inside single quotes
echo '<a> <button type="button" class="btn btn-danger" onclick="window.open(\'/kill.php?pid='.$pidline[5].'\', \'test\', \'width=400, height=400\')"><i class="glyphicon glyphicon-remove-sign"></i> Kill ssh session</button>';





echo '</span></a>';
      //echo 'do php stuff';
      //$results =
      //shell_exec("kill $pidline[5]");
      //$results = shell_exec("whoami");
      //echo "<pre>".$results . "</pre>";





  }
  //Show array
  //print_r($tcpline);
}

// For loop we have written in our doc bind the remote ssh port to ports between 8222-92000

for( $i=8822; $i<=9000; $i++ )

{

//echo $i;
stest ('127.0.0.1',"$i");

echo "<br>";

 }
?>


<script type="text/javascript" language="javascript">
function OpenWindow() {
window.open("/kill.php", 'test', 'width=400, height=400');

}
</script>




</body>
</html>
