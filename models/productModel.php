<?php include "../models/DBconnection.php";

class productModel extends DBconnection {

	function productinventory(){
		$query = "SELECT product_id,category.cat_id,serial,name,weight,qty,price,status,products.description, category.description as catdesc FROM `products`JOIN category on category.cat_id=products.cat_id ORDER BY serial ASC ";
		
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function productinventory1(){
		$query = "SELECT product_id,category.cat_id,serial,name,weight,qty,price,status,products.description, category.description as catdesc FROM `products`JOIN category on category.cat_id=products.cat_id WHERE status = '1' ";
		print_r($query);
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function getproduct($prod){
		$query = "SELECT product_id,category.cat_id,serial,name,weight,qty,price,status,products.description, category.description as catdesc FROM `products`JOIN category on category.cat_id=products.cat_id WHERE product_id=\"".$prod['prodID']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function addproduct($prod){
		$query = "INSERT INTO `products` ( `product_id`,`cat_id`, `serial`, `name`,`description`, `weight`, `qty`,`price`, `status`) VALUES 
			(\"".$prod['prodID']."\",
			\"".$prod['cat']."\",
			\"".$prod['serial']."\",
			\"".$prod['prodname']."\",
			\"".$prod['description']."\",
			\"".$prod['weight']."\",
			\"".$prod['qty']."\",
			\"".$prod['price']."\",
			'1')";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
			}
		$log = "INSERT INTO `inventory_log` (`user_id`, `product_id`, `action`, `description`) 
		VALUES 
		(\"".$prod['userID']."\", 
		\"".$prod['prodID']."\", 
		'ADD PRODUCT', 
		\"".'Serial:'.$prod['serial'].', Weight: '.$prod['weight'].', Quantity:'.$prod['qty']."\")";
		$logresult = mysqli_query($this->conn, $log);
		if(!$logresult) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
			}
		return (($result)? TRUE:FALSE);
        close();
	}
	function updateproduct($prod){
		$query="UPDATE `products` SET 
		`name`=\"".$prod['prodname']."\",
		`description`=\"".$prod['description']."\",
		`weight`=\"".$prod['weight']."\",
		`qty`=\"".$prod['qty']."\",
		`price`=\"".$prod['price']."\",
		`status`=\"".$prod['status']."\" 
		WHERE product_id = \"".$prod['prodID']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
				return FALSE;
			}
		$log = "INSERT INTO `inventory_log` (`user_id`, `product_id`, `action`, `description`) 
		VALUES 
		(\"".$prod['userID']."\", 
		\"".$prod['prodID']."\", 
		'UPDATED PRODUCT', 
		\"".'Serial:'.$prod['serial'].', Weight: '.$prod['weight'].', Quantity:'.$prod['qty']."\")";
		print_r($log);
		$logresult = mysqli_query($this->conn, $log);
		if(!$logresult) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
			}
		return (($result)? TRUE:FALSE);
        close();
	}
	function updateqty($cart){
		$query="UPDATE `products` 
		SET `qty`=\"".($cart['qty']-$cart['cartqty'])."\" 
		WHERE `product_id` = \"".$cart['product_id']."\" ";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
			}
	}
	function deleteproduct($prod){
		$query="DELETE FROM `products` WHERE `product_id`=\"".$prod['prodID']."\"";
		$result = mysqli_query($this->conn,$query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
				return FALSE;
		}
		//print_r($result);
		if($result>0){
			echo "Sulod";
			$log = "INSERT INTO `inventory_log` (`user_id`, `product_id`, `action`, `description`) 
		VALUES 
		(\"".$prod['userID']."\", 
		\"".$prod['prodID']."\", 
		'DELETED PRODUCT', 
		\"".'Serial:'.$prod['serial'].', Weight: '.$prod['weight'].', Quantity:'.$prod['qty']."\")";
		$logresult = mysqli_query($this->conn, $log);
		if(!$logresult) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
			}
		return TRUE;
        close();
		}else {return FALSE;}	
	}
	function check($prod){
		$query="SELECT * FROM `products` WHERE product_id=\"".$prod['prodID']."\" AND qty > 1";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		}
		return (($result->num_rows>0)? TRUE: FALSE);
	}
	function getcategories(){
		$query = "SELECT * FROM `category`";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}	
	function getInvlogs(){
		$query = "SELECT *,products.name as name,inventory_log.description as inv_description FROM `inventory_log` JOIN products ON inventory_log.product_id = products.product_id JOIN users ON users.user_id = inventory_log.user_id";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}	
}
class cartModel extends DBconnection{

	function addcart($getproduct,$prod,$cart){
		$query = "INSERT INTO `cart` (`user_id`, `product_id`, `qty`) 
		VALUES (\"".$prod['userID']."\", \"".$getproduct['0']['product_id']."\", \"".$cart['pcs']."\");";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
			return TRUE;
	}
	function getcart(){
		$query = "SELECT *,SUM(cart.qty) as cartqty,price*SUM(cart.qty) as SubTotal FROM `cart` JOIN products ON products.product_id =cart.product_id GROUP BY products.product_id";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function gettotal(){
		$query = "SELECT SUM(SubTotal) as GrandTotal from (
					SELECT * from(
						SELECT price*SUM(cart.qty) as SubTotal FROM `cart` JOIN products ON products.product_id =cart.product_id GROUP BY products.product_id
						) as sum
					) as total";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function gettotalID($salesID){
		$query = "SELECT * from(
					SELECT products.product_id as ProdID, products.serial as Serial1, products.name as ProdName, products.description as ProdDescription, products.weight as ProdWeight, products.qty as ProdQty, products.price as ProdPrice, products.status as ProdStatus,sales.sales_id as SalesID, sales.total as SalesTotal, sales.tax as SalesTax, sales.payment as SalesPayment, sales.paymentChange as PaymentChange, concat(fname,' ',lname) as CashierName, vendor.vendor_id as VendID, vendor.name as VendName, vendor.company as VendCompany, vendor.address as VendAdd, vendor.contact as VendCon, sales.update_time as SalesTime FROM `sales` JOIN sales_detail ON sales_detail.sales_id = sales.sales_id JOIN users ON users.user_id=sales.user_id JOIN vendor ON vendor.vendor_id = sales.vendor_id JOIN products ON products.product_id = sales_detail.product_id
						WHERE sales.sales_id = '$salesID'
					) as sad";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function check(){
		$query="SELECT * FROM `cart`";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return (($result->num_rows>0)? TRUE: FALSE);
	}
	function removecart($prod){
		$query="DELETE FROM `cart` WHERE product_id =\"".$prod['prodID']."\" ";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return TRUE;
	}
	function prodcart($prod){
		$query = "SELECT *, SUM(cart.qty) as cartqty FROM `cart`JOIN products on products.product_id=cart.product_id WHERE products.product_id=\"".$prod['prodID']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function checkSalesID($id){
		$query="SELECT * FROM `sales` WHERE sales_id = $id ";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return (($result->num_rows>0)? TRUE: FALSE);
	}
	function truncatecart(){
		$query = "TRUNCATE TABLE `cart`";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
			return TRUE;
	}
}
class salesModel extends DBconnection {

	function getSalesReport($vendID){
		$query="SELECT *,sales_detail.qty as soldqty,products.name as productName, sales_detail.qty*price as SubTotal FROM `sales` JOIN sales_detail ON sales_detail.sales_id = sales.sales_id JOIN users ON users.user_id=sales.user_id JOIN vendor ON vendor.vendor_id = sales.vendor_id JOIN products ON products.product_id = sales_detail.product_id
		 WHERE sales.sales_id = '$vendID' ";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function getSalesRep(){
		$query="SELECT *,sales_detail.qty as soldqty,products.name as productName, sales_detail.qty*price as SubTotal, products.name as ProdName, concat(fname,'',lname) as CleintName, vendor.name as VendName FROM `sales` JOIN sales_detail ON sales_detail.sales_id = sales.sales_id JOIN users ON users.user_id=sales.user_id JOIN vendor ON vendor.vendor_id = sales.vendor_id JOIN products ON products.product_id = sales_detail.product_id ";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function addSales($sales){
		$query = "INSERT INTO `sales`(`sales_id`, `user_id`, `vendor_id`, `total`, `tax`, `payment`, `paymentChange`)
		VALUES (\"".$sales['salesID']."\", \"".$sales['userID']."\", \"".$sales['vendorID']."\", \"".$sales['due-payment']."\", \"".$sales['tax']."\", \"".$sales['payment']."\", \"".$sales['change']."\");";
		$result = mysqli_query($this->conn, $query);

		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
			return TRUE;
	}
	function addDetail($getcart,$salesID){
		$query = "INSERT INTO `sales_detail` (`sales_id`, `product_id`, `qty`)
		VALUES ('$salesID', \"".$getcart['product_id']."\", \"".$getcart['cartqty']."\");";
		echo $query;
		$result = mysqli_query($this->conn, $query);

		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
			return TRUE;
	}
}
class vendorModel extends DBconnection {

	function getVendors(){
		$query="SELECT * FROM vendor";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function getVend($vend){
		$query="SELECT * FROM vendor WHERE vendor_id= '$vend'";
		$result = mysqli_query($this->conn, $query);
        if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
            return ($result->num_rows>0)? $res: FALSE;
        close();
	}
	function addVendor($vend){
		$query="INSERT INTO `vendor` ( `name`, `company`, `address`, `contact`) 
		VALUES 
		(
		 \"".$vend['vendname']."\",
		 \"".$vend['vendcomp']."\",
		  \"".$vend['vendadd']."\",
		  \"".$vend['vendcon']."\")";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
				return FALSE;
			}
			return TRUE;
	}
	function updateVendor($vend){
		$query="UPDATE `vendor` SET `name`=\"".$vend['vendname']."\",`address`=\"".$vend['vendadd']."\",`contact`=\"".$vend['vendcon']."\" WHERE `vendor_id`=\"".$vend['id']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
				return FALSE;
			}
			return TRUE;
	}
	function deleteVendor($vend){
		$query="DELETE FROM `vendor` WHERE 	`vendor_id`= '$vend'";
		$result = mysqli_query($this->conn,$query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return mysqli_error($this->conn);
				return FALSE;
			}
			return TRUE;
	}
}
class userModel extends DBconnection{

	function getUse($username) {
			
			$query = "SELECT * FROM users
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
	function getUseID($username) {
			
			$query = "SELECT * FROM users
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
class supplierModel extends DBconnection{

	function addSupp($supp){
		$query = "INSERT INTO `supplier`(`supp_name`, `tank_price`) 
		VALUES (\"".$supp['supp_name']."\",\"".$supp['tank_price']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return TRUE;
	}
	function deleteSupp($supp){
		$query = "DELETE FROM `supplier` WHERE supp_id = \"".$supp['supp_id']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return TRUE;
	}
	function updateSupp($supp){
		$query = "UPDATE `supplier` SET `supp_name`=\"".$supp['supp_name']."\",`tank_price`=\"".$supp['tank_price']."\" WHERE supp_id = \"".$supp['supp_id']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
			return FALSE;
		}
		return TRUE;
	}
	function getAllSupp(){
		$query = "SELECT * FROM supplier";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
        return (TRUE)? $res: FALSE;
        close();
	}
	function getSupp($supp){
		$query = "SELECT * FROM supplier WHERE supp_id = \"".$supp['supp_id']."\"";
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
				return FALSE;
			}
        $res = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($res, $row);
            }
        return (TRUE)? $res: FALSE;
        close();
	}
}

?>