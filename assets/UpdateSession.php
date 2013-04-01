<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
}
?>
<?php 
if(isset($_POST['submit'])){ 
		
	$_SESSION['gitUsername']=$_POST['gitUsername'];
	$_SESSION['gitRepo']=$_POST['gitRepo'];
	$_SESSION['gitBranch']=$_POST['gitBranch'];		
	$_SESSION['gitDirectory']=$_POST['gitDirectory'];
	$_SESSION['patcherConfig']=$_POST['patcherConfig'];
	$_SESSION['zipDirectory']="../".$_POST['zipDirectory'];
		
    header("Location: ../ZipManager.php");
}else{
    header("Location: ../index.php");     
    exit; 
} 
?>