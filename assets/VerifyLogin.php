<?php 
if(isset($_POST['submit'])){ 
	//if pas and username match start the session
    if($_POST['username']=='username' && $_POST['password']=='password'){ 
        session_start(); 
		$_SESSION['logged'] = TRUE; 
		$_SESSION['username'] = $_POST['username']; 
		$_SESSION['profile'] = $_POST['profile'];

		
        header("Location: ../OptionChoser.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: ../index.php"); 
        exit; 
    } 
}else{
    header("Location: ../index.php");     
    exit; 
} 
?>