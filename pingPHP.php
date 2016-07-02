
<?php
	$host = $_POST['ip'];
	if (!$socket = @fsockopen($host,2121))
		echo 0;
	else
		echo 1;
?>