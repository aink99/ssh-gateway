<?php
// Check if pid parameter value is numeric
if(is_numeric($_GET['pid'])){
echo "You visited my URL with the following parameter: " . intval($_GET['pid']);
} else {
echo "Hey. Stop trying to hack me by sending non-number values!";
exit();
}
// htmlspecialchars, It is used to encode user input on a website so that users cannot insert harmful HTML codes into a site.
$PID= htmlspecialchars($_GET["pid"]);

//grep for pid adn sshd  and exclude if it's grep or root
$ssh_process=exec("ps |grep -w $PID|grep sshd:|egrep -v 'grep|root'");

// if we have a result then it's an sshd ran by autossh, we can kill it
if (!empty($ssh_process)) {
echo "<br>";
echo $PID;
echo "<br>";
echo "Killing $ssh_process";
$kill=exec("kill $PID");
}

?>
