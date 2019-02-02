<?php 
	include "../models/adminsModel.php";
	$LOGGED_IN = FALSE;	


	$username = isset($_REQUEST['username'])?$_REQUEST['username']:NULL;
	$password = isset($_REQUEST['password'])?$_REQUEST['password']:NULL;

	$db = new userModel();
	


	if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "LOG ME IN") {
		$result = $db->userExists($username, $password);
if ($result) {
		$LOGGED_IN = TRUE;
	} else {
		$ERROR = TRUE;
	}
}

	$db->close();
?>	