<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once("init.php");
	require_once("cart_handling.php");

	if (!empty($_GET["action"])) {
		switch ($_GET["action"]) {
			case "add":
				addToCart($db_handle);
				break;
			case "remove":
				removeFromCart();
				break;
			case "empty":
				emptyCart();
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	
		<link rel="stylesheet" type="text/css" href="css/style.css">
		
		<title>Luca Loaves Bakery</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		<link
			rel="stylesheet"
			type="text/css"
			href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/bold/style.css"/>
	
	</head>
	<body>

	<header>
		<nav class="navbar navbar-expand-sm fixed-top navbar-dark bg-dark">
			<a class="navbar-brand mx-5" href="./#Home">
				<img src="assets/logo-np-bg.png" alt="logo" style="width:12%;">
			</a>
			
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link luca-text" aria-current="page" href="./#Home">Home</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link luca-text" href="./#Gallery">Gallery</a>
					</li>
					<li class="nav-item">
						<a class="nav-link luca-text" href="shop.php">Shop</a>
					</li>
					<li class="nav-item">
						<a class="nav-link luca-text" href="./#About">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link luca-text" href="#Contact">Contact</a>
					</li>
				</ul>
			</div>
			<!-- <div class="d-flex mx-5">
				<a href="#" class="no-decoration">
					<span class="badge text-bg-secondary "style="font-size: 1.0em;">4</span>
					<i class="ph-bold ph-shopping-cart-simple" style="color: red; font-size: 1.5em;"></i>
				</a>
			</div> -->
		</nav>
	</header>

	<main>
		<br/>
		<br/>
		<div class="container-sm">
			<div class="row mt-5 txt-heading">
				<div class="col">
					<h1>Your Order</h1>
				</div>
				<?php
					if(isset($_SESSION["cart_item"])){
						$total_quantity = 0;
						$total_price = 0;
				?>
				<div class="col">
					<a id="btnEmpty" href="shop.php?action=empty">Empty Cart</a>
				</div>
				<?php
					}
				?>
			</div>
			
			<?php
				if(isset($_SESSION["cart_item"])){
					$total_quantity = 0;
					$total_price = 0;
			?>	
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Name</th>
						<th style="text-align:left;">Code</th>
						<th style="text-align:right;" width="5%">Quantity</th>
						<th style="text-align:right;" width="10%">Unit Price</th>
						<th style="text-align:right;" width="10%">Price</th>
						<th style="text-align:center;" width="5%">Remove</th>
					</tr>
					<?php		
						foreach ($_SESSION["cart_item"] as $item){
							$item_price = $item["quantity"]*$item["price"];
					?>
					<tr>
						<td>
							<img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?>
						</td>
						<td>
							<?php echo $item["code"]; ?>
						</td>
						<td style="text-align:right;">
							<?php echo $item["quantity"]; ?>
						</td>
						<td  style="text-align:right;">
							<?php echo "$ ".$item["price"]; ?></td>
						<td  style="text-align:right;">
							<?php echo "$ ". number_format($item_price,2); ?>
						</td>
						<td style="text-align:center;">
							<a class="no-decoration" href="shop.php?action=remove&code=<?php echo $item["code"]; ?>">
								<i class="ph-bold ph-trash" style="color: red;"></i>
							</a>
						</td>
					</tr>
					<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"]*$item["quantity"]);
					}
					?>

					<tr>
						<td colspan="2" align="right">Total:</td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2">
							<strong><?php echo "$ ".number_format($total_price, 2); ?></strong>
						</td>
					</tr>
				</tbody>
			</table>		
			<?php
				} else {
			?>
			<div class="no-records"><i><b>Your Cart is Empty</b></i></div>
			<?php 
				}
			?>

			<h3>Products</h3>

			<div class="row">
				<?php
					$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
					if (!empty($product_array)) { 
						foreach($product_array as $key=>$value){
				?>
				<div class="col-md-4">
					<form method="post" action="shop.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

						<div class="card mb-4">
							<img src="<?php echo $product_array[$key]["image"]; ?>" class="card-img-top" alt="<?php echo $product_array[$key]["image"]; ?>">
							<div class="card-body">
								<h5 class="card-title"><?php echo $product_array[$key]["name"]; ?></h5>
								<p class="card-text"><?php echo "$".$product_array[$key]["price"]; ?></p>
								<input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" />
							</div>
						</div>
					</form>
				</div>
				<?php
						}
					}
				?>
			</div>
		</div>
	</main>

	<footer>
		<div class="bg-dark mt-5">
			<div class="footer container-sm" style="text-align: center;">
			<br/>
			<a name="Contact" href="#">
				<img src="assets/logo-np-bg.png" alt="logo" style="width:12%;">
			</a>
			<br/>
			<div class="mt-4">
				<h5 style="color: white;">
				300 Pits Street, Sydney <br>
				Tel. (Bakery) 02 9180 2221 <br>
				Mob. 041 231 231 <br>
				Fax 02 9230 1234 <br>
				<a href="mailto:info@lucaloaves.com.au" style="color: white">Email: info@LLbakery.com.au</a> <br>
				<a href="http://www.lucaloaves.com.au" style="color: white">Web: http://www.lucaloaves.com.au</a> <br>
				</h5>
				<h5 style="text-align: center">
					@2021 Luca Loaves Bakery, All Rights Reserved
				</h5>
			</div>
			</div>
		</div>
	</footer>
	
</body>
</html>