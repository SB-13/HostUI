<?php       
	$ip ="172.20.10.12";
	//grab pressure transducer data
	$sensorTxt = "./output.txt";
	$sensorLines = file($sensorTxt);
	$tempCel = substr($sensorLines[1], 17);
	$tempFer = substr($sensorLines [2],17);
	$mBar = substr($sensorLines[0], 17);
	$feet = (($mBar*2.089)-2116.8)/62.47;   
	$yaw = substr($sensorLines [2],17);
	$pitch = substr($sensorLines [2],17);
	$roll = substr($sensorLines [2],17);
	$coords = file_get_contents("./coords.txt");	
	echo '<table class="table">                                
		<tbody>
			<tr>
				<td>Water Temp</td>
				<td>';
				//define IP address
				echo $tempFer;
				echo ' F 
				</td>                                       
			</tr>';
												//Depth (removed 7/14) EHD
														//<tr>
														//	<td>USS Depth</td>';
														//	<td>';				
														//		echo $feet;				 
																//echo ' 0.01077 feet </td>                                       
														//echo '</tr>';
			echo '<tr>
				<td>Buoy Location</td>
				<td> ';							
				echo $coords;			 
				echo '</td>                                       
			</tr>
			<tr>
				<td>Yaw</td>
				<td>';			
					$yaw;			
				echo '</td>                                       
			</tr>
			<tr>
				<td>Pitch</td>
				<td>';				
					echo $pitch;				
				echo ' </td>                                       
			</tr>
			<tr>
				<td>Roll</td>
				<td>';			
				echo $roll;			
				echo '</td>                                      
			</tr>';
			/*<tr>
				<td>Battery Percentage</td>
				<td>55% Remaining  
				<!--Battery graphic-->
					<div class="progress" class = col-lg-6>									
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"><span class="sr-only">55% Complete (warning)</span>
						</div>
					</div>
				</td>                                       
			</tr>*/
		echo '</tbody>';
	echo '</table>';

?>