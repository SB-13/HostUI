<?php

//Calculate Data
$t =time();
$time = date("H:i:s",$t);

//grab pressure transducer data
$sensorTxt = "./sensorOutput.txt";
$sensorLines = file($sensorTxt);
$mBar = substr($sensorLines[0], 17);
$feet = (($mBar*2.089)-2116.8)/62.47;

//grab lat/lon
$coordsTxt = "./coords.txt";
$coordsLines = file($coordsTxt);
$coordSplit = explode(",", $coordsLines[0]);
$lat = $coordSplit[0];
$lon = $coordSplit [1];

//Write out to Target/Interest CSV
//Target# |Time | Depth | Lat | Lon |


	$targetList = array(
		array($time, $feet, $lat, $lon)
	);


	$tfp = fopen('targetList.csv', 'a');

	foreach ($targetList as $targetFields) {
		fputcsv($tfp, $targetFields);
	}

	fclose($tfp);

	
	
	//Display Table of objects
	$row = 1;
	if (($handle = fopen("./targetList.csv", "r")) !== FALSE) {
	   
		echo '<table class="table table-hover">';
	   
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			if ($row == 1) {
				echo '<thead><tr>';
			}else{
				echo '<tr>';
			}
		   
			for ($c=0; $c < $num; $c++) {
				//echo $data[$c] . "<br />\n";
				if(empty($data[$c])) {
				   $value = "&nbsp;";
				}else{
				   $value = $data[$c];
				}
				if ($row == 1) {
					echo '<th>'.$value.'</th>';
				}else{
					echo '<td>'.$value.'</td>';
				}
			}
			
			if ($row == 1) {
				echo '</tr></thead><tbody>';
			}else{
				echo '</tr>';
			}
			$row++;
		}	
		
		echo '</tbody></table>';
		fclose($handle);
	}
?>