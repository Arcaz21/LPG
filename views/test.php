<?php

if($cart['pcs'] && $cart['pcs'] > 0){
	$checkcart = $cartfunc->check();
	if($checkcart){
		$prodcart = $cartfunc->prodcart($prod);
		if($cart['pcs'])
	}
}else{$_SESSION['failed'] = "Please Input Quantity.";}




if($cart['pcs'] && $cart['pcs'] > 0){
			echo "passed pcs check <br>";
			$checkcart = $cartfunc->check();
			var_dump($checkcart);
			if($checkcart){
				echo "passed checkcart <br>";
				$prodcart = $cartfunc->prodcart($prod);
				if(($prodcart[0]['qty'] > $prodcart[0]['cartqty'])){
					print_r($prodcart[0]['qty']);
					echo "passed qty greater than <br>";
					$temp = $prodcart[0]['qty']-$prodcart[0]['cartqty'];
					if($temp==$cart['pcs'] || $temp<$cart['pcs']){
						echo "passed temp verification <br>";
						echo "added 1";
						$getproduct = $product->getproduct($prod);
						$addcart = $cartfunc->addcart($getproduct,$prod,$cart);
						$getcart = $cartfunc->getcart();
					}else{$_SESSION['failed'] = "Limit reached! You have".$temp."items. You are trying to add".$cart['pcs'];}
				}else{
					$getproduct = $product->getproduct($prod);
					if($getproduct[0]['qty'] == 0 || $getproduct[0]['qty'] == NULL){
						$_SESSION['failed'] = "OUT OF STOCK";
					}else{$_SESSION['failed'] = "Limite Exceeded!";}
				}
			}else{
					$getproduct = $product->getproduct($prod);
					print_r($getproduct[0]['qty'] );
					if($getproduct[0]['qty'] == 0 || $getproduct[0]['qty'] == NULL){
						$_SESSION['failed'] = "OUT OF STOCK";
					}else{
						$getproduct = $product->getproduct($prod);
						print_r($getproduct[0]['qty'] );print_r($cart['pcs'] );
						if($getproduct[0]['qty'] == $cart['pcs']||$getproduct[0]['qty'] > $cart['pcs']){
							echo "added 2";
							$addcart = $cartfunc->addcart($getproduct,$prod,$cart);
							$getcart = $cartfunc->getcart();
						}else{$_SESSION['failed'] = "You Don't Have Enough Stocks";}
					}
				}
			}else{$_SESSION['failed'] = "Please Input Quantity.";}
		}


?>