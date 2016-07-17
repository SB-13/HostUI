<html>
 <head>
 	    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sb-admin.css" rel="stylesheet">
	<style>

			 #video-container {
			   text-align: center;
			   height: 800px;//or whatever you want
			   line-height:800px;//should be equal to the height
			   position: relative;
				left: 100px;
				top: 150px;
			   z-index: 1;
			}

			#custom-message {
				position: absolute; // Reposition logo from the natural layout
				top: 0px;
				width: 500px;
				height: 80px;
				z-index: 2;				
				left: 400px;
				top: 120px;
				color: white; 					
			}
			<!--background-color: rgba(0,0,102,0.8)-->
		</style>
	</head>
 </head>
 <body>

    <div id="wrapper">

<!-- Navigation -->
        <nav class="navbar nav navbar-inverse navbar-fixed-top top-nav" role="navigation">
			<li padding:"20"><a href="./index.php">Home</a> 
			<li padding:"20"><a href="./metadata.php">Mission Metadata</a>   
			<li padding:"20"><a href="./objectsOfInterest.php">Points of Interest</a></li>
			<li padding:"20"><a href="./manual/index.php">SB-13 User's Manual</a></li>
		<!--	 <button type="button" class="btn btn-lg btn-danger">ABORT MISSION</button>-->
        </nav>
 <?php
 	$coords = file_get_contents("./coords.txt");	
	$sensorLines = file($sensorTxt);
	$yaw = substr($sensorLines [2],17);
	$pitch = substr($sensorLines [2],17);
	$roll = substr($sensorLines [2],17);
	?>
<div id="video-container">
<iframe width="600" height="500" src="http://172.20.10.12" frameborder="0" allowfullscreen></iframe> 
<div id="custom-message">
	<?php
		echo $coords;
		echo $roll;
	?>
</div>
</div>
	
	</div>
	</body>
</html>