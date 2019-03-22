<?php

//$command = 'kill '
  //
    //    if ($this->status() == false)return true;
      //  else return false;
      $PID= htmlspecialchars($_GET["pid"]);
      //echo 'Killing pid ' . htmlspecialchars($_GET["pid"]) . '!';
      echo "$PID";
      $who= exec("whoami");
      echo $who;
      //$kill=posix_kill($PID, SIGTERM);
      $kill=exec("kill $PID");
  
?>
