<?php
//check user login
session_start(); 
if(!$_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
} 
if(!isset($_GET['fileName'])){
	    header("Location: ZipManager.php"); 
    exit; 
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Updater: <?php echo $_GET['fileName'] ?></title>
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
			Zip Updater
			<small>
			<?php echo $_GET['fileName'] ?>
			</small>
			<div class="btn-group pull-right">
			    <a class="btn" href=<?php echo "jsoneditor?url=".$_SESSION['patcherConfig'];?>>Update Config</a>
			    <a class="btn" href="ZipManager.php">Back</a> 
		    </div>
			</h1> 
		</div>
		<?php 
		//master try catch
		try{
			//create temp location
			echo "<h3>Creating Temp Folder</h3></br>";
			$fileNoExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_GET['fileName']);	
			
			$maintempDirectory =$_SESSION['zipDirectory']."temp";
			$tempDirectory = $maintempDirectory."/".$fileNoExt;
			echo("Temp Directory: ".$tempDirectory."<br>");
			
			if (file_exists($tempDirectory)){
				rrmdir($tempDirectory);	
				mkdir($tempDirectory, 0777,TRUE);
				echo '<div class="alert alert-success">Success: Created Directory</div>';
			}else{
				mkdir($tempDirectory, 0777,TRUE);
				echo '<div class="alert alert-success">Success: Created Directory</div>';
			}
	
			//download github files
			echo "<h3>Downloading Files From Github</h3></br>";
			$apiUrl='https://api.github.com/repos/' . $_SESSION['gitUsername'] . '/' . $_SESSION['gitRepo'] . '/git/trees/'.$_SESSION['gitBranch'].'?recursive=1';
			echo "</br>Main API Tree: ".$apiUrl;
			//get data
			//$contents = file_get_contents($apiUrl);
			//$contentD = utf8_encode($contents);
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $apiUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
			
			//curl_setopt($curl, CONNECTTIMEOUT, 1);
			$content = curl_exec($curl);
			curl_close($curl);

			$githubRead = json_decode($content, true);
			
			//if no github data skip everything.
			if($githubRead===null){
				throw new Exception('Unable to get JSON data from github.'); 
			}
			echo '<div class="alert alert-success">Success: Downloaded Content Data From Github </div>';
			?>
			
			<a id="show_id" onclick="document.getElementById('spoiler_id').style.display=''; document.getElementById('show_id').style.display='none';" class="btn">Raw Data</a>
			<span id="spoiler_id" style="display: none"><a onclick="document.getElementById('spoiler_id').style.display='none'; document.getElementById('show_id').style.display='';" class="btn">Close</a> </br> 
				<?php print_r($githubRead);	?>
			</span>
			</br>
			</br>
			
			<?php
			//if github data is default stop everything
			if($githubRead["message"]!==null){
				throw new Exception('Unable to get CONTENT data from github.'); 
			}
			//seperate all files that have the correct path
			foreach($githubRead["tree"] as &$file) {
				if (strpos($file['path'],$_SESSION['gitDirectory'].$fileNoExt) !== false && $file['type']!="tree") {
					$filesToDownload[]=$file;
				}
				else if(strpos($file['path'],$_SESSION['gitDirectory'].$fileNoExt) !== false && $file['type']==="tree"){
					$pathsToMake[]=$file;
				}
			}
			//if no mod data then don't continue
			if($filesToDownload===null){
				throw new Exception('Could not find MOD data in github data.');
			}
			
			echo '<div class="alert alert-success">Success: Seperated Mod Data from Github Data</div>';
			?>
			
			<a id="show_id2" onclick="document.getElementById('spoiler_id2').style.display=''; document.getElementById('show_id2').style.display='none';" class="btn">Mod Data</a>
			<span id="spoiler_id2" style="display: none"><a onclick="document.getElementById('spoiler_id2').style.display='none'; document.getElementById('show_id2').style.display='';" class="btn">Close</a> </br> 
			
			<?php
			//print files to be downloaded
			foreach($filesToDownload as &$file) {
				echo "</br>";
				print_r($file);
				echo "</br>";
			}
			?>
			</span>
			</br>
			</br>
			
			<?php
			//create folders
			foreach ($pathsToMake as &$path) {
                                //try to create dir.
				try {
                                //change to zipdestination
                                mkdir($maintempDirectory."/".$path["path"], 0777,TRUE);
                                } 
                                //if it all ready exist do nothing.
                                catch (Exception $e2) {}			
			}
	
			//downlaod the files
			$downloadUrl = 'https://raw.github.com/' . $_SESSION['gitUsername'] . '/' . $_SESSION['gitRepo'] . '/' .$_SESSION['gitBranch'] . '/';
			foreach ($filesToDownload as &$file) {
			//download /dir/image.png to /newdir/image2.png
			if (copy($downloadUrl.$file['path'], $maintempDirectory."/".$file['path']))
				$success[] = "Success: ".$file['path']."</br>";
			else
				$error[] = 'Error: Unable to download- '. $file['path']."</br>";
			}
			
			//if there were files uploaded display them		
			if($success!==null){
				echo '<div class="alert alert-success">Success: Able to Upload Files</div>';
				?>
				<a id="show_id3" onclick="document.getElementById('spoiler_id3').style.display=''; document.getElementById('show_id3').style.display='none';" class="btn">Successful Uploads</a>
				<span id="spoiler_id3" style="display: none"><a onclick="document.getElementById('spoiler_id3').style.display='none'; document.getElementById('show_id3').style.display='';" class="btn">Close</a> </br> 
				<?php
				foreach($success as &$file) {
					echo($file);
				}
				?>
				</span>
				</br>
				<?php
			}
			//if there was an error display it
			if($error!==null){
				echo '<div class="alert alert-error">Error: Unable to Upload Some Files.</br></br>';
				foreach($error as &$file) {
					echo($file);
				}
				echo "</div>";
			}
	
			//remove old zip and zip new files
			echo "<h3>Creating Zip Archives</h3></br>";
	
			$outputFile = $_SESSION['zipDirectory'].$_GET['fileName'];
			echo("Output File: ".$outputFile."<br>");
	
			$outputDir = $_SESSION['zipDirectory'];
			echo("Output Directory: ".$outputDir."<br>");
	
			$zipFolder = $maintempDirectory."/".$fileNoExt."/";
			echo("Ziping the folder: ".$zipFolder);
	
			if (!file_exists($outputDir)){
				mkdir($outputDir, 0777,TRUE);
				echo '<div class="alert alert-success">Success: Created Directory</div>';
			}
	
			//remove old zip
			if (file_exists($outputFile)) {
				echo '<div class="alert alert-success">Success: Deleted Old Archive</div>';
				unlink($outputFile);
			}
			//get the file zipper
			include_once('assets/Zip_Archiver.php');
			if (Zip_Archiver::Zip($zipFolder, $outputFile)) {
				echo '<div class="alert alert-success">Success: Outputted File</div>';
			}
			else{
				throw new Exception('Unable to outputted file.');
			}
			
			//remove temp files/folder
			rrmdir($maintempDirectory);
			echo '<div class="alert alert-success">Success: Removed Temp Directory</div>';
		}//try catch
		catch(Exception $e){
			//show error
			echo '<div class="alert alert-error">Error: '.$e->getMessage().' Exiting program.</div>';
			//delete temp file
			rrmdir($maintempDirectory);
			echo '<div class="alert alert-success">Success: Removed Temp Directory</div>';
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
