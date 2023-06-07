<?php

	function addToCart($db_handle){
		if (!empty($_POST["quantity"])) {
			$productCode = $_GET["code"];
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $productCode . "'");
			
			if (!empty($productByCode)) {
				$product = $productByCode[0];
				$itemArray = array(
					$product["code"] => array(
						'name' => $product["name"],
						'code' => $product["code"],
						'quantity' => $_POST["quantity"],
						'price' => $product["price"],
						'image' => $product["image"]
					)
				);

				if (!empty($_SESSION["cart_item"])) {
					if (array_key_exists($product["code"], $_SESSION["cart_item"])) {
						$_SESSION["cart_item"][$product["code"]]["quantity"] += $_POST["quantity"];
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		}
	}

	function removeFromCart(){
		if (!empty($_SESSION["cart_item"])) {
			$productCode = $_GET["code"];
			if (array_key_exists($productCode, $_SESSION["cart_item"])) {
				unset($_SESSION["cart_item"][$productCode]);
			}
	
			if (empty($_SESSION["cart_item"])) {
				unset($_SESSION["cart_item"]);
			}
		}
	}

	function emptyCart(){
		unset($_SESSION["cart_item"]);
	}

	function buy(){

		if (!empty($_SESSION["cart_item"])) {
			$products = $_SESSION["cart_item"];
			
			// Initialize the order message string
			$orderMessage = "Hello Luca Loaves.\n Order Summary:\n";
			
			// Iterate over the products and add their details to the order message
			foreach ($products as $product) {
				$name = $product["name"];
				$quantity = $product["quantity"];
				$price = $product["price"];
				
				$subtotal = $quantity * $price;
				
				$orderMessage .= "- $name (Quantity: $quantity, Price: $price, Subtotal: $subtotal)\n";
			}
			
			$encodedOrderSummary = urlencode($orderMessage);
			echo "<script type='text/javascript'>
					var encodedOrderSummary = '" . $encodedOrderSummary . "';
					var whatsappURL = 'https://wa.me/610290001234?text=' + encodedOrderSummary;
					window.open(whatsappURL, '_blank');
				</script>";
		}
	}
?>