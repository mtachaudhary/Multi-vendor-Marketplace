<?php
include('db_session.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php if(isset($_GET['main_cat_id']) || isset($_GET['cat_id']) || isset($_GET['sub_cat_id'])){echo'Categories';} else{ echo'Home';} ?> | BAZzAR</title>
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
    <script>
		$(document).ready(function(){	
				$(".form-item").submit(function(e){
					var form_data = $(this).serialize();
					//alert(form_data);
					var button_content = $(this).find('button[type=submit]');
					button_content.html('Adding...'); //Loading button text 
		
					$.ajax({ //make ajax request to cart_process.php
						url: "cart_process.php",
						type: "POST",
						dataType:"json", //expect json value from server
						data: form_data
					}).done(function(data){ //on Ajax success
					//alert(data.items);
						$("#cart-info").html(data.items); //total items in cart-info element
						button_content.html('Add to Cart'); //reset button text to original text
						alert("Item added to Cart!"); //alert user
						if($(".shopping-content").css("display") == "block"){ //if cart box is still visible
							$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
						}
					}).error(function(data){alert(data.items);});
					e.preventDefault();
				});
		
			//Show Items in Cart
			$( ".cart-box").click(function(e) { //when user clicks on cart box
				e.preventDefault(); 
				$(".shopping-content").fadeIn(); //display cart box
				$("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
				$("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
			});
			
			//Close Cart
			$( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
				e.preventDefault(); 
				$(".shopping-content").fadeOut(); //close cart-box
			});
			
			//Remove items from cart
			$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
				e.preventDefault(); 
				var pcode = $(this).attr("data-code"); //get product code
				$(this).parent().fadeOut(); //remove item element from box
				$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
					$("#cart-info").html(data.items); //update Item count in cart-info
					$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
				});
			});
		
		});
	</script>
    
</head>

<body>
	<div class="container-fluid nopadding">
		<!--Start Header-->
		<?php
            include('header.php');
        ?>
        <!--END Footer-->
    </div>
    
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<?php
if(isset($_GET['main_cat_id']))
{
	$query = "SELECT * FROM product WHERE main_cat_id='".$_GET['main_cat_id']."'";
	$q_exe = mysql_query($query);
	$q_2 = "SELECT * FROM main_category WHERE id='".$_GET['main_cat_id']."'";
	$q2_exe = mysql_query($q_2);
	if($q2_exe)
	{
		$data = mysql_fetch_array($q2_exe);
	}
	?>
		<div class="container">
        	<div class="row">
            
            	<!--Start Left Column-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                
                	<!--Start Categories-->
                    <div class="men-categories">
                    	<h3>Categories</h3>
                        <ul class="list-unstyled main-categories">
                        	<?php
							$query_cat = "SELECT * FROM category WHERE main_cat_id='".$_GET['main_cat_id']."'";
							$query_exe = mysql_query($query_cat);
							if($query_exe)
							{
								$i_acc=1;
								while($all_cat=mysql_fetch_array($query_exe))
								{?>
									<li class="show-drop row no-margin">
                                        <a href="index.php?cat_id=<?php echo $all_cat["id"]; ?>" class="col-sm-10">
                                        	<i class="fa fa-angle-right"></i><?php echo $all_cat["cat_name"]; ?>
                                        </a>
                                        <button type="button" class="btn btn-default col-sm-2 sp-cat">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <ul class="list-unstyled submenu show-submenu">
                                            <?php
											$query_subcat = "SELECT * FROM sub_category WHERE cat_id='".$all_cat["id"]."'";
											$query_subexe =  mysql_query($query_subcat);
											if($query_subexe)
											{
												while($all_subcat=mysql_fetch_array($query_subexe))
												{?>
													<li><a href="index.php?sub_cat_id=<?php echo $all_subcat["id"]; ?>"><?php echo $all_subcat["sub_cat_name"]; ?></a></li>
												<?php
                                                }
											}
											?>
                                        </ul>
                                    </li>
								<?php
                                $i_acc++;
								}
							}
							?>
                        </ul>
                    </div>
                    <!--END Categories-->
                    
                    <!--Start Advanced Search-->
                    <div class="men-categories">
                    	<h3>Advanced Search</h3>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        
                        	<!--Start Filter by price-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingOne">
                                	<h4 class="panel-title">
                                    	<a href="#collapseOne" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">
                                        	Filter by price
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                	<div class="panel-body">
                                    	<form oninput="x.value=parseInt(range.value)">
                                        	<strong style="float:left">Price:</strong>
                                            <span style="float:left; margin-left:5px; color:#df2e1b;">$</span>
                                            <output name="x" for="range-slider" style="float:left; margin-top:-5px; color:#df2e1b;">0</output>
                                            <input type="range" min="0" class="form-control" max="1000" value="0" id="range-slider" name="range" />
                                            <span style="float:left">$0</span>
                                            <span style="float:right">$1000</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by price-->
                            
                            <!--Start Filter by categories-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingTwo">
                                	<h4 class="panel-title">
                                    	<a href="#collapseTwo" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwo">
                                        	Filter by categories
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <?php
											$q_category = "SELECT * FROM category WHERE main_cat_id='".$_GET['main_cat_id']."'";
											$q_categoryexe = mysql_query($q_category);
											if($q_categoryexe)
											{
												$j_cat=1;
												while($data_allcat=mysql_fetch_array($q_categoryexe))
												{?>
													<li>
                                                        <input id="cat<?php echo $j_cat; ?>" type="checkbox" value="<?php echo $data_allcat['id']; ?>"/>
                                                        <label for="cat<?php echo $j_cat; ?>"><?php echo $data_allcat['cat_name']; ?></label>
                                                    </li>
												<?php
												$j_cat++;
                                                }
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by categories-->
                            
                            <!--Start Filter by manufacturers-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingThree">
                                	<h4 class="panel-title">
                                    	<a href="#collapseThree" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree">
                                        	Filter by manufacturers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <?php
											$query_brand = "SELECT * FROM brand WHERE main_cat_id='".$_GET['main_cat_id']."'";
											$query_brandexe = mysql_query($query_brand);
											if($query_brandexe)
											{
												$i_brand=1;
												while($all_brand=mysql_fetch_array($query_brandexe))
												{?>
													<li>
                                                        <input id="ch<?php echo $i_brand; ?>" type="checkbox" value="<?php echo $all_brand['id']; ?>"/>
                                                        <label for="ch<?php echo $i_brand; ?>"><?php echo $all_brand['brand_name']; ?></label>
                                                    </li>
												<?php
												$i_brand++;
                                                }
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by manufacturers-->
                            
                            <!--Start Filter by options-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingFour">
                                	<h4 class="panel-title">
                                    	<a href="#collapseFour" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFour">
                                        	Filter by options
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <strong>Size</strong>
                                            <li>
                                                <input id="ch-Small" type="checkbox" value="Small"/>
                                                <label for="ch-Small">Small</label>
                                            </li>
                                            <li>
                                                <input id="ch-Medium" type="checkbox" value="Medium"/>
                                                <label for="ch-Medium">Medium</label>
                                            </li>
                                            <li>
                                                <input id="ch-Large" type="checkbox" value="Large"/>
                                                <label for="ch-Large">Large</label>
                                            </li>
                                            <strong>Color</strong>
                                            <li>
                                                <input id="ch-Red" type="checkbox" value="Red"/>
                                                <label for="ch-Red">Red</label>
                                            </li>
                                            <li>
                                                <input id="ch-White" type="checkbox" value="White"/>
                                                <label for="ch-White">White</label>
                                            </li>
                                            <li>
                                                <input id="ch-Blue" type="checkbox" value="Blue"/>
                                                <label for="ch-Blue">Blue</label>
                                            </li>
                                            <li>
                                                <input id="ch-Green" type="checkbox" value="Green"/>
                                                <label for="ch-Green">Green</label>
                                            </li>
                                            <li>
                                                <input id="ch-Black" type="checkbox" value="Black"/>
                                                <label for="ch-Black">Black</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by options-->
                            
                        </div>
                        <form>
                            <input type="search" class="form-control" placeholder="Filter by keyword..." />
                            <div style="text-align:right">
                                <button type="submit" class="site-btn" name="submit">Search</button>
                                <button type="reset" class="black-btn" name="submit">Reset all</button>
                            </div>
                        </form>
                    </div>
                    <!--END Advanced Search-->
                    
                    <!--Start Top Sellers-->
                    <div class="men-categories">
                    	<h3>Top sellers</h3>
                        <?php
							include('top-sellers.php');
						?>
                    </div>
                    <!--END Top Sellers-->
                    
                </div>
                <!--END Left Column-->
                
                <!--Start Right Column-->
                <div class="col-md-9 col-sm-8 col-xs-12" style="padding-top:20px">
                
                	<!--Start MEN's Banner-->
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                        	<img src="images/top-banner-1.jpg" width="100%"/>
                        </div>
                    </div>
                    <!--END MEN's Banner-->
                    
                    <!--Start MEN product sorting-->
                    <div class="row" id="lst">
                    	<div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                        	<h3><?php echo $data['main_cat_name']; ?></h3>
                        </div>
                    </div>
                    <div class="row">
                    	<!--Start Grid-List Buttons-->
                    	<div class="col-md-3 col-sm-3 col-xs-12">
                        	<div class="btn-group grid-list-btn">
                            	<a href="index.php?main_cat_id=<?php echo $_GET['main_cat_id']; ?>#lst" class="btn grid <?php if(!isset($_GET['view_fashion'])){ echo "active";} ?>" role="grid">
                                	<i class="fa fa-th-large"></i>
                                </a>
                                <a href="index.php?main_cat_id=<?php echo $_GET['main_cat_id']; ?>&view_fashion=list#lst" class="btn list <?php if(isset($_GET['view_fashion'])){ echo "active";} ?>" role="list">
                                	<i class="fa fa-th-list"></i>
                                </a>
                            </div>
                        </div>
                        <!--END Grid-List Buttons-->
                        
                        <!--Start Sort-Show menu-->
                    	<div class="col-md-9 col-sm-9 col-xs-12">
                        	<form class="form-inline">
                                <div class="sort-show">
                                    <label>Show:</label>
                                    <select class="form-control">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>30</option>
                                        <option>50</option>
                                        <option>100</option>
                                        <option selected="selected">All</option>
                                    </select>
                                </div>
                                <div class="sort-show">
                                    <label>Sort By:</label>
                                    <select class="form-control">
                                        <option>Product Name (A-Z)</option>
                                        <option>Product Name (Z-A)</option>
                                        <option>Product Model (A-Z)</option>
                                        <option>Product Model (Z-A)</option>
                                        <option selected="selected">Product Price (Low > High)</option>
                                        <option>Product Price (High > Low)</option>
                                        <option>Product Quantity (Low > High)</option>
                                        <option>Product Quantity (High > Low)</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <!--END Sort-Show menu-->
                        
                    </div>
                    <!--END MEN product sorting-->
                    
                    <!--Start Products display-->
                    <?php 
					if(isset($_GET['view_fashion']) && $_GET['view_fashion']=='list')
					{
					?>
                    <!--Start List Display-->
                    <div class="outer-row">
                        <?php
						while($rec=mysql_fetch_array($q_exe))
						{
						?>
                        <div class="row">
                        	<div class="col-md-4 col-sm-12 col-xs-12 list-img">
                            	<a href="#"><img src="vendor/images/product_pics/item_pic(<?php echo $rec['id'] ?>).<?php echo $rec['product_image']; ?>"/></a>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12 list-display f-prod">
                            	<h4><a href="#"><?php echo $rec['product_name']; ?></a></h4>
                                <p><?php echo $rec['product_description'] ?></p>
                                <p><img src="images/stars-5.png" width="80px"/></p>
                                <p><span class="price">$<?php echo $rec['sale_price']; ?></span></p>
                                <form class="form-item">
                                    <p>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" placeholder="QTY"/>
                                        </div>
                                        <diV class="add-to-cart-btn">
                                            <input name="product_code" type="hidden" value="<?php echo $rec["product_code"]; ?>">
                                            <button type="submit" class="btn btn-default"><span>Add to cart</span></button>
                                        </diV>
                                    </p>
                                    <p class="three-btn">
                                        <a href="#" class="btn btn-default"><i class="fa fa-heart"></i>Add to Wish List</a>
                                        <a href="compare.php?compare_id=<?php echo $rec['id'] ?>" class="btn btn-default"><i class="fa fa-retweet"></i>Add to Compare</a>
                                        <a href="product-detail.php?prodimg=<?php echo $rec['id'] ?>" class="btn btn-default">Details<i class="fa fa-arrow-right"></i></a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
						}
						?>
                    </div>
                    <!--END List Display-->
                    <?php
					}
					else
					{
					?>
                    <!--Start Grid Display-->
					<div class="outer-row prod-display">
                    	<div class="row f-prod">
                        <?php
						while($rec=mysql_fetch_array($q_exe))
						{
						?>
                            <div class="col-md-4 col-sm-6 col-xs-12 f-div">
                                <form class="form-item">
                                    <div>
                                        <img src="vendor/images/product_pics/item_pic(<?php echo $rec['id'] ?>).<?php echo $rec['product_image']; ?>" width="260px" height="340px"/>
                                        <div class="overlay-product">
                                            <a href="#"><i class="fa fa-heart fa-2x" title="Add to Wish List"></i></a>
                                            <a href="compare.php?compare_id=<?php echo $rec['id'] ?>"><i class="fa fa-retweet fa-2x" title="Add to Compare"></i></a>
                                            <a href="product-detail.php?prodimg=<?php echo $rec['id'] ?>"><i class="fa fa-arrow-right fa-2x" title="Read more"></i></a>
                                            <div class="add-to-cart-btn">
                                                <input name="product_code" type="hidden" value="<?php echo $rec["product_code"]; ?>">
                                                <input name="product_color" type="hidden" value="Red">
                                                <input name="product_qty" type="hidden" value="1">
                                                <input name="product_size" type="hidden" value="M">
                                                <button type="submit" class="btn btn-default">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <h4><a href="#"><?php echo $rec['product_name']; ?></a></h4>
                                    <div class="row rating">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <img src="images/stars-5.png" width="100%"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span>$<?php echo $rec['sale_price']; ?></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        <?php 
						}
						?>
                        </div>
                    </div>
                    <!--END Grid Display-->
					<?php
					}
                    ?>
                    <!--END Products display-->
                    
                </div>
                <!--END Right Column-->
                
            </div>
        </div>
        <?php
}

else if(isset($_GET['cat_id']))
{
	$query4prod = "SELECT * FROM product WHERE cat_id='".$_GET['cat_id']."'";
	$query4prod_exe = mysql_query($query4prod);
	$q4cat = "SELECT * FROM category WHERE id='".$_GET['cat_id']."'";
	$q4cat_exe = mysql_query($q4cat);
	if($q4cat_exe)
	{
		$data4cat = mysql_fetch_array($q4cat_exe);
	}
	?>
		<div class="container">
        	<div class="row">
            
            	<!--Start Left Column-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                
                	<!--Start Categories-->
                    <div class="men-categories">
                    	<h3>Sub-Categories</h3>
                        <ul class="list-unstyled main-categories">
                        	<?php
							$query_cat = "SELECT * FROM sub_category WHERE cat_id='".$_GET['cat_id']."'";
							$query_exe = mysql_query($query_cat);
							if($query_exe)
							{
								while($all_cat=mysql_fetch_array($query_exe))
								{?>
									<li class="show-drop">
                                        <a href="index.php?sub_cat_id=<?php echo $all_cat["id"]; ?>">
                                        	<i class="fa fa-angle-right"></i><?php echo $all_cat["sub_cat_name"]; ?>
                                        </a>
                                    </li>
								<?php
								}
							}
							?>
                        </ul>
                    </div>
                    <!--END Categories-->
                    
                    <!--Start Advanced Search-->
                    <div class="men-categories">
                    	<h3>Advanced Search</h3>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        
                        	<!--Start Filter by price-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingOne">
                                	<h4 class="panel-title">
                                    	<a href="#collapseOne" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">
                                        	Filter by price
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                	<div class="panel-body">
                                    	<form oninput="x.value=parseInt(range.value)">
                                        	<strong style="float:left">Price:</strong>
                                            <span style="float:left; margin-left:5px; color:#df2e1b;">$</span>
                                            <output name="x" for="range-slider" style="float:left; margin-top:-5px; color:#df2e1b;">0</output>
                                            <input type="range" min="0" class="form-control" max="1000" value="0" id="range-slider" name="range" />
                                            <span style="float:left">$0</span>
                                            <span style="float:right">$1000</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by price-->
                            
                            <!--Start Filter by categories-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingTwo">
                                	<h4 class="panel-title">
                                    	<a href="#collapseTwo" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwo">
                                        	Filter by categories
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <?php
											$q_category = "SELECT * FROM sub_category WHERE cat_id='".$_GET['cat_id']."'";
											$q_categoryexe = mysql_query($q_category);
											if($q_categoryexe)
											{
												$j_cat=1;
												while($data_allcat=mysql_fetch_array($q_categoryexe))
												{?>
													<li>
                                                        <input id="cat<?php echo $j_cat; ?>" type="checkbox" value="<?php echo $data_allcat['id']; ?>"/>
                                                        <label for="cat<?php echo $j_cat; ?>"><?php echo $data_allcat['sub_cat_name']; ?></label>
                                                    </li>
												<?php
												$j_cat++;
                                                }
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by categories-->
                            
                            <!--Start Filter by manufacturers-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingThree">
                                	<h4 class="panel-title">
                                    	<a href="#collapseThree" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree">
                                        	Filter by manufacturers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <?php
											$query_brand = "SELECT * FROM brand WHERE cat_id='".$_GET['cat_id']."'";
											$query_brandexe = mysql_query($query_brand);
											if($query_brandexe)
											{
												$i_brand=1;
												while($all_brand=mysql_fetch_array($query_brandexe))
												{?>
													<li>
                                                        <input id="ch<?php echo $i_brand; ?>" type="checkbox" value="<?php echo $all_brand['id']; ?>"/>
                                                        <label for="ch<?php echo $i_brand; ?>"><?php echo $all_brand['brand_name']; ?></label>
                                                    </li>
												<?php
												$i_brand++;
                                                }
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by manufacturers-->
                            
                            <!--Start Filter by options-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingFour">
                                	<h4 class="panel-title">
                                    	<a href="#collapseFour" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFour">
                                        	Filter by options
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <strong>Size</strong>
                                            <li>
                                                <input id="ch-Small" type="checkbox" value="Small"/>
                                                <label for="ch-Small">Small</label>
                                            </li>
                                            <li>
                                                <input id="ch-Medium" type="checkbox" value="Medium"/>
                                                <label for="ch-Medium">Medium</label>
                                            </li>
                                            <li>
                                                <input id="ch-Large" type="checkbox" value="Large"/>
                                                <label for="ch-Large">Large</label>
                                            </li>
                                            <strong>Color</strong>
                                            <li>
                                                <input id="ch-Red" type="checkbox" value="Red"/>
                                                <label for="ch-Red">Red</label>
                                            </li>
                                            <li>
                                                <input id="ch-White" type="checkbox" value="White"/>
                                                <label for="ch-White">White</label>
                                            </li>
                                            <li>
                                                <input id="ch-Blue" type="checkbox" value="Blue"/>
                                                <label for="ch-Blue">Blue</label>
                                            </li>
                                            <li>
                                                <input id="ch-Green" type="checkbox" value="Green"/>
                                                <label for="ch-Green">Green</label>
                                            </li>
                                            <li>
                                                <input id="ch-Black" type="checkbox" value="Black"/>
                                                <label for="ch-Black">Black</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by options-->
                            
                        </div>
                        <form>
                            <input type="search" class="form-control" placeholder="Filter by keyword..." />
                            <div style="text-align:right">
                                <button type="submit" class="site-btn" name="submit">Search</button>
                                <button type="reset" class="black-btn" name="submit">Reset all</button>
                            </div>
                        </form>
                    </div>
                    <!--END Advanced Search-->
                    
                    <!--Start Top Sellers-->
                    <div class="men-categories">
                    	<h3>Top sellers</h3>
                        <?php
							include('top-sellers.php');
						?>
                    </div>
                    <!--END Top Sellers-->
                    
                </div>
                <!--END Left Column-->
                
                <!--Start Right Column-->
                <div class="col-md-9 col-sm-8 col-xs-12" style="padding-top:20px">
                
                	<!--Start MEN's Banner-->
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                        	<img src="images/top-banner-1.jpg" width="100%"/>
                        </div>
                    </div>
                    <!--END MEN's Banner-->
                    
                    <!--Start MEN product sorting-->
                    <?php
					$q4maincat = "SELECT * FROM main_category WHERE id='".$data4cat['main_cat_id']."'";
					$q4maincat_exe = mysql_query($q4maincat);
					if($q4maincat_exe)
					{
						$data4maincat = mysql_fetch_array($q4maincat_exe);
					}
					?>
                    <div class="row" id="lst">
                    	<div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                        	<h3>
								<?php echo $data4maincat['main_cat_name']; ?>
                                <i class="fa fa-angle-double-right" style="margin:0 10px; color:#DF2E1B;"></i>
								<?php echo $data4cat['cat_name']; ?>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                    	<!--Start Grid-List Buttons-->
                    	<div class="col-md-3 col-sm-3 col-xs-12">
                        	<div class="btn-group grid-list-btn">
                            	<a href="index.php?cat_id=<?php echo $_GET['cat_id']; ?>#lst" class="btn grid <?php if(!isset($_GET['view_fashion'])){ echo "active";} ?>" role="grid">
                                	<i class="fa fa-th-large"></i>
                                </a>
                                <a href="index.php?cat_id=<?php echo $_GET['cat_id']; ?>&view_fashion=list#lst" class="btn list <?php if(isset($_GET['view_fashion'])){ echo "active";} ?>" role="list">
                                	<i class="fa fa-th-list"></i>
                                </a>
                            </div>
                        </div>
                        <!--END Grid-List Buttons-->
                        
                        <!--Start Sort-Show menu-->
                    	<div class="col-md-9 col-sm-9 col-xs-12">
                        	<form class="form-inline">
                                <div class="sort-show">
                                    <label>Show:</label>
                                    <select class="form-control">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>30</option>
                                        <option>50</option>
                                        <option>100</option>
                                        <option selected="selected">All</option>
                                    </select>
                                </div>
                                <div class="sort-show">
                                    <label>Sort By:</label>
                                    <select class="form-control">
                                        <option>Product Name (A-Z)</option>
                                        <option>Product Name (Z-A)</option>
                                        <option>Product Model (A-Z)</option>
                                        <option>Product Model (Z-A)</option>
                                        <option selected="selected">Product Price (Low > High)</option>
                                        <option>Product Price (High > Low)</option>
                                        <option>Product Quantity (Low > High)</option>
                                        <option>Product Quantity (High > Low)</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <!--END Sort-Show menu-->
                        
                    </div>
                    <!--END MEN product sorting-->
                    
                    <!--Start Products display-->
                    <?php 
					if(isset($_GET['view_fashion']) && $_GET['view_fashion']=='list')
					{
					?>
                    <!--Start List Display-->
                    <div class="outer-row">
                        <?php
						while($rec4prod=mysql_fetch_array($query4prod_exe))
						{
						?>
                        <div class="row">
                        	<div class="col-md-4 col-sm-12 col-xs-12 list-img">
                            	<a href="#"><img src="vendor/images/product_pics/item_pic(<?php echo $rec4prod['id'] ?>).<?php echo $rec4prod['product_image']; ?>"/></a>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12 list-display f-prod">
                            	<h4><a href="#"><?php echo $rec4prod['product_name']; ?></a></h4>
                                <p><?php echo $rec4prod['product_description'] ?></p>
                                <p><img src="images/stars-5.png" width="80px"/></p>
                                <p><span class="price">$<?php echo $rec4prod['sale_price']; ?></span></p>
                                <form class="form-item">
                                    <p>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" placeholder="QTY"/>
                                        </div>
                                        <diV class="add-to-cart-btn">
                                            <input name="product_code" type="hidden" value="<?php echo $rec4prod["product_code"]; ?>">
                                            <button type="submit" class="btn btn-default"><span>Add to cart</span></button>
                                        </diV>
                                    </p>
                                    <p class="three-btn">
                                        <a href="#" class="btn btn-default"><i class="fa fa-heart"></i>Add to Wish List</a>
                                        <a href="compare.php?compare_id=<?php echo $rec4prod['id'] ?>" class="btn btn-default"><i class="fa fa-retweet"></i>Add to Compare</a>
                                        <a href="product-detail.php?prodimg=<?php echo $rec4prod['id'] ?>" class="btn btn-default">Details<i class="fa fa-arrow-right"></i></a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
						}
						?>
                    </div>
                    <!--END List Display-->
                    <?php
					}
					else
					{
					?>
                    <!--Start Grid Display-->
					<div class="outer-row prod-display">
                    	<div class="row f-prod">
                        <?php
						while($rec4prod=mysql_fetch_array($query4prod_exe))
						{
						?>
                            <div class="col-md-4 col-sm-6 col-xs-12 f-div">
                                <form class="form-item">
                                    <div>
                                        <img src="vendor/images/product_pics/item_pic(<?php echo $rec4prod['id'] ?>).<?php echo $rec4prod['product_image']; ?>" width="260px" height="340px"/>
                                        <div class="overlay-product">
                                            <a href="#"><i class="fa fa-heart fa-2x" title="Add to Wish List"></i></a>
                                            <a href="compare.php?compare_id=<?php echo $rec4prod['id'] ?>"><i class="fa fa-retweet fa-2x" title="Add to Compare"></i></a>
                                            <a href="product-detail.php?prodimg=<?php echo $rec4prod['id'] ?>"><i class="fa fa-arrow-right fa-2x" title="Read more"></i></a>
                                            <div class="add-to-cart-btn">
                                                <input name="product_code" type="hidden" value="<?php echo $rec4prod["product_code"]; ?>">
                                                <input name="product_color" type="hidden" value="Red">
                                                <input name="product_qty" type="hidden" value="1">
                                                <input name="product_size" type="hidden" value="M">
                                                <button type="submit" class="btn btn-default">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <h4><a href="#"><?php echo $rec4prod['product_name']; ?></a></h4>
                                    <div class="row rating">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <img src="images/stars-5.png" width="100%"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span>$<?php echo $rec4prod['sale_price']; ?></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        <?php 
						}
						?>
                        </div>
                    </div>
                    <!--END Grid Display-->
					<?php
					}
                    ?>
                    <!--END Products display-->
                    
                </div>
                <!--END Right Column-->
                
            </div>
        </div>
        <?php
}

else if(isset($_GET['sub_cat_id']))
{
	$query4prod = "SELECT * FROM product WHERE sub_cat_id='".$_GET['sub_cat_id']."'";
	$query4prod_exe = mysql_query($query4prod);
	$q4subcat = "SELECT * FROM sub_category WHERE id='".$_GET['sub_cat_id']."'";
	$q4subcat_exe = mysql_query($q4subcat);
	if($q4subcat_exe)
	{
		$data4subcat = mysql_fetch_array($q4subcat_exe);
	}
	?>
		<div class="container">
        	<div class="row">
            
            	<!--Start Left Column-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                
                	<!--Start Advanced Search-->
                    <div class="men-categories">
                    	<h3>Advanced Search</h3>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        
                        	<!--Start Filter by price-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingOne">
                                	<h4 class="panel-title">
                                    	<a href="#collapseOne" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">
                                        	Filter by price
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                	<div class="panel-body">
                                    	<form oninput="x.value=parseInt(range.value)">
                                        	<strong style="float:left">Price:</strong>
                                            <span style="float:left; margin-left:5px; color:#df2e1b;">$</span>
                                            <output name="x" for="range-slider" style="float:left; margin-top:-5px; color:#df2e1b;">0</output>
                                            <input type="range" min="0" class="form-control" max="1000" value="0" id="range-slider" name="range" />
                                            <span style="float:left">$0</span>
                                            <span style="float:right">$1000</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by price-->
                            
                            <!--Start Filter by manufacturers-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingThree">
                                	<h4 class="panel-title">
                                    	<a href="#collapseThree" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree">
                                        	Filter by manufacturers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <?php
											$query_brand = "SELECT * FROM brand WHERE sub_cat_id='".$_GET['sub_cat_id']."'";
											$query_brandexe = mysql_query($query_brand);
											if($query_brandexe)
											{
												$i_brand=1;
												while($all_brand=mysql_fetch_array($query_brandexe))
												{?>
													<li>
                                                        <input id="ch<?php echo $i_brand; ?>" type="checkbox" value="<?php echo $all_brand['id']; ?>"/>
                                                        <label for="ch<?php echo $i_brand; ?>"><?php echo $all_brand['brand_name']; ?></label>
                                                    </li>
												<?php
												$i_brand++;
                                                }
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by manufacturers-->
                            
                            <!--Start Filter by options-->
                            <div class="panel panel-default">
                            	<div class="panel-heading" role="tab" id="headingFour">
                                	<h4 class="panel-title">
                                    	<a href="#collapseFour" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFour">
                                        	Filter by options
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                	<div class="panel-body">
                                    	<ul class="list-unstyled">
                                            <strong>Size</strong>
                                            <li>
                                                <input id="ch-Small" type="checkbox" value="Small"/>
                                                <label for="ch-Small">Small</label>
                                            </li>
                                            <li>
                                                <input id="ch-Medium" type="checkbox" value="Medium"/>
                                                <label for="ch-Medium">Medium</label>
                                            </li>
                                            <li>
                                                <input id="ch-Large" type="checkbox" value="Large"/>
                                                <label for="ch-Large">Large</label>
                                            </li>
                                            <strong>Color</strong>
                                            <li>
                                                <input id="ch-Red" type="checkbox" value="Red"/>
                                                <label for="ch-Red">Red</label>
                                            </li>
                                            <li>
                                                <input id="ch-White" type="checkbox" value="White"/>
                                                <label for="ch-White">White</label>
                                            </li>
                                            <li>
                                                <input id="ch-Blue" type="checkbox" value="Blue"/>
                                                <label for="ch-Blue">Blue</label>
                                            </li>
                                            <li>
                                                <input id="ch-Green" type="checkbox" value="Green"/>
                                                <label for="ch-Green">Green</label>
                                            </li>
                                            <li>
                                                <input id="ch-Black" type="checkbox" value="Black"/>
                                                <label for="ch-Black">Black</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END Filter by options-->
                            
                        </div>
                        <form>
                            <input type="search" class="form-control" placeholder="Filter by keyword..." />
                            <div style="text-align:right">
                                <button type="submit" class="site-btn" name="submit">Search</button>
                                <button type="reset" class="black-btn" name="submit">Reset all</button>
                            </div>
                        </form>
                    </div>
                    <!--END Advanced Search-->
                    
                    <!--Start Top Sellers-->
                    <div class="men-categories">
                    	<h3>Top sellers</h3>
                        <?php
							include('top-sellers.php');
						?>
                    </div>
                    <!--END Top Sellers-->
                    
                </div>
                <!--END Left Column-->
                
                <!--Start Right Column-->
                <div class="col-md-9 col-sm-8 col-xs-12" style="padding-top:20px">
                
                	<!--Start MEN's Banner-->
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12">
                        	<img src="images/top-banner-1.jpg" width="100%"/>
                        </div>
                    </div>
                    <!--END MEN's Banner-->
                    
                    <!--Start MEN product sorting-->
                    <?php
					$q4maincat = "SELECT * FROM main_category WHERE id='".$data4subcat['main_cat_id']."'";
					$q4maincat_exe = mysql_query($q4maincat);
					if($q4maincat_exe)
					{
						$data4maincat = mysql_fetch_array($q4maincat_exe);
					}
					$q4cat = "SELECT * FROM category WHERE id='".$data4subcat['cat_id']."'";
					$q4cat_exe = mysql_query($q4cat);
					if($q4cat_exe)
					{
						$data4cat = mysql_fetch_array($q4cat_exe);
					}
					?>
                    <div class="row" id="lst">
                    	<div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                        	<h3>
								<?php echo $data4maincat['main_cat_name']; ?>
                                <i class="fa fa-angle-double-right" style="margin:0 10px; color:#DF2E1B;"></i>
								<?php echo $data4cat['cat_name']; ?>
                                <i class="fa fa-angle-double-right" style="margin:0 10px; color:#DF2E1B;"></i>
                                <?php echo $data4subcat['sub_cat_name']; ?>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                    	<!--Start Grid-List Buttons-->
                    	<div class="col-md-3 col-sm-3 col-xs-12">
                        	<div class="btn-group grid-list-btn">
                            	<a href="index.php?sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>#lst" class="btn grid <?php if(!isset($_GET['view_fashion'])){ echo "active";} ?>" role="grid">
                                	<i class="fa fa-th-large"></i>
                                </a>
                                <a href="index.php?sub_cat_id=<?php echo $_GET['sub_cat_id']; ?>&view_fashion=list#lst" class="btn list <?php if(isset($_GET['view_fashion'])){ echo "active";} ?>" role="list">
                                	<i class="fa fa-th-list"></i>
                                </a>
                            </div>
                        </div>
                        <!--END Grid-List Buttons-->
                        
                        <!--Start Sort-Show menu-->
                    	<div class="col-md-9 col-sm-9 col-xs-12">
                        	<form class="form-inline">
                                <div class="sort-show">
                                    <label>Show:</label>
                                    <select class="form-control">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>30</option>
                                        <option>50</option>
                                        <option>100</option>
                                        <option selected="selected">All</option>
                                    </select>
                                </div>
                                <div class="sort-show">
                                    <label>Sort By:</label>
                                    <select class="form-control">
                                        <option>Product Name (A-Z)</option>
                                        <option>Product Name (Z-A)</option>
                                        <option>Product Model (A-Z)</option>
                                        <option>Product Model (Z-A)</option>
                                        <option selected="selected">Product Price (Low > High)</option>
                                        <option>Product Price (High > Low)</option>
                                        <option>Product Quantity (Low > High)</option>
                                        <option>Product Quantity (High > Low)</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <!--END Sort-Show menu-->
                        
                    </div>
                    <!--END MEN product sorting-->
                    
                    <!--Start Products display-->
                    <?php 
					if(isset($_GET['view_fashion']) && $_GET['view_fashion']=='list')
					{
					?>
                    <!--Start List Display-->
                    <div class="outer-row">
                        <?php
						while($rec4prod=mysql_fetch_array($query4prod_exe))
						{
						?>
                        <div class="row">
                        	<div class="col-md-4 col-sm-12 col-xs-12 list-img">
                            	<a href="#"><img src="vendor/images/product_pics/item_pic(<?php echo $rec4prod['id'] ?>).<?php echo $rec4prod['product_image']; ?>"/></a>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12 list-display f-prod">
                            	<h4><a href="#"><?php echo $rec4prod['product_name']; ?></a></h4>
                                <p><?php echo $rec4prod['product_description'] ?></p>
                                <p><img src="images/stars-5.png" width="80px"/></p>
                                <p><span class="price">$<?php echo $rec4prod['sale_price']; ?></span></p>
                                <form class="form-item">
                                    <p>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" placeholder="QTY"/>
                                        </div>
                                        <diV class="add-to-cart-btn">
                                            <input name="product_code" type="hidden" value="<?php echo $rec4prod["product_code"]; ?>">
                                            <button type="submit" class="btn btn-default"><span>Add to cart</span></button>
                                        </diV>
                                    </p>
                                    <p class="three-btn">
                                        <a href="#" class="btn btn-default"><i class="fa fa-heart"></i>Add to Wish List</a>
                                        <a href="compare.php?compare_id=<?php echo $rec4prod['id'] ?>" class="btn btn-default"><i class="fa fa-retweet"></i>Add to Compare</a>
                                        <a href="product-detail.php?prodimg=<?php echo $rec4prod['id'] ?>" class="btn btn-default">Details<i class="fa fa-arrow-right"></i></a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <?php
						}
						?>
                    </div>
                    <!--END List Display-->
                    <?php
					}
					else
					{
					?>
                    <!--Start Grid Display-->
					<div class="outer-row prod-display">
                    	<div class="row f-prod">
                        <?php
						while($rec4prod=mysql_fetch_array($query4prod_exe))
						{
						?>
                            <div class="col-md-4 col-sm-6 col-xs-12 f-div">
                                <form class="form-item">
                                    <div>
                                        <img src="vendor/images/product_pics/item_pic(<?php echo $rec4prod['id'] ?>).<?php echo $rec4prod['product_image']; ?>" width="260px" height="340px"/>
                                        <div class="overlay-product">
                                            <a href="#"><i class="fa fa-heart fa-2x" title="Add to Wish List"></i></a>
                                            <a href="compare.php?compare_id=<?php echo $rec4prod['id'] ?>"><i class="fa fa-retweet fa-2x" title="Add to Compare"></i></a>
                                            <a href="product-detail.php?prodimg=<?php echo $rec4prod['id'] ?>"><i class="fa fa-arrow-right fa-2x" title="Read more"></i></a>
                                            <div class="add-to-cart-btn">
                                                <input name="product_code" type="hidden" value="<?php echo $rec4prod["product_code"]; ?>">
                                                <input name="product_color" type="hidden" value="Red">
                                                <input name="product_qty" type="hidden" value="1">
                                                <input name="product_size" type="hidden" value="M">
                                                <button type="submit" class="btn btn-default">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <h4><a href="#"><?php echo $rec4prod['product_name']; ?></a></h4>
                                    <div class="row rating">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <img src="images/stars-5.png" width="100%"/>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span>$<?php echo $rec4prod['sale_price']; ?></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        <?php 
						}
						?>
                        </div>
                    </div>
                    <!--END Grid Display-->
					<?php
					}
                    ?>
                    <!--END Products display-->
                    
                </div>
                <!--END Right Column-->
                
            </div>
        </div>
        <?php
}

else
{	
?>
    	<!--Start Full Page Carousel Slider-->
        <header id="myCarousel" class="carousel slide">
        
            <!--Start Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <!--END Indicators -->

            <!--Start Wrapper for Slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/Slide1.jpg" width="100%"/>
                    <a href="login-form.php" class="slider-btn join-btn">Join us</a>
                    <div class="carousel-caption">
                        <h2>JOIN TODAY</h2>
                    </div>
                </div>
                <div class="item">
                    <img src="images/Slide2.jpg" width="100%"/>
                    <a href="#" class="slider-btn fash-btn">Shop now</a>
                    <!--<p>World's most popular BAZzAR</p>-->
                    <div class="carousel-caption">
                        <h2>NEW ARRIVAL 2016</h2>
                    </div>
                </div>
                <div class="item">
                    <img src="images/Slide3.jpg" width="100%"/>
                    <div class="carousel-caption">
                        <h2>LOOKBACK 2016</h2>
                    </div>
                </div>
                <div class="item">
                    <img src="images/Slide4.jpg" width="100%"/>
                    <div class="carousel-caption">
                        <h2>LADY JEWELRY</h2>
                    </div>
                </div>
            </div>
            <!--END Wrapper for Slides -->
    
            <!-- Start Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev" role="button">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next" role="button">
                <span class="icon-next"></span>
            </a>
            <!-- END Controls -->
    
        </header>
    	<!--END Full Page Carousel Slider-->
        
        <!--Start Script to Activate the Carousel -->
		<script>
            $('.carousel').carousel({
                interval: 5000,
            });
        </script>
        <!--END Script to Activate the Carousel -->
        
	<div class="container-fluid nopadding">
    	
        <!--Start Welcome Description-->
        <div class="row nomargin">
            <div class="col-md-12 col-sm-12 col-xs-12 welcome">
                <h1>WELCOME!</h1>
                <h2>TO ONLINE BAZzAR</h2>
                <p>Get ready for <a href="index.php" id="bazzar">BAZzAR</a> without leaving the comfort of your own home. This is the new age of shopping where you don't even have to get out of your pajamas!<br> Find everything you need right here with vendors from multiple online companies. There's sure to be something for everyone!
                </p>
                <a href="#" class="btn btn-default">READ MORE</a>
            </div>
        </div>
        <!--END Welcome Description-->
        
        <div class="container">
        	
            <!--Start Home Banner-->
            <div class="row outer-row">
            	<div class="col-md-8 col-sm-8 col-xs-12" style="padding-left:0;">
                	<a href="#/" title="Large Banner"><img src="images/left-add.jpg" width="100%"/></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12" style="padding-right:0;">
                	<a href="#/" title="Small Banner"><img src="images/right-add.jpg" width="100%"/></a>
                </div>
            </div>
            <!--END Home Banner-->
            
            <!--Start Latest Product-->
            <div class="row outer-row">
            	<div class="col-sm-12 nopadding">
                    <div class="row nomargin">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 feat-prod nopadding">
                            <h3>Latest Product</h3>
                        </div>
                        
                        <!--Start Next and Previous Buttons-->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nopadding">
                            <div class="customNavigation">
                                <a class="btn prev" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                <a class="btn next" title="Next"><i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <!--END Next and Previous Buttons-->
                        
                    </div>
                    
                    <!--Start owl-carousel-->
                    <div id="owl-demo" class="owl-carousel owl-theme nopadding">
                        <?php
						$q_prod = "SELECT * FROM product ORDER BY id DESC LIMIT 7";
						$q_prod_exe = mysql_query($q_prod);
						while($data_prod=mysql_fetch_array($q_prod_exe))
						{?>
							<div class="item">
                                <div class="row nomargin">
                                    <div class="col-md-12 f-prod">
                                       <form class="form-item">
                                            <div>
                                                <a href="product-detail.php?prodimg=<?php echo $data_prod['id'] ?>" title="Read Details">
                                                    <img src="vendor/images/product_pics/item_pic(<?php echo $data_prod['id'] ?>).<?php echo $data_prod['product_image']; ?>"/>
                                                </a>
                                            </div>
                                            <h4><a href="#"><?php echo $data_prod['product_name']; ?></a></h4>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <span class="price">$<?php echo $data_prod['sale_price']; ?></span>
                                                </div>
                                                <div class="add-to-cart-btn">
                                                <input name="product_code" type="hidden" value="<?php echo $data_prod["product_code"]; ?>">
                                                <input name="product_color" type="hidden" value="Red">
                                                <input name="product_qty" type="hidden" value="1">
                                                <input name="product_size" type="hidden" value="M">
                                                <button type="submit" class="btn btn-default">Add to Cart</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
						<?php
                        }
						?>
                    </div>
                    <!--END owl-carousel-->
                    
                </div>
            </div>
            <!--END Latest Product-->
            
        </div>
        
        <!--Start Slogan-->
        <div class="slogan">
        	<div class="container nopadding">
                
                <!--Start Carasoul Slogan-->
                <div id="owl-slogan" class="owl-carousel owl-theme">
                    <div class="item">
                    	<p><i class="fa fa-quote-left"></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ea, perferendis error repudiandae numquam dolor fuga temporibus. Unde omnis, consequuntur.<i class="fa fa-quote-right"></i></p>
                        <div class="author">
                            <img src="images/mta.png" alt="Authorimage">
                            <ul class="list-unstyled">
                                <li>Muhammad Tayyab Ali</li>
                                <li>UI/UX Designer</li>
                            </ul>
                    	</div>
                    </div>
                    <div class="item">
                    	<p><i class="fa fa-quote-left"></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ea, perferendis error repudiandae numquam dolor fuga temporibus. Unde omnis, consequuntur.<i class="fa fa-quote-right"></i></p>
                        <div class="author">
                            <img src="images/mus.png" alt="Authorimage">
                            <ul class="list-unstyled">
                                <li>Muhammad Usman Sarwar</li>
                                <li>UI/UX Designer</li>
                            </ul>
                    	</div>
                    </div>
                </div>
                <!--END Carasoul Slogan-->
                
            </div>
        </div>
        <!--END Slogan-->
        
        <!--Start Popular Products-->
        <?php
		$popular_prod = "SELECT * FROM product LIMIT 6";
		$popular_prod_exe = mysql_query($popular_prod);
		?>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12" style="padding-left:0">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                            <h3>Popular Product</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <?php
								while($data_popular=mysql_fetch_array($popular_prod_exe))
								{?>
								<div class="col-md-6 col-xs-12">
                                    <div class="popular">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3">
                                                <a href="product-detail.php?prodimg=<?php echo $data_popular['id'] ?>" title="Read Details">
                                                	<img src="vendor/images/product_pics/item_pic(<?php echo $data_popular['id'] ?>).<?php echo $data_popular['product_image']; ?>" height="109px" width="100%"/>
                                                </a>
                                            </div>
                                            <div class="col-md-9 col-xs-9 pop-prod">
                                                <h4><a href="#"><?php echo $data_popular['product_name']; ?></a></h4>
                                                <p><img src="images/stars-5.png"/></p>
                                                <span class="price">$<?php echo $data_popular['sale_price']; ?></span>
                                                <p><?php echo $data_popular['product_description']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php
                                }
								?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 top-seller"  style="padding-right:0">
                    <h3>Top Sellers</h3>
                    <?php
                        include('top-sellers.php');
                    ?>
                </div>
            </div>
        </div>
        <!--END Popular Products-->
        
        <!-- Start Product Advertisement -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 nopadding feat-prod">
                    <h3>Product Advertisement</h3>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                    <ul id="filters" class="list-inline categories">
                        <li><a href="#" data-filter=".fashion" class="active">Fashion</a></li>
                        <li><a href="#" data-filter=".elect">Electronics</a></li>
                        <li><a href="#" data-filter=".motor">Motors</a></li>
                        <li><a href="#" data-filter=".sports">Sports</a></li>
                        <li><a href="#" data-filter=".book">Books</a></li>
                    </ul>
                </div>
            </div>
            
            <!--Start Isotope Filter-->
            <div class="row">
                <div class="col-md-12 nopadding">
                    <div id="container">
                        <!--Start FASHION Category-->
                        <div class="element fashion" data-category="fashion">
                            <h3>FASHION</h3>
                            <p>man Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="add-to-cart-btn btn-read-more">
                                <a class="btn btn-default" href="#">Show more...</a>
                            </div>
                        </div>
                        <div class="element fashion" data-category="fashion">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/mn1.jpg" target="_blank">
                                        	<img src="images/mn1.jpg"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 1</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element fashion" data-category="fashion">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/mn2.jpg" target="_blank">
                                        	<img src="images/mn2.jpg"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 2</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element fashion" data-category="fashion">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/mn3.jpg" target="_blank">
                                        	<img src="images/mn3.jpg"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 3</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END FASHION Category-->
                        <!--Start ELECTRONICS Category-->
                        <div class="element elect" data-category="elect">
                            <h3>ELECTRONICS</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="add-to-cart-btn btn-read-more">
                                <a class="btn btn-default" href="#">Show more...</a>
                            </div>
                        </div>
                        <div class="element elect" data-category="elect">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/wmn1.jpg" target="_blank">
                                        	<img src="images/wmn1.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 1</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element elect" data-category="elect">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/wmn2.jpg" target="_blank">
                                        	<img src="images/wmn2.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 2</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element elect" data-category="elect">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/wmn3.jpg" target="_blank">
                                        	<img src="images/wmn3.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 3</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END ELECTRONICS Category-->
                        <!--Start MOTORS Category-->
                        <div class="element motor" data-category="motor">
                            <h3>MOTORS</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="add-to-cart-btn btn-read-more">
                                <a class="btn btn-default" href="#">Show more...</a>
                            </div>
                        </div>
                        <div class="element motor" data-category="motor">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/kd1.jpg" target="_blank">
                                        	<img src="images/kd1.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 1</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element motor" data-category="motor">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/kd7.jpg" target="_blank">
                                        	<img src="images/kd7.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 2</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element motor" data-category="motor">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/kd6.jpg" target="_blank">
                                        	<img src="images/kd6.jpg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 3</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <button type="submit" class="btn btn-default pull-right"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END MOTORS Category-->
                    </div>
                </div>
            </div>
            <!--END Isotope Filter-->
            
        </div>
        <!-- END Product Advertisement -->
        
        <!--Start From the Blog-->
        <div class="container">
        	<div class="row outer-row">
            	<div class="col-sm-12 nopadding">
                    <div class="row nomargin">
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding feat-prod">
                            <h3>From the Blog</h3>
                        </div>
                    </div>
                    <div class="row f-prod">
                        <div class="col-md-4 col-sm-6 col-xs-12 blog">
                            <div>
                                <a href="#"><img src="images/blog-content.jpg" width="100%"/></a>
                            </div>
                            <p><i class="fa fa-calendar"></i> 03 Jan, 2016</p>
                            <a href="#">Aliquam dolor urna, interdum ut</a>
                            <p>Donec turpis. Curabitur varius cursus ante. Vivamus ac lorem. Aliquam elementum, orci vitae...</p>
                            <div class="add-to-cart-btn">
                                <a class="btn btn-default" href="#">Read more...</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 blog">
                            <div>
                                <a href="#"><img src="images/blog-content.jpg" width="100%"/></a>
                            </div>
                            <p><i class="fa fa-calendar"></i> 03 Jan, 2016</p>
                            <a href="#">Aliquam dolor urna, interdum ut</a>
                            <p>Donec turpis. Curabitur varius cursus ante. Vivamus ac lorem. Aliquam elementum, orci vitae...</p>
                            <div class="add-to-cart-btn">
                                <a class="btn btn-default" href="#">Read more...</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 blog">
                            <div>
                                <a href="#"><img src="images/blog-content.jpg" width="100%"/></a>
                            </div>
                            <p><i class="fa fa-calendar"></i> 03 Jan, 2016</p>
                            <a href="#">Aliquam dolor urna, interdum ut</a>
                            <p>Donec turpis. Curabitur varius cursus ante. Vivamus ac lorem. Aliquam elementum, orci vitae...</p>
                            <div class="add-to-cart-btn">
                                <a class="btn btn-default" href="#">Read more...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END From the Blog-->
                
    </div>
<?php
}
?>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <div class="container-fluid nopadding">
    	<!--Start Footer-->
		<?php
			include('footer.php');
		?>
        <!--END Footer-->
    </div>
</body>
</html>
