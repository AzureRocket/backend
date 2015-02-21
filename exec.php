<?php 
	
	error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);

		$target_dir = "certs/";
		$target_file = $target_dir . "azure.publishsettings";
		$url = $_POST['giturl'];
		$reponame = $_POST['repo'];
		$uploaded = false;

		if(file_put_contents($target_file, $_POST['cert'])) $uploaded = true;
		else echo "Upload Failed";
		
		$command = "wget -O zips/$reponame.zip $url";
		shell_exec($command);	
		
		if ($uploaded == true) {
			echo "Uploads and zips complete";
			$command = "azure account import $target_file";
			shell_exec($command);
		}
		
		$return['uploaded'] = $uploaded; 
		$return['json'] = json_encode($return);
		echo json_encode($return);
		
?>
		
		 