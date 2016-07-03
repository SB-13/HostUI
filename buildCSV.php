<head>
<title>Calc Metadata</title>
</head>
<?php

$t =time();
$time = date("H:i:s",$t);

//grab pressure transducer data
$sensorTxt = "./sensorOutput.txt";
$sensorLines = file($sensorTxt);
$tempCel = substr($sensorLines[1], 17);
$tempFer = substr($sensorLines [2],17);
$mBar = substr($sensorLines[0], 17);
$feet = (($mBar*2.089)-2116.8)/62.47;

//grab lat/lon
$coordsTxt = "./coords.txt";
$coordsLines = file($coordsTxt);
echo $coordsLines[0];
$coordSplit = explode(",", $coordsLines[0]);
echo $coordSplit[0];
$lat = $coordSplit[0];
$lon = $coordSplit [1];


//Time | Temp | Depth | Lat | Lon | Heading |Pitch | Roll | Battery
$list = array(
	array($time, $tempFer, $feet, $lat, $lon)
);


$fp = fopen('metaDataInput.csv', 'a');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
?>
