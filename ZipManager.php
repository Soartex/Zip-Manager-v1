<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
} 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Zip Manager</title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="assets/img/favicon.ico"/>
		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.min.css" />
	</head>
<div class="container">
	<body>
	<div class="container">
		<!-- Title -->
		<div class="page-header">
		    <h1>
		    Zip Archives Manger
		    <small>Currently in Development</small>
		    <a class="btn pull-right" href="OptionChoser.php">Back</a> 
		</div>
		<div class="alert alert-info">
		    <strong>Current Zip Manager Options</strong></br>
			<?php
			echo "[Github Username]: ".$_SESSION['gitUsername']."</br>";
			echo "[Github Repo]: ".$_SESSION['gitRepo']."</br>";
			echo "[Github Branch]: ".$_SESSION['gitBranch']."</br>";		
			echo "[Github Directory]: ".$_SESSION['gitDirectory']."</br>";
			echo "[Local Zip Directory]: ".$_SESSION['zipDirectory']."</br>";
			?>
		</div>
		<hr>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>File Name</th>
				<th>Date Modified</th>
				<th>Download</th>
				<th>Update</th>
			</tr>
			</thead>
			<tbody>
				<?php
				//file names data
				$filesData = array();
				if ($dir_list = opendir($_SESSION['zipDirectory'])){
					while(($filename = readdir($dir_list)) !== false){
						//add file name
						if (substr($filename, 0, 1) !== '.'){
							$filesData[]=$filename;
						}
					}
				}
	
				//sort the names
				sort($filesData);
				//display in the table
				foreach($filesData as &$temp) {
				?>
					<tr>
					  <td><?php echo $temp; ?></td>
					  <td><?php echo date("m-d-Y H:i:s", filemtime($_SESSION['zipDirectory'].$temp)); ?></td>
					  <td><a class="btn btn-mini" href="<?php echo $_SESSION['zipDirectory'].$temp; ?>"><?php echo $temp; ?></a></td>
					  <td>
						<a class="btn btn-mini" href=<?php echo "UpdateZip.php?fileName=".$temp; ?>>Update Zip</a>
					  </td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	</body>
	<footer>
		</br>
		<hr>
		<ul class="nav nav-pills">
	        <li class="pull-left"><a href="">&copy; Soartex 2013-2014 (Made for the Soartex Team by Patrick Geneva)</a></li>
	    </ul>
	</footer>
</div>
</html>