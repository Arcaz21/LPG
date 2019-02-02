<?php 
		include "../models/xamppModel.php"; 

		$xM = new xamppModel();
		
		$checkX = $xM->checkX();
		$checkXe = $xM->checkXe();

		if(isset($_REQUEST['download']) && isset($_REQUEST['download']) == "1"){
				header('Location: https://www.apachefriends.org/xampp-files/5.6.32/xampp-win32-5.6.32-0-VC11-installer.exe');
		}
		if(isset($_REQUEST['install']) && $_REQUEST['install'] == "1"){
			echo "SULOD";
				if($checkXe){
					$exec = exec('"../dit.exe"|at now');
					$_SESSION['install'] = "Installation Complete Prceed to";
					//header('Location: new.php');
				}else{
					$_SESSION['install'] = "File does not exist on setup folder";
					//header('Location: new.php');	
				}		
		}
		if(isset($_REQUEST['copy']) && isset($_REQUEST['copy']) == "1"){
				$copy = $xM->copyFiles();
				$_SESSION['tab'] = "two";
				if($copy){
					
				}
		}
?>