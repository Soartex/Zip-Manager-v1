<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: ../index.php"); 
    exit; 
} 
if(!isset($_GET['fileName'])){
	    header("Location: ../ZipManager.php"); 
    exit; 
}?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Worker: <?php echo $_GET['fileName'] ?></title>
		<meta charset="UTF-8"/>
		<link rel="shortcut icon" href="img/favicon.ico"/>
		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
	</head>
<div class="container">
	<body>
		<div class="container">
			<!-- Title -->
			<div class="page-header">
			    <h1>
				Delete
				<small>
				<?php echo $_GET['fileName'] ?>
				</small>
				<div class="btn-group pull-right">
				    <a class="btn" href=<?php echo "../jsoneditor?url=".$_SESSION['patcherConfig'];?>>Update Config</a>
				    <a class="btn" href="../ZipManager.php">Back</a> 
			    </div>
				</h1> 
			</div>
			<?php
			//file path
			$outputFile = "../".$_SESSION['zipDirectory'].$_GET['fileName'];
			echo "File to delete: ".$outputFile."</br></br>";
			//remove old zip
			if (file_exists($outputFile)) {
				echo '<div class="alert alert-success">Success: Deleted Old Archive</div>';
				if(is_dir($outputFile)){
					rrmdir($outputFile);
				}
				else{
					unlink($outputFile);
				}
			}
			else{
				echo '<div class="alert alert-error">Error: Unable to delete file</div>';
			}
			?>
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

<?php
//remove recusivly everything in a directory
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as &$object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir . "/" . $object) == "dir")
					rrmdir($dir . "/" . $object);
				else
					unlink($dir . "/" . $object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}
?>