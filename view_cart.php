<?php
include('db_session.php');
setlocale(LC_MONETARY,"en_US"); // US national format (see : http://php.net/money_format)
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Review Your Cart Before Buying</title>

    <link rel="icon" href="images/fav-icon.png" />
    
    <link href="Bazzar-CSS/bootstrap.min.css" rel="stylesheet"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/owl.carousel.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/owl.theme.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet" type="text/css"/>
    
    <script src="Bazzar-JQuery/jquery.min.js"></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
    <script src="Bazzar-JQuery/owl.carousel.min.js"></script>
    <script src="Bazzar-JQuery/isotope-filter-docs.min.js"></script>
    <script src="Bazzar-JQuery/custom-js.js"></script>
</head>
<body>
<?php include('header.php'); ?>
<h3 style="text-align:center">Review Your Cart Before Buying</h3>
<?php
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){
	$total 			= 0;
	$list_tax 		= '';
	$cart_box 		= '<ul class="view-cart">';

	foreach($_SESSION["products"] as $product){ //Print each item, quantity and price.
		$product_name = $product["product_name"];
		$product_qty = $product["product_qty"];
		$product_price = $product["product_price"];
		$product_code = $product["product_code"];
		$product_color = $product["product_color"];
		$product_size = $product["product_size"];
		
		$item_price 	= sprintf("%01.2f",($product_price * $product_qty));  // price x qty = total item price
		
		$cart_box 		.=  "<li> $product_code &ndash;  $product_name (Qty : $product_qty | $product_color | $product_size) <span> $currency. $item_price </span></li>";
		
		$subtotal 		= ($product_price * $product_qty); //Multiply item quantity * price
		$total 			= ($total + $subtotal); //Add up to total price
	}
	
	$grand_total = $total + $shipping_cost; //grand total
	
	foreach($taxes as $key => $value){ //list and calculate all taxes in array
			$tax_amount 	= round($total * ($value / 100));
			$tax_item[$key] = $tax_amount;
			$grand_total 	= $grand_total + $tax_amount; 
	}
	
	foreach($tax_item as $key => $value){ //taxes List
		$list_tax .= $key. ' '. $currency. sprintf("%01.2f", $value).'<br />';
	}
	
	$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	
	//Print Shipping, VAT and Total
	$cart_box .= "<li class=\"view-cart-total\">$shipping_cost  $list_tax <hr>Payable Amount : $currency ".sprintf("%01.2f", $grand_total)."</li>";
	$cart_box .= "</ul>";
	
	echo $cart_box;
}else{
	echo "Your Cart is empty";
}
?>
<?php include('footer.php'); ?>
</body>
</html>