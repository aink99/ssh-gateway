<?php

$connection = @fsockopen('localhost', '8822');

if (is_resource($connection))
{
    echo 'Open!';
    fclose($connection);
    return true;
}
else
{
    echo 'Closed / not responding. :(';
    return false;
}

?>