<?php include "../models/productModel.php";
$product = new productModel();
$cartfunc = new cartModel();
$vend = new vendorModel();
$sales = new salesModel();
$getprodcount = $product->productinventory();
$getprodcount1 = $product->productinventory1();
$getvendor = $vend->getVendors();
$getcat = $product->getcategories();
//$getcart = $cartfunc->getcart();
//$getcarttotal = $cartfunc->gettotal();
//print_r($_SESSION['page']);
$prod['prodname'] = isset ($_REQUEST['prodname'])?$_REQUEST['prodname']:NUll;
$prod['description'] = isset ($_REQUEST['description'])?$_REQUEST['description']:NUll;
$prod['weight'] = isset ($_REQUEST['weight'])?$_REQUEST['weight']:NUll;
$prod['serial'] = isset ($_REQUEST['serial'])?$_REQUEST['serial']:NUll;
$prod['qty'] = isset ($_REQUEST['qty'])?$_REQUEST['qty']:NUll;
$prod['price'] = isset ($_REQUEST['price'])?$_REQUEST['price']:NUll;
$prod['cat'] = isset ($_REQUEST['cat'])?$_REQUEST['cat']:NUll;
$prod['prodID'] = isset ($_REQUEST['prodid'])?$_REQUEST['prodid']:random_int(10, 10000);
$prod['userID'] = isset ($_REQUEST['userID'])?$_REQUEST['userID']:NUll;
$prod['status'] = isset ($_REQUEST['status'])?$_REQUEST['status']:NUll;
////////////
$checkout['userID'] = isset ($_REQUEST['user'])?$_REQUEST['user']:NUll;
$checkout['vendorID'] = isset ($_REQUEST['vendor'])?$_REQUEST['vendor']:NUll;
$checkout['due-payment'] = isset ($_REQUEST['due-payment'])?$_REQUEST['due-payment']:NUll;
$checkout['payment'] = isset ($_REQUEST['payment'])?$_REQUEST['payment']:NUll;
$checkout['tax'] = ($checkout['payment']*.12);
$checkout['change'] = ($checkout['payment'] - $checkout['due-payment']);
////////////
$vendr['vendname'] = isset ($_REQUEST['vendname'])?$_REQUEST['vendname']:NUll;
$vendr['vendcomp']= isset ($_REQUEST['vendcomp'])?$_REQUEST['vendcomp']:NUll;
$vendr['vendadd']= isset ($_REQUEST['vendadd'])?$_REQUEST['vendadd']:NUll;
$vendr['vendcon']= isset ($_REQUEST['vendcon'])?$_REQUEST['vendcon']:NUll;
$vendr['userID']= isset ($_REQUEST['userID'])?$_REQUEST['userID']:NUll;
$vendr['add'] = isset ($_REQUEST['add'])?$_REQUEST['add']:NUll;
$vendr['id'] = isset ($_REQUEST['id'])?$_REQUEST['id']:NUll;
///////////
$prod['id'] = isset ($_REQUEST['id'])?$_REQUEST['id']:NUll;
$cart['pcs']= isset ($_REQUEST['pcs'])?$_REQUEST['pcs']:NUll;
$add = isset ($_REQUEST['add'])?$_REQUEST['add']:NUll;

if($checkout['payment'] && $checkout['userID'] && $checkout['vendorID']){
	$checkout['salesID'] = random_int(1000, 100000);
	//to avoid duplicate ID
	$checkSalesID = $cartfunc->checkSalesID($checkout['salesID']);
	if(!$checkSalesID){
	$checkout['salesID'] = random_int(1000, 100000);
	}
	if($checkout['vendorID'] == "Others"){
		$add = "Add Client Cash";
		header('location:addvendor.php');
	}else{$_SESSION['invoice'] = 'PRINT';
	$sales = new salesModel();
	print_r($checkout);
	$addsales = $sales->addSales($checkout);
	$getcart = $cartfunc->getcart();
	error_reporting(E_ERROR | E_PARSE); foreach ($getcart as $index => $cart):
	$addsalesDetail = $sales->addDetail($cart,$checkout['salesID']);
	endforeach;
	if($addsales && $addsalesDetail){
		$getcart = $cartfunc->getcart();
		error_reporting(E_ERROR | E_PARSE); foreach ($getcart as $index => $cart):
		print_r($cart['product_id']);
		$updateproduct = $product->updateqty($cart);
		endforeach;
		$getprodcount = $product->productinventory();
		$emptycart = $cartfunc->truncatecart();
		if($emptycart){
			$_SESSION['salesID'] = $checkout['salesID'];
			header("location: invoice.php");
		}
		

	}}
	
}
if (isset($_REQUEST['add']) && $_REQUEST['add'] == "Add Product") {
	$product->addproduct($prod);
	if($product){  $_SESSION['success'] = "Added New Product";
	}else{  $_SESSION['failed'] = "Failed to Add Product".$product;
	}
}
if(isset($_SESSION['page'])&& $_SESSION['page']=='updateproduct'){
	$product->updateproduct($prod);
	if($product){  $_SESSION['success'] = "Product Updated";
	}else{  $_SESSION['failed'] = "Product Update Failed!".$product;
	}
}
if(isset($_SESSION['page'])&& $_SESSION['page']=='products'){
	$getInvlogs = $product->getInvlogs();
}
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='addcart'){
	//check if request from dashboard is validated
	if(isset($_REQUEST['cart'])&&$_REQUEST['cart']==$prod['prodID']){	
		if($cart['pcs'] && $cart['pcs'] > 0){
			//echo "passed pcs check <br>";
			$checkcart = $cartfunc->check();
			//var_dump($checkcart);
			if($checkcart){
				//echo "passed checkcart <br>";
				//print_r($prod);
				$prodcart = $cartfunc->prodcart($prod);
				//var_dump($prodcart[0]['qty']);
				if(($prodcart[0]['qty'] > $prodcart[0]['cartqty'])){
					//print_r($prodcart[0]['qty']);
					//echo "passed qty greater than <br>";
					$temp = $prodcart[0]['qty']-$prodcart[0]['cartqty'];
					//print_r($temp);
					if($temp==$cart['pcs'] || $temp>$cart['pcs']){
						//echo "passed temp verification <br>";
						//echo "added 1";
						$getproduct = $product->getproduct($prod);
						$addcart = $cartfunc->addcart($getproduct,$prod,$cart);
						$getcart = $cartfunc->getcart();
						$getcarttotal = $cartfunc->gettotal();
					}else{$_SESSION['failed'] = "Limit reached! You have ".$temp." items. You are trying to add ".$cart['pcs'];}
				}else{
					$getproduct = $product->getproduct($prod);
					if($getproduct[0]['qty'] == 0 || $getproduct[0]['qty'] == NULL){
						$_SESSION['failed'] = "OUT OF STOCK";
					}else{$_SESSION['failed'] = "Limite Exceeded!";}
				}
			}else{
					$getproduct = $product->getproduct($prod);
					//print_r($getproduct[0]['qty'] );
					if($getproduct[0]['qty'] == 0 || $getproduct[0]['qty'] == NULL){
						$_SESSION['failed'] = "OUT OF STOCK";
					}else{
						$getproduct = $product->getproduct($prod);
						//print_r($getproduct[0]['qty'] );print_r($cart['pcs'] );
						if($getproduct[0]['qty'] == $cart['pcs']||$getproduct[0]['qty'] > $cart['pcs']){
							//echo "added 2";
							$addcart = $cartfunc->addcart($getproduct,$prod,$cart);
							$getcart = $cartfunc->getcart();
							$getcarttotal = $cartfunc->gettotal();
						}else{$_SESSION['failed'] = "You Don't Have Enough Stocks";}
					}
				}
			}else{$_SESSION['failed'] = "Please Input Quantity.";}
		}
}
if(isset($_REQUEST['action'])&&$_REQUEST['action']=='delete'){
		$rmvcart= $cartfunc->removecart($prod);
		$getcart = $cartfunc->getcart();
}
if(isset($_SESSION['page'])&&$_SESSION['page'] == "dashboard"){
	$checkcart = $cartfunc->check();
	if($checkcart){
		$getcarttotal = $cartfunc->gettotal();
		$getcart = $cartfunc->getcart();
		$getvendor = $vend->getVendors();
	}
}
if(isset($_SESSION['invoice'])){
	$user = new userModel();
	$getInfo = $sales->getSalesReport($_SESSION['salesID']);
	$getall = $cartfunc->gettotalID($_SESSION['salesID']);
}
if(isset($_SESSION['page'])&&$_SESSION['page'] == "salesreport"){
	$getRep = $sales->getSalesRep();
}
//print_r($_SESSION['page']);
if(isset($_SESSION['page'])&&$_SESSION['page'] == "clientpage"){
	$getClient= $vend->getVendors();
	//print_r($getClient);
	//print_r($_REQUEST['delete']);
	$_REQUEST['delete'] = isset ($_REQUEST['delete'])?$_REQUEST['delete']:NUll;
	if($_REQUEST['delete'] == 'delete'){
		$deletevendors = $vend->deleteVendor($_REQUEST['vendID']);
		if($deletevendors){
			$getClient= $vend->getVendors();
			$_SESSION['success'] = "Client Removed!";
		}
	}
}
if(isset($_SESSION['page'])&&$_SESSION['page'] == "addvendor"){
		
	if($add == 'Add Client'){
	$addvendors = $vend->addVendor($vendr);
		if($addvendors){
			$_SESSION['success'] = "New CLient Added!";
		}
	}
	if($add == "Add Client Cash"){
		print_r($checkout);
		if($addvendors){
			$_SESSION['success'] = "New CLient Added!";
			
		}
	}
}
if(isset($_SESSION['page'])&&$_SESSION['page'] == "editvendor"){
	print_r($_SESSION['editid']);
	$getVend= $vend->getVend($_SESSION['editid']);
	//print_r($getVend);
	$_REQUEST['update'] = isset ($_REQUEST['update'])?$_REQUEST['update']:NUll;
	if($_REQUEST['update'] == 'Update Client'){
		//print_r($vendr);
		$updatevend = $vend->updateVendor($vendr);
		//var_dump($updatevend);
		if($updatevend){
			$_SESSION['success'] = "Client ".$vendr['vendname']." has been updated!";
			header("location:vendors.php");
		}
	}
}
if(isset($_SESSION['page'])&&$_SESSION['page'] == "editproduct"){
	//$prod['prodID'] = $_SESSION['id'];
	$getproduct = $product->getproduct($prod);
	//print_r($getproduct);
	$_REQUEST['update'] = isset ($_REQUEST['update'])?$_REQUEST['update']:NUll;
	if($_REQUEST['update'] == "Update Product"){
		$updateprod = $product->updateproduct($prod);
		if($updateprod){
			$_SESSION['success'] = "Product Updated!";
			header("location: products.php");
		}
	}
}
if(isset($_REQUEST['change'])&&$_REQUEST['change'] == "change"){
	//print_r($prod);
	$getproduct = $product->getproduct($prod);
	print_r($getproduct);
}
if(isset($_REQUEST['deleteprod'])&&$_REQUEST['deleteprod'] == "deleteprod"){
	//print_r($prod);
	$delprod = $product->deleteproduct($prod);
	if($delprod){
		$_SESSION['delete'] = "Successfully Deleted Product!";
	}else{$_SESSION['failed'] = "Delete Failed";}
}





?>