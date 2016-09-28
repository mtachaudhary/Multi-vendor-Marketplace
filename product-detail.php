<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Details | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link href="Bazzar-CSS/bootstrap.min.css" rel="stylesheet"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/owl.carousel.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/owl.theme.css" rel="stylesheet"/>
    <link href="cloudzoom/cloudzoom.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet" type="text/css"/>
    
    <script src="Bazzar-JQuery/jquery.min.js"></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
    <script src="Bazzar-JQuery/owl.carousel.min.js"></script>
    <script src="cloudzoom/cloudzoom.js" type="text/javascript"></script>
	<script src="Bazzar-JQuery/custom-js.js"></script>
    
</head>

<body>
	<!--Start Facebook SDK for JavaScript-->
	<script>
		window.fbAsyncInit = function() {
		  FB.init({
			appId      : 'your-app-id',
			xfbml      : true,
			version    : 'v2.5'
		  });
		};
	  
		(function(d, s, id){
		   var js, fjs = d.getElementsByTagName(s)[0];
		   if (d.getElementById(id)) {return;}
		   js = d.createElement(s); js.id = id;
		   js.src = "//connect.facebook.net/en_US/sdk.js";
		   fjs.parentNode.insertBefore(js, fjs);
		 }(document, 'script', 'facebook-jssdk'));
	</script>
    <div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
    </script>
    <!--END Facebook SDK for JavaScript-->
    
	<div class="container-fluid nopadding">
    	
        <!--Start Header-->
        <?php
			include('db_session.php');
			include('header.php');
		?>
        <!--END Header-->
    
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
$q_prod_detail = "SELECT * FROM product WHERE id='".$_GET['prodimg']."'";
$q_prod_detail_exe = mysql_query($q_prod_detail);
if($q_prod_detail_exe)
{
	$data = mysql_fetch_array($q_prod_detail_exe);
}
$q_brand = "SELECT * FROM brand WHERE id='".$data['brand_id']."'";
$q_brand_exe = mysql_query($q_brand);
if($q_brand_exe)
{
	$data_brand = mysql_fetch_array($q_brand_exe);
}
?>
		<div class="container main-container">
        	<div class="row">
            
            	<!--Start Left-Column-->
                <div class="col-md-9 col-sm-8 col-xs-12">
                	<div class="row">
                    
                    	<!--Start Image-Gallery-->
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        	<div class="row img-gallery">
                            	
                                <div class="col-md-9">
                                	<ul class="list-unstyled">
                                    	<li>
                                        	<img class="cloudzoom" src="vendor/images/product_pics/item_pic(<?php echo $data['id'] ?>).<?php echo $data['product_image']; ?>" data-cloudzoom="zoomImage: 'images/large/image1.jpg'" width="100%"/>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--END Image-Gallery-->
                        
                        <!--Start Image-details-->
                        <div class="col-md-5 col-sm-12 col-xs-12 img-detail">
                        	<h2><?php echo $data['product_name']; ?></h2>
                            <p>
                            	<img src="images/stars-5.png" width="75px"/>
                                <a href="#review">Reviews</a>
                                |
                                <a href="#review">Write a review</a>
                            </p>
                            <div>
                            	<p><strong>Brand:</strong> <?php echo $data_brand["brand_name"]; ?></p>
                                <p><strong>Product Code:</strong> <?php echo $data["product_code"]; ?></p>
                                <p><strong>Availability:</strong> <?php echo $data["quantity"]; ?></p>
                            </div>
                            <div>
                            	<p class="price">$<?php echo $data['sale_price']; ?></p>
                            </div>
                            <div class="ava-opt">
                            	<h3>Available Options</h3>
                                <div>
                                	<form method="post">
                                        <span>*</span>
                                        <strong>Size:</strong>
                                        <select name="pro-size" class="form-control" required>
                                            <option selected="selected" disabled>--- Please Select ---</option>
                                            <option value="small">Small (+$00.00)</option>
                                            <option value="medium">Medium (+$00.00)</option>
                                            <option value="large">Large (+$00.00)</option>
                                        </select>
                                        <span>*</span>
                                        <strong>Color:</strong><br>
                                        <input type="radio" name="color" value="red" id="rd" checked="checked"/> <label for="rd">Red (+$00.00)</label><br>
                                        <input type="radio" name="color" value="white" id="wh"/> <label for="wh">White (+$00.00)</label><br>
                                        <input type="radio" name="color" value="blue" id="bl"/> <label for="bl">Blue (+$00.00)</label><br>
                                        <input type="radio" name="color" value="green" id="gr"/> <label for="gr">Green (+$00.00)</label><br>
                                        <input type="radio" name="color" value="black" id="blk"/> <label for="blk">Black (+$00.00)</label>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button type="submit" class="btn btn-default site-btn">Add to cart</button>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <p class="three-btn">
                                                    <a href="#" class="btn btn-default" title="Add to Wish List"><i class="fa fa-heart"></i></a>
                                                    <a href="#" class="btn btn-default" title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                                    <a href="#" class="btn btn-default" title="Ask Question"><i class="fa fa-question"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <!--END Image-details-->
                    
                    </div>
                    
                    <!--Start Description-->
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12 feat-prod desc">
                        	<h3>Description</h3>
                            <p id="review"><?php echo $data['product_description']; ?></p>
                        </div>
                    </div>
                    <!--END Description-->
                    
                    <!--Start Reviews-->
                    <div class="row">
                    	<div class="col-md-12 col-sm-12 col-xs-12 feat-prod desc">
                        	<h3>Reviews (8)</h3>
                            <div class="row">
                            	
                                <!--Start Reviews-Display-->
                                <div class="col-md-8 col-xs-12">
                                	<div class="row">
                                    	<div class="col-md-3 rev-info">
                                        	<h6>Tayyab</h6>
                                            <span>02-04-2015 08:25 AM</span><br>
                                            <img src="images/stars-5.png"/>
                                        </div>
                                        <div class="col-md-9">
                                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar mi felis, sit amet fermentum.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    	<div class="col-md-3 rev-info">
                                        	<h6>Tayyab</h6>
                                            <span>02-04-2015 08:25 AM</span><br>
                                            <img src="images/stars-5.png"/>
                                        </div>
                                        <div class="col-md-9">
                                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar mi felis, sit amet fermentum.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    	<div class="col-md-3 rev-info">
                                        	<h6>Tayyab</h6>
                                            <span>02-04-2015 08:25 AM</span><br>
                                            <img src="images/stars-5.png"/>
                                        </div>
                                        <div class="col-md-9">
                                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar mi felis, sit amet fermentum.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    	<div class="col-md-3 rev-info">
                                        	<h6>Tayyab</h6>
                                            <span>02-04-2015 08:25 AM</span><br>
                                            <img src="images/stars-5.png"/>
                                        </div>
                                        <div class="col-md-9">
                                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar mi felis, sit amet fermentum.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    	<div class="col-md-3 rev-info">
                                        	<h6>Tayyab</h6>
                                            <span>02-04-2015 08:25 AM</span><br>
                                            <img src="images/stars-5.png"/>
                                        </div>
                                        <div class="col-md-9">
                                        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce pulvinar mi felis, sit amet fermentum.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!--END Reviews-Display-->
                                
                                <!--Start Write A Review-->
                                <div class="col-md-4 col-xs-12 write-rev">
                                	<legend>Write a review</legend>
                                    <form>
                                        <label><span>*</span> Your Name:</label>
                                        <input type="text" class="form-control" required/>
                                        <label><span>*</span> Rating:</label>
                                        <p>
                                            <strong>Bad</strong>
                                            <input type="radio" name="rating"/>
                                            <input type="radio" name="rating"/>
                                            <input type="radio" name="rating"/>
                                            <input type="radio" name="rating"/>
                                            <input type="radio" name="rating" checked/>
                                            <strong>Excellent</strong>
                                        </p>
                                        <label><span>*</span> Your Review:</label>
                                        <textarea class="form-control" required></textarea>
                                        <button class="btn btn-default site-btn" type="submit">Submit</button>
                                    </form>
                                </div>
                                <!--END Write A Review-->
                                
                            </div>
                        </div>
                    </div>
                    <!--END Reviews-->
                    
                    <!--Start Facebook-Comments-->
                    <div class="row comment-fb">
                    	<div class="col-md-12">
                        	<legend>Facebook Comment</legend>
                        	<div class="fb-comments" data-href="https://www.facebook.com/tayyab.685" data-width="100%" data-numposts="5"></div>
                        </div>
                    </div>
                    <!--END Facebook-Comments-->
                    
                </div>
                <!--END Left-Column-->
                
                <!--Start Right-Column-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                	
                    <!--Start Gray-Boxes-->
                    <div>
                    	<diV class="row gray-box">
                        	<div class="col-md-3 col-sm-3 col-xs-3">
                            	<i class="fa fa-truck"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<h4>Free Delivery</h4>
                                <p>Vivamus fringilla suscipit mi. In hac habitasse platea</p>
                            </div>
                        </diV>
                        <diV class="row gray-box">
                        	<div class="col-md-3 col-sm-3 col-xs-3">
                            	<i class="fa fa-money"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<h4>Money Back</h4>
                                <p>Vivamus fringilla suscipit mi. In hac habitasse platea</p>
                            </div>
                        </diV>
                        <diV class="row gray-box">
                        	<div class="col-md-3 col-sm-3 col-xs-3">
                            	<i class="fa fa-comments"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<h4>Support Service</h4>
                                <p>Vivamus fringilla suscipit mi. In hac habitasse platea</p>
                            </div>
                        </diV>
                        <diV class="row gray-box">
                        	<div class="col-md-3 col-sm-3 col-xs-3">
                            	<i class="fa fa-cubes"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<h4>Sample Promo Title</h4>
                                <p>Vivamus fringilla suscipit mi. In hac habitasse platea</p>
                            </div>
                        </diV>
                    </div>
                	<!--END Gray-Boxes-->
                    
                    <!--Start Top Sellers-->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 top-seller" >
                            <h3>Top Sellers</h3>
                            <?php
                                include('top-sellers.php');
                            ?>  
                        </div>
                    </div>
                    <!--END Top Sellers-->
                    
                    <!--Start Viewed Products-->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 top-seller" >
                            <h3>Viewed Products</h3>
                            <div class="popular">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <a href="#"><img src="images/mn2.jpg" width="66px"/></a>
                                    </div>
                                    <div class="col-md-8 col-xs-8 pop-prod">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p><span class="price">$00.00</span></p>
                                        <p>Suspendisse risus odio, posuere a, volut...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="popular">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <a href="#"><img src="images/kd4.jpg" width="66px"/></a>
                                    </div>
                                    <div class="col-md-8 col-xs-8 pop-prod">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p><span class="price">$00.00</span></p>
                                        <p>Suspendisse risus odio, posuere a, volut...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="popular">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <a href="#"><img src="images/mn1.jpg" width="66px"/></a>
                                    </div>
                                    <div class="col-md-8 col-xs-8 pop-prod">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p><span class="price">$00.00</span></p>
                                        <p>Suspendisse risus odio, posuere a, volut...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="popular">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <a href="#"><img src="images/kd1.jpg" width="66px"/></a>
                                    </div>
                                    <div class="col-md-8 col-xs-8 pop-prod">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p><span class="price">$00.00</span></p>
                                        <p>Suspendisse risus odio, posuere a, volut...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="popular">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                        <a href="#"><img src="images/lp4.jpg" width="66px"/></a>
                                    </div>
                                    <div class="col-md-8 col-xs-8 pop-prod">
                                        <h4><a href="#">Product Name</a></h4>
                                        <p><span class="price">$00.00</span></p>
                                        <p>Suspendisse risus odio, posuere a, volut...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END Viewed Products-->
                    
                </div>
                <!--END Rigt-Column-->
                
            </div>
            
            <!--Start Related Products-->
            <div class="row outer-row">
            	<div class="col-sm-12 nopadding">
                    <div class="row nomargin">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 feat-prod nopadding">
                            <h3>Related Products</h3>
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
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp1.jpg" target="_blank"><img src="images/lp1.jpg"/></a>
                                    </div>
                                    <h4><a href="#">Product 1</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp2.jpg" target="_blank"><img src="images/lp2.jpg"/></a>
                                    </div>
                                    <h4><a href="#">Product 2</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp3.jpg" target="_blank"><img src="images/lp3.jpg"/></a>
                                    </div>
                                    <h4><a href="#">Product 3</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp4.jpg" target="_blank"><img src="images/lp4.jpg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 4</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp5.jpg" target="_blank"><img src="images/lp5.jpg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 5</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp6.jpg" target="_blank"><img src="images/lp6.jpg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 6</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp7.jpg" target="_blank"><img src="images/lp7.jpg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 7</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp8.jpeg" target="_blank"><img src="images/lp8.jpeg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 8</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp9.jpg" target="_blank"><img src="images/lp9.jpg" width="100%"/></a>
                                    </div>
                                    <h4><a href="#">Product 9</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row nomargin">
                                <div class="col-md-12 f-prod">
                                    <div>
                                        <a href="images/lp10.jpeg" target="_blank">
                                        	<img src="images/lp10.jpeg" width="100%"/>
                                        </a>
                                    </div>
                                    <h4><a href="#">Product 10</a></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span class="price">$00.00</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 add-to-cart-btn">
                                            <a class="btn btn-default" href="#"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END owl-carousel-->
                    
                </div>
            </div>
            <!--END Related Products-->
            
        </div>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

        <!--Start Footer-->
		<?php
			include('footer.php');
		?>
        <!--END Footer-->
        
    </div>

</body>
</html>