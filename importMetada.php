<?php                          
	echo '<table class="table">                                
                                <tbody>
                                    <tr>
                                        <td>Water Temp</td>
                                        <td>';
									
										//grab pressure transducer data
											$sensorTxt = "./sensorOutput.txt";
											$sensorLines = file($sensorTxt);
											$tempCel = substr($sensorLines[1], 17);
											$tempFer = substr($sensorLines [2],17);
											$mBar = substr($sensorLines[0], 17);
											$feet = (($mBar*2.089)-2116.8)/62.47;
											echo $tempFer;
										echo '</td>                                       
                                    </tr>
                                    <tr>
                                        <td>USS Depth</td>
                                        <td>';
										
										echo $feet;
										 
									echo '</td>                                       
                                    </tr>
                                    <tr>
                                        <td>Buoy Location</td>
                                        <td> ';
										
										$coords = file_get_contents("./coords.txt");
										echo $coords;
									 
										echo '</td>                                       
                                    </tr>
                                    <tr>
                                        <td>Heading</td>
                                        <td>';
									
										echo file_get_contents("./heading.txt");
									
										echo '</td>                                       
                                    </tr>
                                    <tr>
                                        <td>Pitch</td>
                                        <td>';
										
										echo file_get_contents("./pitch.txt");
										
										echo '<td>                                       
                                    </tr>
                                    <tr>
                                        <td>Roll</td>
                                        <td>';
									
										echo file_get_contents("./roll.txt");
									
									echo '</td>                                      
                                    </tr>
                                    <tr>
                                        <td>Battery Percentage</td>
                                        <td>55% Remaining  
										<!--Battery graphic-->
											<div class="progress" class = col-lg-6>									
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"><span class="sr-only">55% Complete (warning)</span>
												</div>
											</div>
										</td>                                       
                                    </tr>
                                </tbody>
                            </table>';

?>