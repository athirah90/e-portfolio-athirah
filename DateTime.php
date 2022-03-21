
<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
$CurrentTime=time();
$DateTime=strftime("%d-%m-%Y %H:%i:%s",$CurrentTime);
 //This is the SQL Format for Date and Time 
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
echo $DateTime;
?>
