<html>
 <head>
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
	
  <title>SB-13 Metadata</title>
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
			 <div class="col-lg-12">
				<br/>
				<br/>
				<br/>
			      <div class="table">
                            
				<?php

					$row = 1;
					if (($handle = fopen("./targetList.csv", "r")) !== FALSE) {
					   
						echo '<table class="table table-bordered table">';
					   
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
				</div><!-- end  table-->
			</div> <!--end col-->
		</div> <!--end page wrapper-->
	</div><!--end wrapper-->
</body>
</html>