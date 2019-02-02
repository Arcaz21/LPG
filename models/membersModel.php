<?php include "../models/DBconnection.php"; 
?>
<?php

    class membersModel extends DBconnection {
//-----------ADD----------------------------
    	function addMembers($mem){
            $query ="INSERT INTO members(mID,g_ID,guardID,fName,mName,lName,suffix,address,cNum,bday,age,sex,size,lay_num,train_num) 
            VALUES (
            \"".$mem['idNum']."\",
            \"".$mem['g_ID']."\",
            \"".$mem['guardID']."\",
            \"".$mem['fName']."\",
            \"".$mem['mName']."\",
            \"".$mem['lName']."\",
            \"".$mem['suffix']."\",
            \"".$mem['address']."\",
            \"".$mem['cNum']."\",
            \"".$mem['bday']."\",
            \"".$mem['age']."\",
            \"".$mem['sex']."\",
            \"".$mem['size']."\",
            \"".$mem['lay']."\",
            \"".$mem['train']."\"
            )";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR ADDING MEMBER";
                header('Location: error.php');
            }   
        }
        function addGuardian($mem){
            $query ="INSERT INTO guardian (gName,gAdd,gCnum,rel)
            VALUES(
            \"".$mem['gName']."\",
            \"".$mem['gAdd']."\",
            \"".$mem['gCnum']."\",
            \"".$mem['rel']."\"
            )";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR ADDING GUARDIAN";
                header('Location: error.php');
            }
        }
        function addDiocese($mem){
            $query ="INSERT INTO diocese (d_name)
            VALUES(
            \"".$mem['d']."\"
            )";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR ADDING Diocese";
                header('Location: error.php');
            }
        }
        function addParish($mem){
            $query ="INSERT INTO parish (par_name,dID)
            VALUES(
            \"".$mem['p']."\",
            \"".$mem['dID']."\"
            )";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR ADDING Parish";
                header('Location: error.php');
            }
        }
        function addGkk($mem){
            $query ="INSERT INTO gkk (g_name, par_ID)
            VALUES (
            \"".$mem['g']."\",
            \"".$mem['p_ID']."\"
            )";
            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR ADDING GKK";
                header('Location: error.php');
            }
        }

//-----------SHOW---------------------------     
        function showMembers(){
    		$query ="SELECT * FROM members 
            JOIN gkk on gkk.g_ID = members.g_ID
            JOIN parish on parish.par_ID = gkk.par_ID
            JOIN diocese on diocese.dID = parish.dID
            JOIN guardian on guardian.guardID = members.guardID";
            $result = mysqli_query($this->conn, $query);
			$res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
    	}
        function showDiocese(){
            $query="SELECT * FROM diocese";
            $result = mysqli_query($this->conn, $query);
            $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        }
        function showParish(){
            $query="SELECT * FROM parish";
            $result = mysqli_query($this->conn, $query);
            $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        }
        function showGKK(){
           $query="SELECT * FROM gkk";
            $result = mysqli_query($this->conn, $query);
            $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        }
//-----------CHECKS---------------------------         
        
        function checkGuardian($mem){
            $query="SELECT * from guardian 
            WHERE gName =\"".$mem['gName']."\"";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        function checkID($mem){
            $query="SELECT * from members 
            WHERE mID =\"".$mem['idNum']."\"";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        function checkIDUp($mem){
            $query="SELECT * from members 
            WHERE mID <> \"".$mem['idNum']."\"
            AND mID IN (SELECT mID from members WHERE mID = \"".$mem['idNum']."\")";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        function checkD($mem){
            $query="SELECT * from diocese 
            WHERE d_name =\"".$mem['d']."\"";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        function checkP($mem){
            $query="SELECT * from parish 
            WHERE par_name =\"".$mem['p']."\"";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        function checkG($mem){
            $query="SELECT * from gkk 
            WHERE g_name =\"".$mem['g']."\"";
            $result = mysqli_query($this->conn, $query);
            if($result->num_rows == 1){
                return TRUE;
            }else{
                return FALSE;
            }
        }
//-----------GET---------------------------
        function getMember($mID){
            $query ="SELECT * FROM members 
            JOIN gkk on gkk.g_ID = members.g_ID
            JOIN parish on parish.par_ID = gkk.par_ID
            JOIN diocese on diocese.dID = parish.dID
            JOIN guardian on guardian.guardID = members.guardID
            WHERE mID = \"".$mID."\"";
            $result = mysqli_query($this->conn, $query);
            $res = array();
                while ($row = mysqli_fetch_array($result)){
                    array_push($res, $row);
                }
            return ($result->num_rows>0)? $res: FALSE;
        }
        function getGuardianID($mem){
            $query = "SELECT guardID FROM guardian WHERE gName =\"".$mem['gName']."\"";
            $result = mysqli_query($this->conn, $query);
                if(!$result) {
                    die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                }
            $data = $result->fetch_object();
            return $data;
        }
        function getDiocese($mem){
            $query ="SELECT dID from diocese WHERE d_name = \"".$mem['d']."\"";
            $result = mysqli_query($this->conn, $query);
                if(!$result) {
                    die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                }
            $data = $result->fetch_object();
            return $data;
        }
        function getParish($mem){
            $query ="SELECT par_ID from parish WHERE par_name = \"".$mem['p']."\"";
            $result = mysqli_query($this->conn, $query);
                if(!$result) {
                    die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                }
            $data = $result->fetch_object();
            return $data;
        }
        function getGkk($mem){
            $query ="SELECT g_ID from gkk WHERE g_name = \"".$mem['g']."\"";
            $result = mysqli_query($this->conn, $query);
                if(!$result) {
                    die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                }
            $data = $result->fetch_object();
            return $data;  
        }
        

//----------DELETE---------------------------   
        function deleteMember($mID){
            $query="DELETE from members WHERE mID = \"".$mID."\"";
            $result = mysqli_query($this->conn, $query);
                if(!$result) {
                    die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                }else{
                    return $result;
                }            
        }
//----------UPDATE---------------------------
        function updateMember($mem,$tempID){
            $query = "UPDATE members 
            SET
            mID = \"".$mem['idNum']."\",
            g_ID = \"".$mem['g_ID']."\",
            guardID = \"".$mem['guardID']."\",
            fName = \"".$mem['fName']."\",
            mName = \"".$mem['mName']."\",
            lName = \"".$mem['lName']."\",
            suffix = \"".$mem['suffix']."\",
            address = \"".$mem['address']."\",
            cNum = \"".$mem['cNum']."\",
            bday = \"".$mem['bday']."\",
            age = \"".$mem['age']."\",
            sex = \"".$mem['sex']."\",
            size = \"".$mem['size']."\",
            lay_num = \"".$mem['lay']."\",
            train_num = \"".$mem['train']."\"
            WHERE mID = \"".$tempID."\" "; 

            $result = mysqli_query($this->conn, $query);
            if($result){
                return (($result)? TRUE:FALSE);
            }else{
                echo "ERROR UPDATING MEMBER";
                
            } 

        }
//----------OTHERS---------------------------         
        function generateAge($mem){
            //date in mm/dd/yyyy format; or it can be in other formats as well
             $birthDate = $mem['bday'];
            //explode the date to get month, day and year
            $birthDate = explode("-", $birthDate);
            $year = $birthDate[0];
            $month = $birthDate[2];
            $day = $birthDate[1];
            $sec = 0;
            $min = 0;
            $hour =0;
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $day, $month, $year))) > date("md")? 
                ((date("Y") - $birthDate[0]) - 1): 
                (date("Y") - $birthDate[0]));
            return $age;
        }

        function saveAll(){
            // output headers so that the file is downloaded rather than displayed
            date_default_timezone_set('Asia/Manila');
            $fname = "Members as of " . date("Y/m/d h-m-s");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$fname.".csv");

            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');

            // output the column headings
            fputcsv($output, array('First Name', 'Middle Name', 'Surname', 'Suffix', 'Address', 'Contact Number', 'Birthdate', 'Age', 'GKK', 'Parish', 'Diocese', 'Guardian Name', 'Guardian Address', 'Guardian Contact #', 'Realtionship', 'Shirt Size'));

            // fetch the data
            mysql_connect('localhost', 'root', '');
            mysql_select_db('pod');
            $rows = mysql_query('SELECT fName, mName, lName, suffix, address, cNum, bday, age, sex, g_name, par_name, d_Name, gName, gAdd, gCnum, rel, size FROM members 
            JOIN gkk on gkk.g_ID = members.g_ID
            JOIN parish on parish.par_ID = gkk.par_ID
            JOIN diocese on diocese.dID = parish.dID
            JOIN guardian on guardian.guardID = members.guardID');

            // loop over the rows, outputting them
            while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
            exit();
        }
//----------SEARCH---------------------------  
        function search($se){
            $query = "SELECT * FROM members 
            JOIN gkk on gkk.g_ID = members.g_ID
            JOIN parish on parish.par_ID = gkk.par_ID
            JOIN diocese on diocese.dID = parish.dID
            JOIN guardian on guardian.guardID = members.guardID
            WHERE mID LIKE '%".$se['search']."%' OR fName LIKE '%".$se['search']."%' OR lName LIKE '%".$se['search']."%' OR mName LIKE '%".$se['search']."%' OR d_name LIKE '%".$se['search']."%' "; 
                $result = mysqli_query($this->conn, $query);
                $res = array();

                while ($row = mysqli_fetch_array($result)){
                    array_push($res, $row);
                }
                return ($result->num_rows>0)? $res: FALSE;
        }
        
    }
    
    class usersModel extends DBconnection {

        function selectAll(){ 

            $query = "SELECT * FROM users";
            $result = mysqli_query($this->conn, $query);
            $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        }
        function getUse($username){
            
            $query = "SELECT username, password, fname, lname, role FROM users
                      WHERE username = \"".$username."\"
                      LIMIT 1
                      ";

            $result = mysqli_query($this->conn, $query);
            
            // if there is an error in your query, an error message is displayed.
            if(!$result) {
                die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
            }
            $row = $result->fetch_object();
            return $row;
        }
    }
?>