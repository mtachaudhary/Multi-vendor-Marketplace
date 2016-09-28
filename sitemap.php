<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sitemap | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link href="Bazzar-CSS/bootstrap.min.css" rel="stylesheet"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet" type="text/css"/>
    
    <script src="Bazzar-JQuery/jquery.min.js"></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
	<script src="Bazzar-JQuery/custom-js.js"></script>
    
</head>

<body>
    
	<div class="container-fluid nopadding">
    	
        <!--Start Header-->
        <?php
			include('db_session.php');
			include('header.php');
		?>
        <!--END Header-->
    
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

		<div class="container main-container st-map">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                    <h3>Sitemap</h3>
                </div>
            </div>
            
            <!-- Start All Categories -->
            <h3>All Categories</h3>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Fashion</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Kids & Baby</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Electronics</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Computers & Tablets</a></li>
                        <li><a href="#">Cameras & Accessories</a></li>
                        <li><a href="#">Cell Phones & Accessories</a></li>
                        <li><a href="#">TV, Audio & Surveillance</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Motors</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Parts & Accessories</a></li>
                        <li><a href="#">Cars & Trucks</a></li>
                        <li><a href="#">Motorcycles</a></li>
                        <li><a href="#">Other Vehicals</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Sports</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Outdoor Sports</a></li>
                        <li><a href="#">Team Sports</a></li>
                        <li><a href="#">Exercise & Fitness</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Books</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Text Books, Education</a></li>
                        <li><a href="#">Fiction & Literature</a></li>
                        <li><a href="#">Non-Fiction Books</a></li>
                        <li><a href="#">Other Books & Accessories</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Musical Instruments & Gear</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Pianos, Keyboards & Organs</a></li>
                        <li><a href="#">Guitars & Basses</a></li>
                        <li><a href="#">Audio Equipment</a></li>
                        <li><a href="#">Sheet Music & Song Books</a></li>
                        <li><a href="#">Speaker Drivers & Horns</a></li>
                        <li><a href="#">Stage Lighting & Effects</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Home & Garden</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Bath</a></li>
                        <li><a href="#">Bedding</a></li>
                        <li><a href="#">Furnitures</a></li>
                        <li><a href="#">Home Decoration</a></li>
                        <li><a href="#">Home Improvement</a></li>
                        <li><a href="#">Kitchen, Dining & Bar</a></li>
                        <li><a href="#">Lamps, Lighting & Ceiling Fans</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Business & Industrial</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Agriculture & Forestry</a></li>
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Electrical & Test Equipment</a></li>
                        <li><a href="#">Fuel & Energy</a></li>
                        <li><a href="#">Healthcare, Lab & Life Science</a></li>
                        <li><a href="#">Heavy Equipment</a></li>
                        <li><a href="#">Light Equipment & Tools</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">Toys & Hobbies</a></label>
                    <ul class="list-unstyled">
                        <li><a href="#">Building Toys</a></li>
                        <li><a href="#">Action Figures</a></li>
                        <li><a href="#">Classic Toys</a></li>
                        <li><a href="#">Electronic, Battery & Wind-Up</a></li>
                        <li><a href="#">Puzzles</a></li>
                        <li><a href="#">Preschool Toys & Pretend Play</a></li>
                    </ul>
                </div>
            </div>
            <!-- END All Categories -->
            
            <!-- Start Other Links -->
            <h3>Other Links</h3>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<label><a href="#">My Account</a></label>
                    <ul class="list-unstyled">
                        <li><a href="login-form.php">Sign-in \ Register</a></li>
                        <li><a href="signup-form.php">Business Account</a></li>
                    </ul>
                </div>
            </div>
            <!-- END Other Links -->
            
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