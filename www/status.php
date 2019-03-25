<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tcp status page</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <!-- Bootstrap styles -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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


echo '
        <div class="card" style="width: 40rem;">
            <div class="card-header">
                <h6 class="card-title">Connection</h6>
            </div>
              <div class="card-body">
                <ul>
                  <li>Remote IP '.$ip_port[0].' is connected source port is '.$ip_port[1].'</li>
                  <li>PID is '.$pidline[5].' </li>
                  <br>
                  <a> <button type="button" class="btn btn-danger" onclick="window.open(\'/kill.php?pid='.$pidline[5].'\', \'test\', \'width=400, height=400\')"><i class="glyphicon glyphicon-remove-sign"></i> Kill ssh session</button>
                  </ul>
            </div>
        </div>
<br>

            ';









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


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
