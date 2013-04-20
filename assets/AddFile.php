<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: ../index.php"); 
    exit; 
} 
if(!isset($_POST['submit'])){
	header("Location: ../ZipManager.php");     
    exit; 
}?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>AddZip: <?php echo $_POST['newzip'] ?></title>
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
				Create
				<small>
				<?php echo $_POST['newzip'] ?>
				</small>
				<div class="btn-group pull-right">
				    <a class="btn" href=<?php echo "../jsoneditor?url=".$_SESSION['patcherConfig'];?>>Update Config</a>
				    <a class="btn" href="../ZipManager.php">Back</a> 
			    </div>
				</h1> 
			</div>
			<?php
			//file path
			$outputFile = "../".$_SESSION['zipDirectory'].$_POST['newzip'];
			echo "File to create: ".$outputFile."</br></br>";
			//remove old zip
			if (touch($outputFile)) {
			    echo '<div class="alert alert-success">Success: Created File</div>';
			} 
			else{
				echo '<div class="alert alert-error">Error: Unable to create file</div>';
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