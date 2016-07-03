<html>
 <head>
     <link href="css/bootstrap.min.css" rel="stylesheet">
  <title>SB-13 Metadata</title>
 </head>
 <body>
 <div id="wrapper">
         <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<a href="./index.php"><button type="button" class="btn btn-lg" padding:"20">Home</button></a>   
		<a href="./manual/index.php"> <button type="button" class="btn btn-lg" padding:"20">SB-13 User's Manual</button></a>
		  <button type="button" class="btn btn-lg btn-danger">ABORT MISSION</button>
        </nav>
		<div id="page-wrapper">
			 <div class="col-lg-12">
				<br/>
				<br/>
				<br/>
			      <div class="table-responsive">
                            
				<?php

					$row = 1;
					if (($handle = fopen("./metadataInput.csv", "r")) !== FALSE) {
					   
						echo '<table class="table table-bordered table-hover">';
					   
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
				</div><!-- end responsive table-->
			</div> <!--end col-->
		</div> <!--end page wrapper-->
	</div><!--end wrapper-->
</body>
</html>