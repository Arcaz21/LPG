
<?php

include "../models/membersModel.php"; 
    $username = isset ($_REQUEST['username']) ? $_REQUEST['username']:NULL;
    $id = isset ($_REQUEST['id']) ? $_REQUEST['id']:NULL;
    $userModel = new usersModel();
//----------------------------------View all user in a table
    
        $rows = $userModel->selectAll();
    
    



$membersModel = new membersModel();

    if(isset($_REQUEST['submit']) && isset($_REQUEST['submit']) == "YES"){

        $mem['idNum'] = isset ($_REQUEST['mID'])?$_REQUEST['mID']:NUll;
        $mem['fName'] = isset ($_REQUEST['fName'])?$_REQUEST['fName']:NUll;
        $mem['lName'] = isset ($_REQUEST['lName'])?$_REQUEST['lName']:NUll;
        print_r($mem['idNum']);
        $mID = $mem['idNum'];
        $name = $mem['fName']." ".$mem['lName']." with the ID NUMBER of ".$mem['idNum'];        
        $deleteMember = $membersModel->deleteMember($mID);
        if($deleteMember){
            $_SESSION['delete'] = $name." has been successfully REMOVED";
            //echo "<meta http-equiv='refresh' content='0'>";
        }else{ $_SESSION['delete'] ="User does not exist or has been removed";}
    }
    if(isset($_REQUEST['add']) && isset($_REQUEST['add']) == "SUBMIT NEW MEMBER"){

        $mem['idNum'] = isset ($_REQUEST['idNum'])?$_REQUEST['idNum']:NUll;
        $mem['fName'] = isset ($_REQUEST['fName'])?$_REQUEST['fName']:NUll;
        $mem['mName'] = isset ($_REQUEST['mName'])?$_REQUEST['mName']:NUll;
        $mem['lName'] = isset ($_REQUEST['lName'])?$_REQUEST['lName']:NUll;
        $mem['suffix'] = isset ($_REQUEST['suffix'])?$_REQUEST['suffix']:NUll;
        $mem['address'] = isset ($_REQUEST['address'])?$_REQUEST['address']:NUll;
        $mem['cNum'] = isset ($_REQUEST['cNum'])?$_REQUEST['cNum']:NUll;
        $mem['bday'] = isset ($_REQUEST['bday'])?$_REQUEST['bday']:NUll;
        $mem['sex'] = isset ($_REQUEST['sex'])?$_REQUEST['sex']:NUll;
        $mem['d'] = isset ($_REQUEST['diocese'])?$_REQUEST['diocese']:NUll;
        $mem['p'] = isset ($_REQUEST['parish'])?$_REQUEST['parish']:NUll;
        $mem['g'] = isset ($_REQUEST['gkk'])?$_REQUEST['gkk']:NUll;
        $mem['size'] = isset ($_REQUEST['size'])?$_REQUEST['size']:NUll;
        $mem['lay'] = isset ($_REQUEST['laybatch'])?$_REQUEST['laybatch']:NUll;
        $mem['train'] = isset ($_REQUEST['trainbatch'])?$_REQUEST['trainbatch']:NUll;
        $mem['gName'] = isset ($_REQUEST['guardName'])?$_REQUEST['guardName']:NUll;
        $mem['gAdd'] = isset ($_REQUEST['gaddress'])?$_REQUEST['gaddress']:NUll;
        $mem['gCnum'] = isset ($_REQUEST['gcNum'])?$_REQUEST['gcNum']:NUll;
        $mem['rel'] = isset ($_REQUEST['rel'])?$_REQUEST['rel']:NUll;
        
        $age = $membersModel->generateAge($mem);
        $mem['age'] = $age;

        
        $checkID = $membersModel->checkID($mem);

        $checkG = $membersModel->checkG($mem);

        if($checkG){
            echo "SULOD GKK";
                        // GET gID AND ADD member with gID
            $getGkk = $membersModel->getGkk($mem);
            $mem['gID'] = $getGkk->g_ID;
            //GUARDIAN CHECK
                    $checkGuardian = $membersModel->checkGuardian($mem);
                    if($checkGuardian){
                        $gID = $membersModel->getGuardianID($mem);
                        //print_r($gID->guardID);
                        $mem['guardID'] = $gID->guardID;
                            if($checkID){
                                $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                            }else{
                                $addMember = $membersModel->addMembers($mem);
                                if($addMember){
                                $_SESSION['success'] = "Member Successfully Added. Add another? ► ";
                                print_r($_SESSION['success']);
                                //echo "<meta http-equiv='refresh' content='0'>";
                                }else{ echo "error adding member";}
                            }
                    }else{
                        $addGuardian = $membersModel->addGuardian($mem);
                        $gID = $membersModel->getGuardianID($mem);
                        $mem['guardID'] = $gID->guardID;
                        $addMember = $membersModel->addMembers($mem);
                        if($addGuardian && $gID && $addMember){
                       //echo "<meta http-equiv='refresh' content='0'>";
                        }else{ echo "error adding member";}
                    }
            //END OF GUARDIAN CHECK
        }else{
            $checkP = $membersModel->checkP($mem);
            if($checkP){
                echo "SULOD PARISH";
                // GET parID - add gkk with parID - add member with gID
                $getPar = $membersModel->getParish($mem);
                $mem['p_ID'] = $getPar->par_ID;
                $addGkk = $membersModel->addGkk($mem);
                $getGkk = $membersModel->getGkk($mem);
                $mem['g_ID'] = $getGkk->g_ID;
                //GUARDIAN CHECK
                    $checkGuardian = $membersModel->checkGuardian($mem);
                    if($checkGuardian){
                        $gID = $membersModel->getGuardianID($mem);
                        //print_r($gID->guardID);
                        $mem['guardID'] = $gID->guardID;
                            if($checkID){
                                $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                            }else{
                                $addMember = $membersModel->addMembers($mem);
                                if($addMember){
                                $_SESSION['success'] = "Member Successfully Added. Add another? ► ";
                                print_r($_SESSION['success']);
                                //echo "<meta http-equiv='refresh' content='0'>";
                                }else{ echo "error adding member";}
                            }
                    }else{
                        $addGuardian = $membersModel->addGuardian($mem);
                        $gID = $membersModel->getGuardianID($mem);
                        $mem['guardID'] = $gID->guardID;
                        $addMember = $membersModel->addMembers($mem);
                        if($addGuardian && $addMember){
                        //echo "<meta http-equiv='refresh' content='0'>";
                        }else{ echo "error adding member";}
                    }
                //END OF GUARDIAN CHECK
            }else{
                $checkD = $membersModel->checkD($mem);
                if($checkD){
                    echo "SULOD DIOCESE";
                    //GET dID - add parID with dID - add gkk with parID - add member with gID
                    $getDiocese = $membersModel->getDiocese($mem);
                    $mem['dID'] = $getDiocese->dID;
                    $addParish = $membersModel->addParish($mem);
                    $getPar = $membersModel->getParish($mem);
                    $mem['p_ID'] = $getPar->p_ID;
                    $addGkk = $membersModel->addGkk($mem);
                    $getGkk = $membersModel->getGkk($mem);
                    $mem['g_ID'] = $getGkk->g_ID;
                    //GUARDIAN CHECK
                        $checkGuardian = $membersModel->checkGuardian($mem);
                        if($checkGuardian){
                            $gID = $membersModel->getGuardianID($mem);
                            //print_r($gID->guardID);
                            $mem['guardID'] = $gID->guardID;
                                if($checkID){
                                    $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                                }else{
                                    $addMember = $membersModel->addMembers($mem);
                                    if($addMember){
                                    $_SESSION['success'] = "Member Successfully Added. Add another? ► ";
                                    print_r($_SESSION['success']);
                                    //echo "<meta http-equiv='refresh' content='0'>";
                                    }else{ echo "error adding member";}
                                }
                        }else{
                            $addGuardian = $membersModel->addGuardian($mem);
                            $gID = $membersModel->getGuardianID($mem);
                            $mem['guardID'] = $gID->guardID;
                            $addMember = $membersModel->addMembers($mem);
                            if($addGuardian && $addMember){
                            //echo "<meta http-equiv='refresh' content='0'>";
                            }else{ echo "error adding member";}
                        }
                    //END OF GUARDIAN CHECK
                }else{
                    //Add new diocese - add parID with dID - add gkk with parID - add member with gID
                    $addDiocese = $membersModel->addDiocese($mem);
                    $getDiocese = $membersModel->getDiocese($mem);
                    $mem['dID'] = $getDiocese->dID;
                    $addParish = $membersModel->addParish($mem);
                    $getPar = $membersModel->getParish($mem);
                    $mem['p_ID'] = $getPar->par_ID;
                    $addGkk = $membersModel->addGkk($mem);
                    $getGkk = $membersModel->getGkk($mem);
                    $mem['g_ID'] = $getGkk->g_ID;
                    //GUARDIAN CHECK
                        $checkGuardian = $membersModel->checkGuardian($mem);
                        if($checkGuardian){
                            $gID = $membersModel->getGuardianID($mem);
                            //print_r($gID->guardID);
                            $mem['guardID'] = $gID->guardID;
                                if($checkID){
                                    $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                                }else{
                                    $addMember = $membersModel->addMembers($mem);
                                    if($gID && $dID && $addMember){
                                    $_SESSION['success'] = "Member Successfully Added. Add another? ► ";
                                    print_r($_SESSION['success']);
                                    //echo "<meta http-equiv='refresh' content='0'>";
                                    }else{ echo "error adding member";}
                                }
                        }else{
                            $addGuardian = $membersModel->addGuardian($mem);
                            $gID = $membersModel->getGuardianID($mem);
                            $mem['guardID'] = $gID->guardID;
                            $addMember = $membersModel->addMembers($mem);
                            if($addGuardian && $gID && $dID && $addMember){
                            //echo "<meta http-equiv='refresh' content='0'>";
                            }else{ echo "error adding member";}
                        }
                    //END OF GUARDIAN CHECK
                }
            }
        }

        // if($checkGuardian){
        //     $gID = $membersModel->getGuardianID($mem);
        //     //print_r($gID->guardID);
        //     $mem['guardID'] = $gID->guardID;
        //     $dID = $membersModel->getDiocese($mem);
        //     //print_r($dID->dID);
        //     $mem['dID'] = $dID->dID;
        //         if($checkID){
        //             $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
        //         }else{
        //             $addMember = $membersModel->addMembers($mem);
        //             if($gID && $dID && $addMember){
        //             $_SESSION['success'] = "Member Successfully Added. Add another? ► ";
        //             print_r($_SESSION['success']);
        //             //echo "<meta http-equiv='refresh' content='0'>";
        //             }else{ echo "error adding member";}
        //         }
            
        // }else{
        //     $addGuardian = $membersModel->addGuardian($mem);
        //     $gID = $membersModel->getGuardianID($mem);
        //     $mem['guardID'] = $gID->guardID;
        //     $dID = $membersModel->getDiocese($mem);
        //     $mem['dID'] = $dID->dID;
        //     $addMember = $membersModel->addMembers($mem);
        //     if($addGuardian && $gID && $dID && $addMember){
        //     echo "<meta http-equiv='refresh' content='0'>";
        //     }else{ echo "error adding member";}
        // }
    }
    if(isset($_REQUEST['edit']) && isset($_REQUEST['edit']) == "EDIT"){
        $mem['idNumStatic'] = isset ($_REQUEST['idNumStatic'])?$_REQUEST['idNumStatic']:NUll;
        $mem['idNum'] = isset ($_REQUEST['idNum'])?$_REQUEST['idNum']:NUll;
        $mem['fName'] = isset ($_REQUEST['fName'])?$_REQUEST['fName']:NUll;
        $mem['mName'] = isset ($_REQUEST['mName'])?$_REQUEST['mName']:NUll;
        $mem['lName'] = isset ($_REQUEST['lName'])?$_REQUEST['lName']:NUll;
        $mem['suffix'] = isset ($_REQUEST['suffix'])?$_REQUEST['suffix']:NUll;
        $mem['address'] = isset ($_REQUEST['address'])?$_REQUEST['address']:NUll;
        $mem['cNum'] = isset ($_REQUEST['cNum'])?$_REQUEST['cNum']:NUll;
        $mem['bday'] = isset ($_REQUEST['bday'])?$_REQUEST['bday']:NUll;
        $mem['sex'] = isset ($_REQUEST['sex'])?$_REQUEST['sex']:NUll;
        $mem['d'] = isset ($_REQUEST['diocese'])?$_REQUEST['diocese']:NUll;
        $mem['p'] = isset ($_REQUEST['parish'])?$_REQUEST['parish']:NUll;
        $mem['g'] = isset ($_REQUEST['gkk'])?$_REQUEST['gkk']:NUll;
        $mem['size'] = isset ($_REQUEST['size'])?$_REQUEST['size']:NUll;
        $mem['lay'] = isset ($_REQUEST['laybatch'])?$_REQUEST['laybatch']:NUll;
        $mem['train'] = isset ($_REQUEST['trainbatch'])?$_REQUEST['trainbatch']:NUll;
        $mem['gName'] = isset ($_REQUEST['guardName'])?$_REQUEST['guardName']:NUll;
        $mem['gAdd'] = isset ($_REQUEST['gaddress'])?$_REQUEST['gaddress']:NUll;
        $mem['gCnum'] = isset ($_REQUEST['gcNum'])?$_REQUEST['gcNum']:NUll;
        $mem['rel'] = isset ($_REQUEST['rel'])?$_REQUEST['rel']:NUll;

        $age = $membersModel->generateAge($mem);
        $mem['age'] = $age;

        $tempID = $mem['idNumStatic'];

        $checkID = $membersModel->checkIDup($mem);

        $checkG = $membersModel->checkG($mem);

        if($checkG){
            //echo "SULOD GKK";
                        // GET gID AND ADD member with gID
            $getGkk = $membersModel->getGkk($mem);
            $mem['g_ID'] = $getGkk->g_ID;
            //GUARDIAN CHECK
                    $checkGuardian = $membersModel->checkGuardian($mem);
                    if($checkGuardian){
                        $gID = $membersModel->getGuardianID($mem);
                        //print_r($gID->guardID);
                        $mem['guardID'] = $gID->guardID;
                            if($checkID){
                                $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                            }else{
                                $addMember = $membersModel->updateMember($mem,$tempID);
                                if($addMember){
                                $_SESSION['update'] = "Member Successfully Updated";
                                //echo "<meta http-equiv='refresh' content='0'>";
                                }else{ echo "error adding member";}
                            }
                    }else{
                        $addGuardian = $membersModel->addGuardian($mem);
                        $gID = $membersModel->getGuardianID($mem);
                        $mem['guardID'] = $gID->guardID;
                        $addMember = $membersModel->updateMember($mem,$tempID);
                        if($addGuardian && $gID && $dID && $addMember){
                       //echo "<meta http-equiv='refresh' content='0'>";
                        }else{ echo "error adding member";}
                    }
            //END OF GUARDIAN CHECK
        }else{
            $checkP = $membersModel->checkP($mem);
            if($checkP){
                //echo "SULOD PARISH";
                // GET parID - add gkk with parID - add member with gID
                $getPar = $membersModel->getParish($mem);
                $mem['p_ID'] = $getPar->par_ID;
                $addGkk = $membersModel->addGkk($mem);
                $getGkk = $membersModel->getGkk($mem);
                $mem['g_ID'] = $getGkk->g_ID;
                //GUARDIAN CHECK
                    $checkGuardian = $membersModel->checkGuardian($mem);
                    if($checkGuardian){
                        $gID = $membersModel->getGuardianID($mem);
                        //print_r($gID->guardID);
                        $mem['guardID'] = $gID->guardID;
                            if($checkID){
                                $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                            }else{
                                $addMember = $membersModel->updateMember($mem,$tempID);
                                if($addMember){
                                $_SESSION['update'] = "Member Successfully Updated.";
                                //echo "<meta http-equiv='refresh' content='0'>";
                                }else{ echo "error adding member";}
                            }
                    }else{
                        $addGuardian = $membersModel->addGuardian($mem);
                        $gID = $membersModel->getGuardianID($mem);
                        $mem['guardID'] = $gID->guardID;
                        $addMember = $membersModel->updateMember($mem,$tempID);
                        if($addGuardian && $addMember){
                        //echo "<meta http-equiv='refresh' content='0'>";
                        }else{ echo "error adding member";}
                    }
                //END OF GUARDIAN CHECK
            }else{
                $checkD = $membersModel->checkD($mem);
                if($checkD){
                    //echo "SULOD DIOCESE";
                    //GET dID - add parID with dID - add gkk with parID - add member with gID
                    $getDiocese = $membersModel->getDiocese($mem);
                    $mem['dID'] = $getDiocese->dID;
                    $addParish = $membersModel->addParish($mem);
                    $getPar = $membersModel->getParish($mem);
                    $mem['p_ID'] = $getPar->p_ID;
                    $addGkk = $membersModel->addGkk($mem);
                    $getGkk = $membersModel->getGkk($mem);
                    $mem['g_ID'] = $getGkk->g_ID;
                    //GUARDIAN CHECK
                        $checkGuardian = $membersModel->checkGuardian($mem);
                        if($checkGuardian){
                            $gID = $membersModel->getGuardianID($mem);
                            //print_r($gID->guardID);
                            $mem['guardID'] = $gID->guardID;
                                if($checkID){
                                    $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                                }else{
                                    $addMember = $membersModel->updateMember($mem,$tempID);
                                    if($addMember){
                                    $_SESSION['update'] = "Member Successfully Updated.";
                                    //echo "<meta http-equiv='refresh' content='0'>";
                                    }else{ echo "error adding member";}
                                }
                        }else{
                            $addGuardian = $membersModel->addGuardian($mem);
                            $gID = $membersModel->getGuardianID($mem);
                            $mem['guardID'] = $gID->guardID;
                            $addMember = $membersModel->updateMember($mem,$tempID);
                            if($addGuardian && $addMember){
                            //echo "<meta http-equiv='refresh' content='0'>";
                            }else{ echo "error adding member";}
                        }
                    //END OF GUARDIAN CHECK
                }else{
                    //Add new diocese - add parID with dID - add gkk with parID - add member with gID
                    $addDiocese = $membersModel->addDiocese($mem);
                    $getDiocese = $membersModel->getDiocese($mem);
                    $mem['dID'] = $getDiocese->dID;
                    $addParish = $membersModel->addParish($mem);
                    $getPar = $membersModel->getParish($mem);
                    $mem['p_ID'] = $getPar->par_ID;
                    $addGkk = $membersModel->addGkk($mem);
                    $getGkk = $membersModel->getGkk($mem);
                    $mem['g_ID'] = $getGkk->g_ID;
                    //GUARDIAN CHECK
                        $checkGuardian = $membersModel->checkGuardian($mem);
                        if($checkGuardian){
                            $gID = $membersModel->getGuardianID($mem);
                            //print_r($gID->guardID);
                            $mem['guardID'] = $gID->guardID;
                                if($checkID){
                                    $_SESSION['failed'] = "ID ALREADY EXIST. Please Select another ID and ";
                                }else{
                                    $addMember = $membersModel->updateMember($mem,$tempID);
                                    if($gID && $dID && $addMember){
                                    $_SESSION['update'] = "Member Successfully Updated.";
                                    //echo "<meta http-equiv='refresh' content='0'>";
                                    }else{ echo "error adding member";}
                                }
                        }else{
                            $addGuardian = $membersModel->addGuardian($mem);
                            $gID = $membersModel->getGuardianID($mem);
                            $mem['guardID'] = $gID->guardID;
                            $addMember = $membersModel->updateMember($mem,$tempID);
                            if($addGuardian && $gID && $dID && $addMember){
                            //echo "<meta http-equiv='refresh' content='0'>";
                            }else{ echo "error adding member";}
                        }
                    //END OF GUARDIAN CHECK
                }
            }
        }
    }
    if(isset($_REQUEST['search']) && isset($_REQUEST['search']) == "SEARCH"){
        $se['search'] = isset($_REQUEST['searchelement'])?$_REQUEST['searchelement']: NULL;
        if($se['search'] == NULL){
            echo "NULL SEARCH";
        }else
        $result = $membersModel->search($se);
    }
    if(isset($_REQUEST['save']) && isset($_REQUEST['save']) != NULL){

        $save = $membersModel->saveAll();
    }


    

    if(isset($_GET['value'])){
        $mID = isset ($_REQUEST['value'])?$_REQUEST['value']:NUll;
        $getMember = $membersModel->getMember($mID);
        if($getMember){
            //echo "member info retrived";
            }else{ echo "error getting member";}  
    }
    $showMembers = $membersModel->showMembers();
    $showDiocese = $membersModel->showDiocese();
    $showParish = $membersModel->showParish();
    $showGKK = $membersModel->showGKK();
    $membersModel->close();

?>