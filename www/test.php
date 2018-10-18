<?php
//$file = 'somefile.txt';
$file = '/var/log/sshd.log';
#$searchfor = 'Accepted publickey for';
$searchfor = 'Accepted publickey for';

// the following line prevents the browser from parsing this as HTML.
header('Content-Type: text/plain');

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);
// escape special characters in the query
$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
//$pattern = "/^.*$pattern.*\$/m";
$pattern = "/^.*$pattern.*\n.*\n.*\$/m";


//execute the netstat command and grep for established tcp sessions
preg_match_all($pattern, $contents, $matches);
//print_r($);
//print_r($matches[0][1]);
//$connections = echo $matches[0];
//echo $connecions;
foreach($matches[0] as $value) {
//echo value;
//echo "Remote IP $value\n";
$pattern = "/^.*pid.*\$/m";
preg_match_all($pattern, $value, $matches);
echo implode("\n", $matches[0]);
print_r($matches[0]);
echo explode(" ", $matches[0]);
echo "===============================\n";
}


// search, and store all matching occurences in $matches
//if(preg_match_all($pattern, $contents, $matches)){
   

  // echo "Found matches:\n";
   //echo implode("\n", $matches[0]);
   //echo  $matches;


//}
//else{
  // echo "No matches found";
//}


//echo $pattern;
//preg_match('/Accepted\n(.*?)DATA ASSUNZIONE DATA/s', $file, $match2);
//preg_match('/^.*Accepted publickey for.*$/m', $contents, $match2);
//preg_match('/^.*Accepted publickey for.*$/m', $contents, $match2);

//echO $match2[0];
//echo implode("\n", $matche2[0]);

?>
