<?php 
	class xamppModel {
		function checkX(){
			$filePath ="C:/xampp/xampp-control.ex";
			if(file_exists($filePath)){
				return TRUE;
			}else{
				FALSE;
			}
		}
		function checkXe(){
			$filePath ="../xampp-win32-7.2.0-0-VC15-installer.exe";
			if(file_exists($filePath)){
				return TRUE;
			}else{
				FALSE;
			}
		}
		function copyFiles(){
			$copy = copy('../ProjectGo', 'C:/xampp/htdocs/');
			if($copy){
				return TRUE;
			}
			return FALSE;
		}
	}
?>