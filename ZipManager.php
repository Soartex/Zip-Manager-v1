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
		    <div class="btn-group pull-right">
			    <a class="btn" href=<?php echo "jsoneditor?url=".$_SESSION['patcherConfig'];?>>Update Config</a>
			    <a class="btn" href="">Packs</a> 
			    <a class="btn" href="OptionChoser.php">Back</a> 
		    </div>
		</div>
		<div class="alert alert-info">
		    <strong>Current Zip Manager Options</strong></br>
			<?php
			echo "[Github Username]: ".$_SESSION['gitUsername']."</br>";
			echo "[Github Repo]: ".$_SESSION['gitRepo']."</br>";
			echo "[Github Branch]: ".$_SESSION['gitBranch']."</br>";		
			echo "[Github Directory]: ".$_SESSION['gitDirectory']."</br>";
			echo "[Patcher Config]: ".$_SESSION['patcherConfig']."</br>";
			echo "[Local Zip Directory]: ".$_SESSION['zipDirectory']."</br>";
			?>
		</div>
		<hr>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>File Name</th>
				<th>Date Modified</th>
				<th>Options</th>
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
					  <td>
					  	<div class="btn-group">
							<a class="btn btn-mini btn-success" href=<?php echo "UpdateZip.php?fileName=".$temp; ?>>Update Zip</a>
							<a class="btn btn-mini btn-danger alertBox" filename=<?php echo $temp; ?> href="#"><i class="icon-trash icon-white"></i> Delete</a>
							<a class="btn btn-mini" href="<?php echo $_SESSION['zipDirectory'].$temp; ?>"><?php echo $temp; ?></a>
						</div>
					  </td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		
		<!--Form for adding a new zip-->
		<form action="" method="post">
			<div class="form-horizontal">
				<input type="text" placeholder="Filename.zip">
				<button class="btn btn-success" type="submit" name="newzip">Add Zip File</button>
			</div>
		</form>
	</div>
	
	 <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
	<script>
        $(document).on("click", ".alertBox", function(e) {
            bootbox.confirm("Do you want to delete this zip file?", function(result) {
				if(result === true){
					//redirect to a good place.
				}				
			}); 
        });
    </script>
    
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