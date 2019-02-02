<?php include "../models/DBconnection.php"; 
?>

<?php
/*===================================================================================== FOR USER MODEL*/
class userModel extends DBconnection {

		function userExists($username, $password) {
			
			$query = "SELECT username, password, fname, lname, role FROM users
					  WHERE username = \"".$username."\" AND password = \"".$password."\"
					  LIMIT 1
					  ";
					  

			$result = mysqli_query($this->conn, $query);

			if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error());
			}
			return (($result->num_rows==1)? TRUE: FALSE);
        }
        function getUser($id) {
				
				$query = "SELECT id, username, password, fname, lname, role FROM users
						WHERE id = \"".$id."\"";
                $result = mysqli_query($this->conn, $query);
                $res = array();
                while ($row = mysqli_fetch_array($result)){
                    array_push($res, $row);
                }
                return ($result->num_rows>0)? $res: FALSE;
		}
        function getUse($username) {
			
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
        function close(){
            mysqli_close($this->conn);
        }

}

class adminsModel extends DBconnection {

        function addnewUser($newU){
                    $query=" INSERT INTO users (id,username, password, fname, lname, role ) 
                    VALUES (NULL, \"".$newU['username']."\",\"".$newU['password']."\", \"".$newU['fName']."\", \"".$newU['lName']."\", \"".$newU['role']."\" )";
                
                    $result = mysqli_query($this->conn, $query);
                    // if there is an error in your query, an error message is displayed.
                    if(!$result) {
                        die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                    }else{
                        return $result;
                    }
        }
        function addnewUserfromS($newS){
                    $query=" INSERT INTO users (id,username, password, fname, lname, role ) 
                    VALUES (NULL, \"".$newS['guardianID']."\",\"".$newS['password']."\", \"".$newS['gFname']."\", \"".$newS['gLname']."\", \"".$newS['role']."\" )";
                
                    $result = mysqli_query($this->conn, $query);
                    // if there is an error in your query, an error message is displayed.
                    if(!$result) {
                        die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                    }else{
                        return $result;
                    }
        }
        function updateUser($editU){
                    $query=" UPDATE users  
                    SET username = \"".$editU['username']."\", 
                    password = \"".$editU['password']."\",
                    fname = \"".$editU['fname']."\",
                    lname = \"".$editU['lname']."\",
                    role =\"".$editU['role']."\"
                    WHERE id = \"".$editU['id']."\"";
                
                    $result = mysqli_query($this->conn, $query);
                    // if there is an error in your query, an error message is displayed.
                    if(!$result) {
                        die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
                    }else{
                        return $result;
                    }
        }
        function deleteU($usern){
            $query = "DELETE FROM users WHERE id = \"".$usern['id']."\" ";

            $result = mysqli_query($this->conn, $query);
                    // if there is an error in your query, an error message is displayed.
                    if(!$result) {
                        die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn)); 
                    }else{
                        return $result;
                    }
        }
        function selectAll(){
            $query = "SELECT * FROM users";
            $result = mysqli_query($this->conn, $query);
            $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        }
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
}

?>