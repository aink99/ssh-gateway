<?php



function stest($ip, $port) {
   


	if(fsockopen("$ip",$port))
	{
	print "Port $port is open for ssh access";
	}
	
}


for( $i=8822; $i<=8830; $i++ )

{

//echo $i;
$connection = @fsockopen('localhost', '$i');
stest ('127.0.0.1',"$i");

echo "<br>";

 }

?>