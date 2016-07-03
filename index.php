<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB-13 Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"/>
		<style>
			#map {
				margin-left: auto;
				margin-right: auto;
				width: 900px;
				height: 500px;
				float: right;
			}
			
			input[type="button"] {
				border: 1px solid #b5c1d5;
				background-color: #94aecf;
				color: white;
				height: 28px;
				border-radius: 3px;
				width: 100px;
			}
		</style>
		<script src="https://code.jquery.com/jquery-2.1.1.js"></script>

</head>

<body>

    <div id="wrapper">

<!-- Navigation -->
        <nav class="navbar nav navbar-inverse navbar-fixed-top top-nav" role="navigation">
			<li padding:"20"><a href="./index.php">Home</a> 
			<li padding:"20"><a href="./metadata.php">Mission Metadata</a>   
			<li padding:"20"><a href="./objectsOfInterest.php">Points of Interest</a></li>
			<li padding:"20"><a href="./manual/index.php">SB-13 User's Manual</a></li>
			 <button type="button" class="btn btn-lg btn-danger">ABORT MISSION</button>
        </nav>
<!-- End Navigation-->
        <div id="page-wrapper">
            <div class="container-fluid">            
                    <div class="col-lg-6">   
					
<!--Pi video stream-->

      <input id="toggle_display" type="button" class="btn btn-primary" value="Simple" style="position:absolute;top:60px;right:10px;" onclick="set_display(this.value);">
      <div class="container-fluid text-center liveimage">
         <div><img id="mjpeg_dest"   onclick="toggle_fullscreen(this);" src="./loading.jpg"></div>
      </div>
<!-- End Pi Video Stream-->
<!--GPS Map-->

		<div id="map"></div>
		<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
		<script>		
			var map = L.map('map').setView([38.8029693,-77.5178039], 18);
			mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
			L.tileLayer ('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '© ' + mapLink + ' Contributors',
				maxZoom: 18,
			}).addTo(map);
			var ongoing = 1;
			$(document).ready(function() {
				$('#startTrack').click(function() {
					if (ongoing == 1) {
						startTrackingRPI();
						ongoing = 0;
						/*$(this).css('background-color','#d79d9c');
						$(this).attr('value','Stop');*/
					}
					/*
					else {
						ongoing = 1;
						$(this).css('background-color','#94aecf');
						$(this).attr('value','Track');
					}*/
				});
				
				function startTrackingRPI() {
					var oldlon = 0.00;	//define old coords
					var oldlat = 0.00;	//define old coords
					//get status from robot
					//get IP Address
					var ip = $('#ip').val();
					// red offline - green online
					function getStatus() {
						//new image
						if (!ip.length == 0) {
							//alert (ip);
							var online = 'images/online.png';
							var offline = 'images/offline.png';
							//generate url
							$.post ('pingPHP.php',{ip:ip},processaDados);
							function processaDados (data) {
								//alert ('data ' + data);
								if (data == 1)
									$('#status').attr('src',online);
								else 
									$('#status').attr('src',offline);
							}
						}
					}
					// verify every 3 seconds
					setInterval(getStatus,3000);
 
					//Place Marker
					function getCoords() {
						$.post('getcoords.php',{ip:ip},processCoords);
						function processCoords(data) {
							$('#coordstoput').val(data);
							//TODO: Check for valid data
							//TODO: Check if there is not connectivity , do not try to insert marker
							var coords = data.split(",");
							//check if they are the same ones that we already have
							//so we don't place markers on the same location
							if ((coords[0] != oldlon) && (coords[1] != oldlat)) {
								//if they are different , insert marker
								// insert a new marker
								var marker = L.marker([coords[0],coords[1]]).addTo(map);
								//attribute these old coordinates
								oldlon = coords[0];
								oldlat = coords[1];
							}
						}
					}
					// 4s 4s checks in coordinates - reduce to increase map detail
					setInterval(getCoords,4000);
					var newCoord = getCoords();
					
					//Marker
					//var marker = L.marker([28.51155, -81.153878333]).addTo(map);
				};
			});
		</script>
		<!-- <textarea id="coordstoput" rows="2" cols="30"></textarea> -->
		<img src="images/offline.png" id="status" style="vertical-align:middle;"> <input type="text" size="15" maxlenghth="15" placeholder="Rasp Pi IP Address" name="ip" id="ip">
		<input type="button" value="Track" id="startTrack">

<!-- End GPS Map -->
				
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-grey">
                            <div class="panel-heading">
                                <div class="row">
									<h3 class = "panel-title"> <i class="fa fa-long-arrow-right"></i>  Telemetry Data</h3>
                                </div>
                            </div>      
                        <div id = "result" class="table"></div>     							
						<script
											src="https://code.jquery.com/jquery-3.0.0.slim.js"
											integrity="sha256-Gp6hp0H+A7axg1tErCucWeOc38irtkVWpUbBZSj8KCg="
											crossorigin="anonymous">
										</script>
										<script>
										function autoRefresh_div(){
											  $("#result").load("importMetada.php");// a function which will load data from other file after x seconds
										  }
 
										setInterval('autoRefresh_div()', 5000); // refresh div after 5 secs
										</script>
    					

									

                            <a href="metadata.php">
                                <div class="panel-footer">
                                    <span class="btn btn-lg btn-primary">View Full Mission Metadata</span>
                                </div>
                            </a>
                        </div>
 <!-- Found Objects Section-->     
	<!-- Trigger Object Found --> 
					<button type="button" class="btn btn-lg btn-primary" padding:"20">Mark Point of Interest</button>
	<!-- Display # objects found -->					
						<div class="table-responsive" class col-lg-6>
							<table class="table table-hover">                                
								<tbody>
									<tr>
										<td>Objects Found</td>
										<td>4</td>                                       
									</tr>
								</tbody>
							</table>						
						</div>
	<!-- Display location of objects found
		Time | Depth | Lat | Lon  -->
						<?php
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
					
					</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
