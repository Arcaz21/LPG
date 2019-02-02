
<?php

include "../models/adminsModel.php"; 
	$username = isset ($_REQUEST['username']) ? $_REQUEST['username']:NULL;
	$id = isset ($_REQUEST['id']) ? $_REQUEST['id']:NULL;
	$adminsModel = new adminsModel();
    $userModel = new userModel();
//----------------------------------View all user in a table

        if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "SUBMIT NEW USER"){
            unset($_SESSION['failed']);
            unset($_SESSION['success']);
            unset($_SESSION['delete']);
            unset($_SESSION['update']);
            $newU['username']= isset($_REQUEST['username'])?$_REQUEST['username']:NULL;
            $newU['password']= isset($_REQUEST['password'])?$_REQUEST['password']:NULL;
            $newU['fName']= isset($_REQUEST['fName'])?$_REQUEST['fName']:NULL;
            $newU['lName']= isset($_REQUEST['lName'])?$_REQUEST['lName']:NULL;
            $newU['role']= isset($_REQUEST['role'])?$_REQUEST['role']:NULL;
            $check = $userModel->userExists($newU['username'], $newU['password']);
            if($check){
                $_SESSION['failed'] = "USERNAME exist";
            }else{
                $result = $adminsModel->addnewUser($newU);
                if($result){
                $_SESSION['success'] = "User Successfully Added. Add another? ► ";
                //print_r($_SESSION['success']);
                //echo "<meta http-equiv='refresh' content='0'>";
                }else{ echo "error adding member";}
            }
            
        }
        if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "YES PLEASE"){
            unset($_SESSION['failed']);
            unset($_SESSION['success']);
            unset($_SESSION['delete']);
            unset($_SESSION['update']);
            $usern['id']= isset($_REQUEST['id'])?$_REQUEST['id']:NULL;
            $result = $adminsModel->deleteU($usern);
            if($result){
                $_SESSION['delete'] = "Member Successfully Removed. ";
                //print_r($_SESSION['delete']);
                //echo "<meta http-equiv='refresh' content='0'>";
                }else{ echo "error adding member";}
        }
        if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "EDIT USER"){
            unset($_SESSION['failed']);
            unset($_SESSION['success']);
            unset($_SESSION['delete']);
            unset($_SESSION['update']);
            $editU['username']= isset($_REQUEST['username'])?$_REQUEST['username']:NULL;
            $editU['password']= isset($_REQUEST['password'])?$_REQUEST['password']:NULL;
            $editU['fname']= isset($_REQUEST['fname'])?$_REQUEST['fname']:NULL;
            $editU['lname']= isset($_REQUEST['lname'])?$_REQUEST['lname']:NULL;
            $editU['role']= isset($_REQUEST['role'])?$_REQUEST['role']:NULL;
            $editU['id']= isset($_REQUEST['id'])?$_REQUEST['id']:NULL;

            $result = $db->updateUser($editU);
            if($result){
               // echo "<meta http-equiv='refresh' content='0'>";
            }else{ echo "wrong";}
        }
        if(isset($_GET['value'])){
            unset($_SESSION['failed']);
            unset($_SESSION['success']);
            unset($_SESSION['delete']);
            unset($_SESSION['update']);
            $uID = isset ($_REQUEST['value'])?$_REQUEST['value']:NUll;
            $getuser = $userModel ->getUser($uID);
            if($getuser){
            //echo "member info retrived";
            }else{ echo "error getting member";}  
        }
	   $rows = $adminsModel->selectAll();
       //$showMembers = $adminsModel->showMembers();
?>