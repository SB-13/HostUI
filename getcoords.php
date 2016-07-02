	<php>
	$rpi_host = $_POST['ip'];
	$port = ":2121";
	
	//$url = $rpi_host.$port.'/coords.txt';
	$url = '/coords.txt';
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	//return preg_replace("/\r|\n/", "", $data);
	echo preg_replace("/\r|\n/", "", $data);
?>